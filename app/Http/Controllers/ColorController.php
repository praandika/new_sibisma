<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Color::all();
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
        for ($i=0; $i < count($req->color_name); $i++) { 
            Color::insert([
                'color_name' => $req->color_name[$i],
                'color_faktur' => $req->color_faktur[$i],
                'color_code' => $req->color_code[$i],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
        toast('Data color berhasil disimpan','success');
        return redirect()->route('color.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        return view('page', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Color $color)
    {
        Color::where('id',$color->id)->update([
            'color_name' => $req->color_name,
            'color_faktur' => $req->color_faktur,
            'color_code' => $req->color_code,
            'updated_by' => Auth::user()->id,
        ]);
        toast('Data manpower berhasil diubah','success');
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
        Color::find($id)->delete();
        toast('Data color berhasil dihapus','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        Color::whereIn('id',$req->pilih)->delete();
        toast('Data color berhasil dihapus','success');
        return redirect()->back();
    }
}
