<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use App\Http\Requests\StoreRuteRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PSpell\Config;

class RuteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('agent-travel/route', [
            "title" => "Travel Agents",
            "routes" => Rute::where('user_id', Auth::id())->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'rute' => 'required|min:3|max:255|unique:rutes',
            'jam_keberangkatan' => 'required|min:5|max:255',
            'tarif' => 'required|max:255',
            'transportasi' => 'required|min:3|max:255',
            'user_id' => 'required',
        ]);

        $validatedData['jam_keberangkatan'] = date('H:i:s', strtotime($validatedData['jam_keberangkatan']));
        Rute::create($validatedData);
        return redirect('/agent-travel')->with('success', 'Rute has been cretaed!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRuteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRuteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function show(Rute $rute)
    {
        return view('agent-travel/inputForm');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function edit(Rute $rute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRuteRequest  $request
     * @param  \App\Models\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rute $rute)
    {
        $validatedData = $request->validate([
            'is_publish' => ['required', 'numeric', 'in:0,1'],
        ]);

        $validatedData['is_publish'] = (int)$validatedData['is_publish'];

        if ($rute->is_publish && $validatedData['is_publish'] === 1) {
            return redirect()->back()->with('error', $rute->rute . ' has been published previously!');
        }

        if ($rute->is_publish === $validatedData['is_publish']) {
            // Lakukan update hanya jika is_publish sebelumnya adalah 1
            // $rute->update($validatedData);
            return redirect()->back()->with('error', $rute->rute . ' has been unpublished!');
        }

        $rute->update($validatedData);

        return redirect('/agent-travel')->with('success', $rute->rute . ' has been published!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rute $rute)
    {
        Rute::destroy($rute->id);
        return redirect('/agent-travel')->with('success', $rute->rute . ' has been deleted!');
    }

    public function search(Request $request)
    {
        $jam = $request->jam;
        $route = $request->route;
        $transport = $request->transport;

        if ($jam === 'morning') {
            $timeRange = ['07:00:00', '12:00:00'];
        } else if ($jam === 'afternoon') {
            $timeRange = ['12:00:00', '18:00:00'];
        } else if ($jam === 'evening') {
            $timeRange = ['18:00:00', '22:00:00'];
        } else {
            $timeRange = ['00:00:00', '23:59:59'];
        }

        $results = Rute::with('user')
            ->where('is_publish', 1)
            ->whereBetween('jam_keberangkatan', $timeRange)
            ->where('rute', 'LIKE', '%' . $route . '%')
            ->where('transportasi', $transport)
            ->get();

        $routes = Rute::where('is_publish', 1)->pluck('rute');
        $agensi = User::where('is_admin', 0)->select('nama_agen_travel', 'alamat', 'no_telepon')->get();
        $cityMapping = [];

        foreach ($routes as $rute) {
            $parts = explode(' - ', $rute);
            $city = $parts[0]; // Nama kota pertama

            // Memastikan nama kota hanya ditambahkan sekali
            if (!in_array($city, $cityMapping)) {
                $cityMapping[] = $city;
            }
            if (!in_array($parts[1], $cityMapping)) {
                $cityMapping[] = $parts[1];
            }
        }

        if (count($results) > 0) {
            return view('customer.index', ['results' => $results, "rute" => $cityMapping, "agensi" => $agensi]);
        } else {
            return redirect('/')->with('not-found', 'Routes is not available.');
        }
    }
}
