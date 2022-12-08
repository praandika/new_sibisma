<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leasing;
use Illuminate\Support\Facades\Auth;

class LeasingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Leasing::all();
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
        for ($i=0; $i < count($req->leasing_code); $i++) { 
            Leasing::insert([
                'leasing_code' => $req->leasing_code[$i],
                'leasing_name' => $req->leasing_name[$i],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
        toast('Data leasing berhasil disimpan','success');
        return redirect()->route('leasing.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Leasing $leasing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Leasing $leasing)
    {
        return view('page', compact('leasing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Leasing $leasing)
    {
        Leasing::where('id',$leasing->id)->update([
            'leasing_code' => $req->leasing_code,
            'leasing_name' => $req->leasing_name,
            'updated_by' => Auth::user()->id,
        ]);
        toast('Data leasing berhasil diubah','success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id){
        Leasing::find($id)->delete();
        toast('Data leasing berhasil dihapus','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        Leasing::whereIn('id',$req->pilih)->delete();
        toast('Data leasing berhasil dihapus','success');
        return redirect()->back();
    }
}
