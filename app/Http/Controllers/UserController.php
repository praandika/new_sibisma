<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dealer;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = User::all();
        $dealer = Dealer::orderBy('id','asc')->get();
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
        $data->save();

        toast('User berhasil dibuat','success');
        return redirect()->back()->with('display', true);
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
        $dealer = Dealer::orderBy('id','asc')->get();
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
}
