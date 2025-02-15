<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manpower;
use App\Models\Dealer;
use App\Models\Log;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ManpowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        if ($dc == 'group') {
            $data = Manpower::select('*',DB::raw('IF(user_id > 0, "Yes","No") as system_user'))
            ->get();
            $dealer = Dealer::all();
            return view('page', compact('data','dealer'));
        }else{
            $data = Manpower::select('*',DB::raw('IF(user_id > 0, "Yes","No") as system_user'))
            ->where('dealer_id',$did)->get();
            $dealer = $did;
            return view('page', compact('data','dealer'));
        }
        
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
        $req->validate([
            'image' => 'image|mimes:jpeg,png,jpg',
        ]);

        $data = new Manpower;
        $data->dealer_id = $req->dealer_id;
        $data->name = $req->name;
        $data->address = $req->address;
        $data->phone = $req->phone;
        $data->birthday = $req->birthday;
        $data->gender = $req->gender;
        $data->join_date = $req->join_date;
        $data->position = $req->position;
        $data->category = $req->category;
        $data->years_of_service = $req->yos;
        $data->education = $req->education;
        $data->idcard = 0;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        if ($req->image == '') {
            $data->image = 'noimage.jpg';
        } else {
            $img = $req->file('image');
            $img_file = time()."_".$img->getClientOriginalName();
            $dir_img = 'img/idcard';
            $img->move($dir_img,$img_file);
            $data->image = $img_file;
        }
        $data->save();

        // Write log
        $log = new Log;
        $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
        $log->activity = 'creates manpower data';
        $log->user_id = Auth::user()->id;
        $log->save();

        toast('Data manpower berhasil disimpan','success');
        return redirect()->route('manpower.index')->with('display', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Manpower $manpower)
    {
        return view('page', compact('manpower'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Manpower $manpower)
    {
        if (Auth::user()->access == 'master' || Auth::user()->access == 'admin') {
            $isUserId = $manpower->user_id;
            if ($isUserId == 0 || $isUserId == '' || $isUserId == null) {
                $manpower = Manpower::where('manpowers.id',$manpower->id)
                ->get();
            } else {
                $manpower = Manpower::join('users','manpowers.user_id','users.id')
                ->where('manpowers.id',$manpower->id)
                ->select('manpowers.*','users.first_name','manpowers.name as manpower_name')->get();
            }
            
            if (Auth::user()->access == 'admin') {
                $dc = Auth::user()->dealer_code;
                $user = User::where('dealer_code',$dc)->get();
                $dealer = Dealer::where('dealer_code',$dc)->orderBy('id','asc')->get();
            } else {
                $dealer = Dealer::all();
                $user = User::all();
            }
            
            return view('page', compact('manpower','dealer','isUserId','user'));
        } else {
            $dealer = Dealer::all();
            return view('page', compact('manpower','dealer'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Manpower $manpower)
    {
        $data = Manpower::find($manpower->id);
        $data->dealer_id = $req->dealer_id;
        $data->user_id = $req->user_id;
        $data->name = $req->name;
        $data->address = $req->address;
        $data->phone = $req->phone;
        $data->birthday = $req->birthday;
        $data->gender = $req->gender;
        $data->join_date = $req->join_date;
        $data->resign_date = $req->resign_date;
        $data->status = $req->status;
        $data->position = $req->position;
        $data->category = $req->category;
        $data->years_of_service = $req->yos;
        $data->education = $req->education;
        $data->idcard = $req->idcard;
        $data->updated_by = Auth::user()->id;

        if ($req->hasfile('image')) {
            if ($data->image != '' && $data->image != 'noimage.jpg') {
                $img_prev = $req->img_prev;
                unlink('img/idcard/'.$img_prev);
            }

            $img = $req->file('image');
            $img_file = time()."_".$img->getClientOriginalName();
            $dir_img = 'img/idcard';
            $img->move($dir_img,$img_file);

            $data->image = $img_file;
            $data->save();
        }else{
            $data->save();
        }

        // Write log
        $log = new Log;
        $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
        $log->activity = 'updates manpower data';
        $log->user_id = Auth::user()->id;
        $log->save();

        toast('Data manpower berhasil diubah','success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manpower $manpower)
    {
        //
    }

    public function delete($id){
        Manpower::find($id)->delete();

        // Write log
        $log = new Log;
        $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
        $log->activity = 'deletes manpower data';
        $log->user_id = Auth::user()->id;
        $log->save();

        toast('Data manpower terhapus','success');
        return redirect()->back();
    }
}
