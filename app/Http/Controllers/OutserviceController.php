<?php

namespace App\Http\Controllers;

use App\Outservice;
use Illuminate\Http\Request;

class OutserviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('outservice/index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Outservice  $outservice
     * @return \Illuminate\Http\Response
     */
    public function show(Outservice $outservice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Outservice  $outservice
     * @return \Illuminate\Http\Response
     */
    public function edit(Outservice $outservice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outservice  $outservice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outservice $outservice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Outservice  $outservice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outservice $outservice)
    {
        //
    }
}
