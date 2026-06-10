<?php

namespace App\Http\Controllers;

use App\Models\SuratJalanMutasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuratJalanMutasiController extends Controller
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

        $data = new SuratJalanMutasi;
        $data->date_sjm = $req->date_sjm;
        $data->dealer_id = $req->dealer_id;
        $data->unit_id = $req->unit_id;
        $data->qty_sjm = $req->qty_sjm;
        $data->frame_no = $req->frame_no;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        if ($req->image == '') {
            $data->image = 'noimage.jpg';
            $data->save();
            toast('Data unit berhasil disimpan','success');
            return redirect()->back()->with('display', true);
        } else {
            $img = $req->file('image');
            $img_file = time()."_".$img->getClientOriginalName();
            $dir_img = 'img/motorcycle';
            $img->move($dir_img,$img_file);
            $data->image = $img_file;
            $data->save();
            toast('Data unit berhasil disimpan','success');
            return redirect()->back()->with('display', true);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratJalanMutasi  $suratJalanMutasi
     * @return \Illuminate\Http\Response
     */
    public function show(SuratJalanMutasi $suratJalanMutasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratJalanMutasi  $suratJalanMutasi
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratJalanMutasi $suratJalanMutasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratJalanMutasi  $suratJalanMutasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratJalanMutasi $suratJalanMutasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratJalanMutasi  $suratJalanMutasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratJalanMutasi $suratJalanMutasi)
    {
        //
    }
}
