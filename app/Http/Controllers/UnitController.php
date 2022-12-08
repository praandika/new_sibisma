<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Color;
use Illuminate\Support\Facades\Auth;


class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Unit::all();
        $color = Color::all();
        return view('page', compact('data','color'));
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

        $data = new Unit;
        $data->model_name = $req->model_name;
        $data->category = $req->category;
        $data->color_id = $req->color_id;
        $data->year_mc = $req->year_mc;
        $data->price = $req->price;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        return view('page', compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        $color = Color::all();
        return view('page', compact('unit','color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Unit $unit)
    {
        $data = Unit::find($unit->id);
        $data->model_name = $req->model_name;
        $data->category = $req->category;
        $data->color_id = $req->color_id;
        $data->year_mc = $req->year_mc;
        $data->price = $req->price;
        if ($req->hasfile('image')) {
            if ($data->image != '' && $data->image != 'noimage.jpg') {
                $img_prev = $req->img_prev;
                unlink('img/motorcycle/'.$img_prev);
            }

            $img = $req->file('image');
            $img_file = time()."_".$img->getClientOriginalName();
            $dir_img = 'img/motorcycle';
            $img->move($dir_img,$img_file);

            $data->image = $img_file;
            $data->save();
            toast('Data unit berhasil disimpan','success');
            return redirect()->back();
        }else{
            $data->save();
            toast('Data unit berhasil disimpan','success');
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
        Unit::find($id)->delete();
        toast('Data unit berhasil dihapus','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        Unit::whereIn('id',$req->pilih)->delete();
        toast('Data unit berhasil dihapus','success');
        return redirect()->back();
    }
}
