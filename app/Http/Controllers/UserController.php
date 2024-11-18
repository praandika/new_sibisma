<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dealer;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->access == 'admin') {
            $dc = Auth::user()->dealer_code;
            $data = User::where('dealer_code',$dc)->get();
            $dealer = Dealer::where('dealer_code',$dc)->orderBy('id','asc')->get();
        } else {
            $data = User::all();
            $dealer = Dealer::orderBy('id','asc')->get();
        }

        return view('page',compact('data','dealer'));
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
        $data = new User;
        $data->first_name = $req->first_name;
        $data->last_name = $req->last_name;
        $data->name = $req->first_name.' '.$req->last_name;
        $data->dealer_code = $req->dealer_code;
        $data->email = $req->email;
        $data->username = $req->username;
        $data->password = bcrypt($req->password);
        $data->access = $req->access;

        // cek username
        $cekUser = User::where('username',$req->username)->count();
        $cekEmail = User::where('email',$req->email)->count();
        if ($cekUser > 0) {
            toast('User sudah ada','warning');
            return redirect()->back()->with('display', true)->withInput($req->except('username'));
        } elseif ($cekEmail > 0) {
            toast('Email sudah ada','warning');
            return redirect()->back()->with('display', true)->withInput($req->except('email'));
        } else {
            $data->save();

            toast('User berhasil dibuat','success');
            return redirect()->back()->with('display', true);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('page', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::user()->access == 'admin') {
            $dc = Auth::user()->dealer_code;
            $dealer = Dealer::where('dealer_code',$dc)->orderBy('id','asc')->get();
        } else {
            $dealer = Dealer::orderBy('id','asc')->get();
        }

        return view('page', compact('user','dealer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, User $user)
    {
        $data = User::find($user->id);
        $data->first_name = $req->first_name;
        $data->last_name = $req->last_name;
        $data->name = $req->first_name.' '.$req->last_name;
        $data->dealer_code = $req->dealer_code;
        $data->email = $req->email;
        $data->username = $req->username;
        $data->access = $req->access;
        if(Auth::user()->access == 'master'){
            $data->password = bcrypt($req->password);
        }
        $data->save();

        toast('User berhasil diubah','success');
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

    public function changeStatus($id, $status){
        $data = User::where('id',$id)->first();
        if ($status == 'active') {
            $data->status = 'inactive';
        } else {
            $data->status = 'active';
        }
        
        $data->save();
        toast('Status berhasil diubah','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        User::whereIn('id',$req->pilih)->delete();
        toast('Data user berhasil dihapus','success');
        return redirect()->back();
    }

    public function updateCrud($id, $crud){
        $data = User::where('id',$id)->first();
        if ($crud == 'simple') {
            $data->crud = 'simple';
        } else {
            $data->crud = 'normal';
        }
        
        $data->save();
        return redirect()->back();
    }

    public function updateAllocationMode($id, $mode){
        $data = User::where('id',$id)->first();
        if ($mode == 'yes') {
            $data->allocation_tools = 'yes';
        } else {
            $data->allocation_tools = 'no';
        }
        
        $data->save();
        return redirect()->back();
    }

    public function editPass($id) {
        $data = User::where('id',$id)->get();

        return view('page', compact('data'));
    }

    public function updatePass(Request $req) {
        $oldpass = $req->oldpass;
        $pass = $req->pass;

        if (!Hash::check($oldpass, $pass)) {
            toast('Password salah','warning');
            return redirect()->back();
        } else {
            $data = User::find($req->id);
            $data->password = Hash::make($req->newpass);
            $data->update();
            toast('Password berhasil diubah','success');
            return redirect()->back();
        }
        
        
    }
}
