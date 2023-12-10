<?php

namespace App\Http\Controllers;

use App\Models\Penumpang;
use App\Http\Requests\StorePenumpangRequest;
use App\Http\Requests\UpdatePenumpangRequest;

class PenumpangController extends Controller
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenumpangRequest  $request
     * @param  \App\Models\Penumpang  $penumpang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenumpangRequest $request, Penumpang $penumpang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penumpang  $penumpang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penumpang $penumpang)
    {
        //
    }
}
