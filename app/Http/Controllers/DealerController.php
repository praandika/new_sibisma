<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dealer;
use Illuminate\Support\Facades\Auth;

class DealerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Dealer::all();
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
        $cek = Dealer::where('dealer_code', $req->dealer_code)->count();
        if ($cek > 0) {
            return redirect()->back()->withInput()->with('message','Kode dealer sudah ada!');
        } else {
            $data = new Dealer;
            $data->dealer_code  = $req->dealer_code;
            $data->dealer_name  = $req->dealer_name;
            $data->phone  = $req->phone;
            if ($req->phone2 == 0) {
                $data->phone  = $req->phone;
            } else {
                $data->phone2  = '62'.ltrim($req->phone2, '0');
            }
            $data->address  = $req->address;
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;
            $data->save();
            toast('Data dealer berhasil disimpan','success');
            return redirect()->route('dealer.index')->with('display', true);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dealer $dealer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dealer $dealer)
    {
        return view('page', compact('dealer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Dealer $dealer)
    {
        
        if (substr($req->phone2,0,2) == '62') {
            $wa = $req->phone2;
        } else {
            $wa = '62'.ltrim($req->phone2, '0');
        }
        
        Dealer::find($dealer->id)->update([
            'dealer_name' => $req->dealer_name,
            'phone' => $req->phone,
            'phone2' => $wa,
            'address' => $req->address,
            'updated_by' => Auth::user()->id,
        ]);
        toast('Data dealer berhasil diubah','success');
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
        Dealer::find($id)->delete();
        toast('Data dealer terhapus','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        Dealer::whereIn('id',$req->pilih)->delete();
        toast('Data dealer berhasil dihapus','success');
        return redirect()->back();
    }
}
