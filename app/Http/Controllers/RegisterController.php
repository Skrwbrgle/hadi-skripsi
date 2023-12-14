<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function create(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3|max:255|unique:users',
            'password' => 'required|min:5|max:255',
            'nama_agen_travel' => 'required|max:255',
        ]);

        dd('registred!');
    }
}
