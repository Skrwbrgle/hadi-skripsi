<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\Pembayaran;
use App\Models\Rute;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'no_telepon' => 'required|string|max:20',
                'alamat' => 'required|string|max:255',
                'nik' => 'required|string|max:16',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'jumlah_penumpang' => 'required|integer|min:1|max:5',
                'rute_id' => 'required|integer',
                'tanggal' => 'required|date',
            ]);

            if (strtotime($request->tanggal) < strtotime(now())) {
                return redirect()->back()->with('error', '
The selected date must be a future date.');
            }
            $noTelepon = $request->no_telepon;
            if (substr($noTelepon, 0, 2) === '08') {
                // Jika ya, tambahkan awalan "62"
                $noTelepon = '62' . substr($noTelepon, 1);
            }

            $rute = Rute::with('user')->where('id', $request->input('rute_id'))->get();
            if (!$rute) {
                return redirect('/')->with('not-found', 'Rute not found.');
            }

            $tarif_per_penumpang = $rute[0]->tarif;
            $total_biaya = $tarif_per_penumpang * $request->input('jumlah_penumpang');

            $transaksiData = array_merge($validatedData, [
                'rute_id' => (int)$request->rute_id,
                'no_telepon' => $noTelepon,
                'nik' => (int)$request->nik,
                'jumlah_penumpang' => (int)$request->jumlah_penumpang,
                'total_biaya' => $total_biaya,
                'tanggal' => $request->tanggal,
            ]);

            // dd($transaksiData);
            $transaksi = Transaksi::create($transaksiData);

            // MIDTRANS SNAP REQ
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $order_id = 'TRAV-' . time() . '-' . $transaksi->id;

            $params = array(
                'transaction_details' => array(
                    'order_id' => $order_id,
                    'gross_amount' => $total_biaya,
                ),
                'item_details' => array(
                    array(
                        'id' => $rute[0]->id,
                        'brand' => $rute[0]->user->nama_agen_travel,
                        'name' => $rute[0]->rute . ' at ' . $transaksi->tanggal . '/' . \Carbon\Carbon::parse($rute[0]->jam_keberangkatan)->format('h:i A'),
                        'price' => (int)$tarif_per_penumpang,
                        'quantity' => (int)$transaksi->jumlah_penumpang,
                        'category' => $rute[0]->transportasi,
                        'merchant_name' => 'Travelize',
                    )
                ),
                'customer_details' => array(
                    'first_name' => $transaksi->nama,
                    'phone' => $transaksi->no_telepon,
                    'billing_address' => array(
                        'address' => $transaksi->alamat
                    ),
                ),
            );

            $snapToken = \Midtrans\Snap::createTransaction($params);
            // CREATE PAYMENT DATA
            $payment = Pembayaran::create([
                'transaksi_id' => $transaksi->id,
                'id_order' => $order_id,
            ]);

            $BASE_URL = config('app.infobip_base_url');
            $API_KEY = config('app.infobip_api_key');
            $RECIPIENT = $transaksi->no_telepon;

            $client = new Client([
                'base_uri' => $BASE_URL,
                'headers' => [
                    'Authorization' => "App " . $API_KEY,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            ]);

            $response = $client->request(
                'POST',
                'whatsapp/1/message/text',
                [
                    RequestOptions::JSON => [
                        'from' => '447860099299',
                        'to' => $RECIPIENT,
                        'content' => [
                            'text' => 'Hi ' . $transaksi->nama . '!, kami dari TRAVELIZE silahkan melakukan pembayaran tiket anda melalui link berikut ini, Terimakasih 🙏🙏 :' . $snapToken->redirect_url
                        ],
                        'callbackData' => 'Callback data',
                    ],
                ]
            );

            // echo ("HTTP code: " . $response->getStatusCode() . PHP_EOL);
            // echo ("Response body: " . $response->getBody()->getContents() . PHP_EOL);
            // return;

            return redirect('/')->with('success', 'Booking success! please chack your whatapps');
        } catch (\Throwable $th) {
            return redirect('/')->with('success', $th);
        }
    }

    public function callback(Request $request)
    {

        $payload = $request->all();

        Log::info('incoming-midtrans', [
            'payload' => $payload
        ]);

        $orderId = $payload['order_id'];
        $statusCode = $payload['status_code'];
        $grossAmount = $payload['gross_amount'];
        $reqSignature = $payload['signature_key'];


        $signature = hash('sha512', $orderId . $statusCode . $grossAmount . config('midtrans.server_key'));

        if ($signature != $reqSignature) {
            return response()->json(['message' => 'invalid signature'], 401);
        }

        $transactionStatus = $payload['transaction_status'];

        $order = Pembayaran::where('id_order', $orderId)->first();
        if (!$order) {
            return response()->json(['message' => 'invalid order'], 400);
        }
        // return response()->json([$orderId, $order], 200);

        if ($transactionStatus == 'settlement') {
            $order->is_payment = 1;
            $order->save();
        } elseif ($transactionStatus == 'expire') {
            $order->is_payment = 0;
            $order->save();
        } elseif ($transactionStatus == 'refund') {
            $order->is_payment = 0;
            $order->save();
        }

        return response()->json(['message' => 'success'], 200);
    }

    public function refund(Request $request)
    {
        $orderId = $request->input('order_id');
        $amountToRefund = $request->input('amount');

        // dd($orderId . '-' . $amountToRefund);
        $payment = Pembayaran::with('transaksi')->where('id_order', $orderId)->first();

        if (!$payment) {
            return response()->json(['message' => 'Invalid order ID'], 400);
        }

        $totalBiaya = $payment->transaksi->total_biaya;
        if ($amountToRefund > $totalBiaya) {
            return response()->json(['message' => 'Invalid refund amount'], 400);
        }

        $refundUrl = 'https://api.sandbox.midtrans.com/v2/' . $orderId . '/refund';
        $refund_id = 'REFUND-' . time() . '-' . $payment->transaksi->id;

        $refundData = [
            'refund_key' => $refund_id,
            'amount' => $amountToRefund,
            'reason' => 'for some reason',
        ];

        $midtransServerKey = config('midtrans.server_key');
        $client = new Client();

        // Melakukan permintaan HTTP POST menggunakan Guzzle
        $response = $client->post($refundUrl, [
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'authorization' => 'Basic ' . base64_encode($midtransServerKey . ':'),
            ],
            'json' => $refundData,
        ]);

        $responseData = json_decode($response->getBody(), true);
        Log::info('refund-midtrans', [
            'payload' => $response->getBody()
        ]);

        // Menangani atau menggunakan data respons sesuai kebutuhan Anda
        // ...

        return response()->json(['message' => $responseData], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransaksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransaksiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransaksiRequest  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
