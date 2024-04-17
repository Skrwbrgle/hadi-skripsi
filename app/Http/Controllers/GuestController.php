<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Rute;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class GuestController extends Controller
{
    public function index()
    {
        $routes = Rute::where('is_publish', 1)->pluck('rute');
        $agensi = User::where('is_admin', 0)->select('nama_agen_travel', 'alamat', 'no_telepon')->get();
        // dd($agensi);
        $cityMapping = [];

        foreach ($routes as $route) {
            $parts = explode(' - ', $route);
            $city1 = strtolower($parts[0]); // Nama kota pertama
            $city2 = strtolower($parts[1]); // Nama kota kedua

            // Memastikan nama kota hanya ditambahkan sekali, tanpa memperdulikan huruf besar/kecil
            if (!in_array($city1, $cityMapping)) {
                $cityMapping[] = ucwords($city1); // Mengonversi huruf pertama menjadi huruf besar
            }

            if (!in_array($city2, $cityMapping)) {
                $cityMapping[] = ucwords($city2);
            }
        }
        $cityMapping = array_unique($cityMapping);

        return view('customer.index', [
            "rute" => $cityMapping,
            "agensi" => $agensi
        ]);
    }

    // public function sendEmail(Request $request)
    // {
    //     // $rute = session('rute');
    //     dd($request);

    //     $validatedData = $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'subject' => 'required',
    //         'message' => 'required',
    //     ]);

    //     // session()->flash('rute', $rute);
    //     Mail::to('travelize7@gmail.com')->send(new ContactFormMail($validatedData));

    //     return redirect('/')->with('success', 'Your message has been sent. Thank you!');
    // }
}
