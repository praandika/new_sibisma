<?php

namespace App\Http\Controllers;

use App\Models\Acttype;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Acttype::orderBy('type_activity','desc')->get();
        return view('page', compact('data'));
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
    public function store(Request $req)
    {
        $data = new Acttype;
        $data->type_activity = $req->type_activity;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        $data->save();
        toast('Data type activity berhasil disimpan','success');
        return redirect()->back()->with('display', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acttype  $acttype
     * @return \Illuminate\Http\Response
     */
    public function show(Acttype $acttype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Acttype  $acttype
     * @return \Illuminate\Http\Response
     */
    public function edit(Acttype $acttype)
    {
        return view('page', compact('acttype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Acttype  $acttype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Acttype $acttype)
    {
        $data = Acttype::find($acttype->id);
        $data->type_activity = $req->type_activity;
        $data->updated_by = Auth::user()->id;
        $data->update();
        toast('Data type activity berhasil diupdate','success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acttype  $acttype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acttype $acttype)
    {
        //
    }

    public function delete($id){
        Acttype::find($id)->delete();
        toast('Data type activity terhapus','success');
        return redirect()->back();
    }
}
