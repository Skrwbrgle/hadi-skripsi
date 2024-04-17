<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/home', [
            "title" => "Agent Travels",
            "users" => User::all()
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
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin/userView', ["user" => $user]);
    }

    public function profile(User $user)
    {
        return view('agent-travel/profile', ["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth()->user()->is_admin === 1) {
            return view('admin/userEdit', ["title" => "Edit User", "user" => $user]);
        } else if (Auth()->user()->is_admin === 0) {
            return view('agent-travel/edit', ["title" => "Edit Profile", "user" => $user]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $validatedData = $request->validate([
            'username' =>
            'required|min:3|max:255|unique:users,username,' . $user->id,
            'nama_agen_travel' => 'required|max:255',
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


        $user->update($validatedData);

        if (Auth()->user()->is_admin  === 1) {
            return redirect('/admin/users/' . $user->id)->with('success', $user->nama_agen_travel . ' has been updated!');
        } else if (Auth()->user()->is_admin  === 0) {
            return redirect('/agent-travel/profile/' . $user->id)->with('success', $user->nama_agen_travel . ' has been updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        $user->rute()->delete();
        return redirect('/admin')->with('success', $user->nama_agen_travel . ' has been deleted!');
    }
}
