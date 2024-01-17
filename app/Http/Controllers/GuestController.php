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
            $city = $parts[0]; // Nama kota pertama

            // Memastikan nama kota hanya ditambahkan sekali
            if (!in_array($city, $cityMapping)) {
                $cityMapping[] = $city;
            }
            if (!in_array($parts[1], $cityMapping)) {
                $cityMapping[] = $parts[1];
            }
        }

        // $ruteString = implode(', ', $cityMapping);

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
