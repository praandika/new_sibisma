<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Manpower;
use Illuminate\Http\Request;

class IDCardController extends Controller
{
    public function index(){
        // Login as Group

        $data = Dealer::where('dealer_code','!=','YIMM')->get();
        return view('page', compact('data'));
    }

    public function data($dealerId){
        $dealer = Dealer::where('id', $dealerId)->pluck('dealer_name');
        $dealer = $dealer[0];
        $data = Manpower::where([
            ['dealer_id', $dealerId],
            ['status','active'],
        ])->get();
        $total = Manpower::where([
            ['dealer_id', $dealerId],
            ['status','active'],
        ])->count();
        $idCardYes = Manpower::where([
            ['dealer_id', $dealerId],
            ['status','active'],
            ['idcard',1],
        ])->count();
        return view('page', compact('data','dealer','total','idCardYes'));
    }

    public function changeStatusIdCard($id, $status){
        $data = Manpower::where('id',$id)->first();
        if ($status == 0) {
            $data->idcard = 1;
        } else {
            $data->idcard = 0;
        }
        $data->update();
        toast('Status berhasil diubah','success');
        return redirect()->back();
    }

    public function show($id)
    {
        $data = Manpower::where('id',$id)->get();
        return view('page', compact('data'));
    }
}
