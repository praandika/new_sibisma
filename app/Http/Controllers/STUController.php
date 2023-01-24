<?php

namespace App\Http\Controllers;

use App\Models\STU;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class STUController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $yesterday = Carbon::yesterday('GMT+8')->format('Y-m-d');
        $data = STU::join('dealers','s_t_u_s.dealer_code','=','dealers.dealer_code')
        ->where('stu_date',$yesterday)
        ->orderBy('stu_date','desc')
        ->get();
        return view('page',compact('data'));
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
        for ($i=0; $i < count($request->dealer_code); $i++) { 
            STU::insert([
                'stu_date' => $request->stu_date,
                'dealer_code' => $request->dealer_code[$i],
                'stu' => $request->stu[$i],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
        toast('Data STU berhasil disimpan','success');
        return redirect()->route('stu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\STU  $sTU
     * @return \Illuminate\Http\Response
     */
    public function show(STU $sTU)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\STU  $sTU
     * @return \Illuminate\Http\Response
     */
    public function edit(STU $sTU)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\STU  $sTU
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, STU $sTU)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\STU  $sTU
     * @return \Illuminate\Http\Response
     */
    public function destroy(STU $sTU)
    {
        //
    }

    public function delete($id){
        STU::find($id)->delete();
        toast('Data stu berhasil dihapus','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        STU::whereIn('id',$req->pilih)->delete();
        toast('Data stu berhasil dihapus','success');
        return redirect()->back();
    }
}
