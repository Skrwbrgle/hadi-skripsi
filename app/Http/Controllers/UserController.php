<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Validation\Rule as ValidationRule;

$rules = [
    'username' => 'required|string',
    'nama_agen_travel' => 'required|string',
    'no_telepon' => 'required|string',
    'alamat' => 'required|string',
];

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
            "title" => "Users",
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin/userEdit', ["user" => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if ($request->filled('password')) {
            $rules['password'] = 'required|min:8|confirmed';
        }

        $rules['password_confirmation'] = [
            'required',
            ValidationRule::in([$request->password]),
        ];

        $request->validate($rules);
        User::where('id', $user->id)->update([
            'username' => $request->username,
            'nama_agen_travel' => $request->nama_agen_travel,
            'no_telepon' => $request->no_telepon,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);
        return redirect()->back()->with('success', $user->nama_agen_travel . ' has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/')->with('success', $user->nama_agen_travel . ' has been deleted!');
    }
}
