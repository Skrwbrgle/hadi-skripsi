<?php

namespace App\Http\Controllers;

use App\Models\Penumpang;
use App\Http\Requests\StorePenumpangRequest;
use App\Http\Requests\UpdatePenumpangRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenumpangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/customer', [
            "title" => "Customers",
            "customers" => Penumpang::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePenumpangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenumpangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penumpang  $penumpang
     * @return \Illuminate\Http\Response
     */
    public function show(Penumpang $penumpang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penumpang  $penumpang
     * @return \Illuminate\Http\Response
     */
    public function edit(Penumpang $penumpang)
    {
        return view('admin/customerEdit', ["title" => "Edit Customer", "customer" => $penumpang]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenumpangRequest  $request
     * @param  \App\Models\Penumpang  $penumpang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penumpang $penumpang)
    {
        $validatedData = $request->validate([
            'username' =>
            'required|min:3|max:255|unique:users,username,' . $penumpang->id,
            'nama' => 'required|max:255',
            'no_telepon' => 'required|min:10|max:20',
            'alamat' => 'required|max:255',
            'password' => 'nullable|min:5|max:255|confirmed',
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] =
                Hash::make($validatedData['password']);;
        } else {
            unset($validatedData['password']);
        }

        $penumpang->update($validatedData);

        return redirect('/admin/customers')->with('success', $penumpang->nama . ' has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penumpang  $penumpang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penumpang $penumpang)
    {
        Penumpang::destroy($penumpang->id);
        return redirect('/admin/customers')->with('success', $penumpang->nama . ' has been deleted!');
    }
}
