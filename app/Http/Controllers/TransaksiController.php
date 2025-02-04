<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\Pembayaran;
use App\Models\Rute;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
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
    public function order(Request $request)
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

            // Validasi kouta pemesanan start
            $transactionsOnDate = DB::table('transaksis')
                ->where('tanggal', $validatedData['tanggal'])
                ->where('rute_id', $validatedData['rute_id'])
                ->get();

            $kouta = Rute::where('id', $validatedData['rute_id'])->value('kouta');

            // Hitung jumlah total tiket pada tanggal tersebut
            $totalTicketsOnDate = $transactionsOnDate->sum('jumlah_penumpang');

            // Tentukan batasan jumlah order tiket per tanggal
            $maxTicketsPerDate = $kouta ?? 5;

            // dd($transactionsOnDate, $totalTicketsOnDate, $maxTicketsPerDate);
            if ($totalTicketsOnDate + $validatedData['jumlah_penumpang'] > $maxTicketsPerDate) {
                return redirect('/')->with('error', 'Sorry, maximum ticket quota exceeded for this date.');
            }
            // Validasi kouta pemesanan end

            $currentDate = Carbon::today()->startOfDay();
            $selectedDate = Carbon::createFromFormat('Y-m-d', $validatedData['tanggal'])->startOfDay();

            if ($selectedDate->lte($currentDate)) {
                return redirect('/')->with('error', 'The selected date must be a future date.');
            }

            $noTelepon = $request->no_telepon;
            if (substr($noTelepon, 0, 2) === '08') {
                // Jika ya, tambahkan awalan "62"
                $noTelepon = '62' . substr($noTelepon, 1);
            }

            $rute = Rute::with('user')->where('id', $request->input('rute_id'))->first();
            if (!$rute) {
                return redirect('/')->back()->with('not-found', 'Rute not found.');
            }

            $tarif_per_penumpang = $rute->tarif;
            $total_biaya = $tarif_per_penumpang * $request->input('jumlah_penumpang');

            $validatedData['no_telepon'] = $noTelepon;
            $validatedData['total_biaya'] = $total_biaya;


            $transaksi = Transaksi::create($validatedData);
            // MIDTRANS SNAP REQ
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $order_id = 'TRAV-' . time() . '-' . $transaksi->id;


            $params = [
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => $total_biaya,
                ],
                'item_details' => [
                    [
                        'id' => $rute->id,
                        'brand' => $rute->user->nama_agen_travel,
                        'name' => $rute->rute . ' at ' . $transaksi->tanggal . '/' . \Carbon\Carbon::parse($rute->jam_keberangkatan)->format('h:i A'),
                        'price' => (int)$tarif_per_penumpang,
                        'quantity' => (int)$transaksi->jumlah_penumpang,
                        'category' => $rute->transportasi,
                        'merchant_name' => 'Travelize',
                    ]
                ],
                'customer_details' => [
                    'first_name' => $transaksi->nama,
                    'phone' => $transaksi->no_telepon,
                    'billing_address' => [
                        'address' => $transaksi->alamat
                    ],
                ],
            ];

            $snapToken = \Midtrans\Snap::createTransaction($params);
            // CREATE PAYMENT DATA
            $payment = Pembayaran::create([
                'transaksi_id' => $transaksi->id,
                'id_order' => $order_id,
            ]);

            // push whatsapp
            $target = $transaksi->no_telepon;
            $tokenFonnte = config('app.token_fonnte');
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $target,
                    'message' => 'Hi ' . $transaksi->nama . '!, kami dari TRAVELIZE silahkan melakukan pembayaran tiket anda melalui link berikut ini, Terimakasih 🙏🙏 :' . $snapToken->redirect_url,
                    'countryCode' => '62', //optional
                ),
                CURLOPT_HTTPHEADER => array(
                    "Authorization: $tokenFonnte" //change TOKEN to your actual token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo $response;

            // $BASE_URL = config('app.infobip_base_url');
            // $API_KEY = config('app.infobip_api_key');
            // $RECIPIENT = $transaksi->no_telepon;

            // $client = new Client([
            //     'base_uri' => $BASE_URL,
            //     'headers' => [
            //         'Authorization' => "App " . $API_KEY,
            //         'Content-Type' => 'application/json',
            //         'Accept' => 'application/json',
            //     ]
            // ]);

            // $response = $client->request(
            //     'POST',
            //     'whatsapp/1/message/text',
            //     [
            //         RequestOptions::JSON => [
            //             'from' => '447860099299',
            //             'to' => $RECIPIENT,
            //             'content' => [
            //                 'text' => 'Hi ' . $transaksi->nama . '!, kami dari TRAVELIZE silahkan melakukan pembayaran tiket anda melalui link berikut ini, Terimakasih 🙏🙏 :' . $snapToken->redirect_url
            //             ],
            //             'callbackData' => 'Callback data',
            //         ],
            //     ]
            // );

            // echo ("HTTP code: " . $response->getStatusCode() . PHP_EOL);
            // echo ("Response body: " . $response->getBody()->getContents() . PHP_EOL);
            // return;

            return redirect('/')->with('success', 'Booking success! please check your whatapps');
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
        $refundStatus = $payload['fraud_status'];

        $order = Pembayaran::with('transaksi.rute.user')->where('id_order', $orderId)->first();
        if (!$order) {
            return response()->json(['message' => 'invalid order'], 400);
        }

        $data = [
            'nama_travel' => $order->transaksi->rute->user->nama_agen_travel,
            'id_order' => $order->id_order,
            'rute' => $order->transaksi->rute->rute,
            'tgl_berangkat' => \Carbon\Carbon::parse($order->transaksi->tanggal)->locale('id')->isoFormat('D'),
            'bulan_berangkat' => \Carbon\Carbon::parse($order->transaksi->tanggal)->locale('id')->isoFormat('MMM'),
            'hari_berangkat' => \Carbon\Carbon::parse($order->transaksi->tanggal)->locale('id')->isoFormat('dddd, Y'),
            'jam_berangkat' => \Carbon\Carbon::createFromFormat('H:i:s', $order->transaksi->rute->jam_keberangkatan)->format('h:i A'),
            'titik_jemput' => $order->transaksi->alamat,
            'price' => 'Rp' . number_format($order->transaksi->total_biaya, 0, ',', '.'),
            'penumpang' => $order->transaksi->jumlah_penumpang
        ];
        // return response()->json($data, 200);

        if ($transactionStatus == 'settlement') {
            $order->is_payment = 1;
            $order->save();

            $pdfFileName = 'e-ticket_' . uniqid() . '.pdf';
            $pdfFilePath = storage_path('app/public/' . $pdfFileName);
            $pdfUrl = asset('storage/' . $pdfFileName);
            $pdfUrl = str_replace('http://', 'https://', $pdfUrl);

            $html = view('customer.ticket', ['data' => $data])->render();

            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8',
                'format' => 'Letter',
                'orientation' => 'P',
                'margin_left' => 10,
                'margin_right' => 10
            ]);

            $mpdf->WriteHTML($html);
            // return $mpdf->Output();
            $mpdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE);

            // Send E-Ticket ke whatsapp
            $target = $order->transaksi->no_telepon;
            $tokenFonnte = config('app.token_fonnte');
            // dd($pdfUrl);
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $target,
                    'message' => 'Ini pembelian E-Ticket anda dari kami Travelize. silahkan download ' . $pdfUrl,
                    'url' => $pdfUrl,
                    'filename' => $pdfFileName, //optional, only works on file and audio
                    'countryCode' => '62', //optional
                ),
                CURLOPT_HTTPHEADER => array(
                    "Authorization: $tokenFonnte" //change TOKEN to your actual token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            // $BASE_URL = config('app.infobip_base_url');
            // $API_KEY = config('app.infobip_api_key');
            // $RECIPIENT = $order->transaksi->no_telepon;

            // $client = new Client([
            //     'base_uri' => $BASE_URL,
            //     'headers' => [
            //         'Authorization' => "App " . $API_KEY,
            //         'Content-Type' => 'application/json',
            //         'Accept' => 'application/json',
            //     ]
            // ]);

            // return $pdfUrl;

            // $response = $client->request(
            //     'POST',
            //     'whatsapp/1/message/document',
            //     [
            //         RequestOptions::JSON => [
            //             'from' => '447860099299',
            //             'to' => $RECIPIENT,
            //             'content' => [
            //                 'mediaUrl' => $pdfUrl,
            //                 'caption' => 'Ini pembelian E-Ticket anda dari kami Travelize',
            //                 'filename' => $pdfFileName,
            //             ],
            //             'callbackData' => 'Callback data',
            //         ],
            //     ]
            // );
            // return $response->getBody()->getContents();
            $data_res = json_decode($response, true);
            return response()->json([$data_res['detail'], $pdfUrl], 200);
            // return response()->json([$response->getBody()->getContents(), $pdfUrl], 200);
        } elseif ($transactionStatus == 'expire') {
            $order->transaksi->delete();
            $order->delete();
            return response()->json(['message' => 'payment expired, data deleted'], 200);
        } elseif ($transactionStatus == 'refund' && $refundStatus == 'accept') {
            $order->is_payment = 2;
            $order->save();
            return response()->json(['message' => 'payment refunf, uang anda akan dikembalikan dalam 24jam'], 200);
        }

        return response()->json(['message' => 'success'], 200);
    }

    public function refund(Request $request)
    {
        try {
            $orderId = $request->input('order_id');
            $amountToRefund = $request->input('amount');

            // dd($orderId . '-' . $amountToRefund);
            $payment = Pembayaran::with('transaksi')->where('id_order', $orderId)->first();

            if (!$payment) {
                return redirect('/')->with('error', 'Invalid order ID.');
                // return response()->json(['message' => 'Invalid order ID'], 400);
            }

            $totalBiaya = $payment->transaksi->total_biaya;
            $departureTime = $payment->transaksi->tanggal;
            $refundDeadline = Carbon::createFromFormat('Y-m-d H:i:s', $departureTime)->subDay();

            if (!($amountToRefund == $totalBiaya)) {
                return redirect('/')->with('error', 'Invalid refund amount.');
                // return response()->json(['message' => 'Invalid refund amount'], 400);
            }

            // dd($departureTime, $refundDeadline, Carbon::now());
            if (Carbon::now()->gte($refundDeadline)) {
                return redirect('/')->with('error', 'Refund deadline has passed. Refund cannot be processed.');
                // return response()->json(['message' => 'Refund deadline has passed. Refund cannot be processed.'], 400);
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

            $response = $client->post($refundUrl, [
                'headers' => [
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                    'authorization' => 'Basic ' . base64_encode($midtransServerKey . ':'),
                ],
                'json' => $refundData,
            ]);

            $responseData = json_decode($response->getBody(), true);
            // Log::info('refund-midtrans', [
            //     'payload' => $response->getBody()
            // ]);

            if ($responseData['status_code'] === '200') {
                return redirect('/')->with('refund', $responseData['status_message']);
            } else {
                return redirect('/')->with('refund', $responseData['status_message']);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
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
