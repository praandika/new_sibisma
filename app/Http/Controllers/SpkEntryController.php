<?php

namespace App\Http\Controllers;

use App\Models\SpkEntry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpkEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page');
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
     * @param  \App\Models\SpkEntry  $spkEntry
     * @return \Illuminate\Http\Response
     */
    public function show(SpkEntry $spkEntry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SpkEntry  $spkEntry
     * @return \Illuminate\Http\Response
     */
    public function edit(SpkEntry $spkEntry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SpkEntry  $spkEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpkEntry $spkEntry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpkEntry  $spkEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpkEntry $spkEntry)
    {
        //
    }
}
