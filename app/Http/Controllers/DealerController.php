<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\DealerResource;
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
            if ($req->image == '') {
                $data->image = 'noimage.jpg';
                $data->save();
                toast('Data dealer berhasil disimpan','success');
                return redirect()->route('dealer.index')->with('display', true);
            } else {
                $img = $req->file('image');
                $img_file = time()."_".$img->getClientOriginalName();
                $dir_img = 'img/dealer';
                $img->move($dir_img,$img_file);
                $data->image = $img_file;
                $data->save();
                toast('Data dealer berhasil disimpan','success');
                return redirect()->route('dealer.index')->with('display', true);
            }
            
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
        
        $data = Dealer::find($dealer->id);
        $data->dealer_name = $req->dealer_name;
        $data->phone = $req->phone;
        $data->phone2 = $wa;
        $data->address = $req->address;
        $data->updated_by = Auth::user()->id;
        if ($req->hasfile('image')) {
            if ($data->image != '' && $data->image != 'noimage.jpg') {
                $img_prev = $req->img_prev;
                unlink('img/dealer/'.$img_prev);
            }

            $img = $req->file('image');
            $img_file = time()."_".$img->getClientOriginalName();
            $dir_img = 'img/dealer';
            $img->move($dir_img,$img_file);

            $data->image = $img_file;
            $data->save();
            toast('Data dealer berhasil diubah','success');
            return redirect()->back();
        }else{
            $data->save();
            toast('Data dealer berhasil diubah','success');
            return redirect()->back();
        }
        
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

    public function sendDealer() {
        $data = Dealer::where([
            ['dealer_code', '!=', 'AA0104F'],
            ['dealer_code', '!=', 'YIMM']
        ])
        ->get();
        return DealerResource::collection($data);
    }
}
