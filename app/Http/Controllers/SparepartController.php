<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use App\Http\Controllers\Controller;
use App\Http\Resources\SparepartCategoryResource;
use App\Http\Resources\SparepartResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Sparepart::all();
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
        $req->validate([
            'image' => 'image|mimes:jpeg,png,jpg',
        ]);

        $data = new Sparepart();
        $data->parts_name = $req->parts_name;
        $data->category = $req->category;
        $data->year_parts = $req->year_parts;
        $data->price = $req->price;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        if ($req->image == '') {
            $data->image = 'noimage.jpg';
            $data->save();
            toast('Data sparepart berhasil disimpan','success');
            return redirect()->back()->with('display', true);
        } else {
            $img = $req->file('image');
            $img_file = time()."_".$img->getClientOriginalName();
            $dir_img = 'img/sparepart';
            $img->move($dir_img,$img_file);
            $data->image = $img_file;
            $data->save();
            toast('Data sparepart berhasil disimpan','success');
            return redirect()->back()->with('display', true);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sparepart  $sparepart
     * @return \Illuminate\Http\Response
     */
    public function show(Sparepart $sparepart)
    {
        return view('page', compact('sparepart'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sparepart  $sparepart
     * @return \Illuminate\Http\Response
     */
    public function edit(Sparepart $sparepart)
    {
        return view('page', compact('sparepart'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sparepart  $sparepart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Sparepart $sparepart)
    {
        $data = Sparepart::find($sparepart->id);
        $data->parts_name = $req->parts_name;
        $data->category = $req->category;
        $data->year_parts = $req->year_parts;
        $data->price = $req->price;
        if ($req->hasfile('image')) {
            if ($data->image != '' && $data->image != 'noimage.jpg') {
                $img_prev = $req->img_prev;
                unlink('img/sparepart/'.$img_prev);
            }

            $img = $req->file('image');
            $img_file = time()."_".$img->getClientOriginalName();
            $dir_img = 'img/sparepart';
            $img->move($dir_img,$img_file);

            $data->image = $img_file;
            $data->save();
            toast('Data sparepart berhasil disimpan','success');
            return redirect()->back();
        }else{
            $data->save();
            toast('Data sparepart berhasil disimpan','success');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sparepart  $sparepart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sparepart $sparepart)
    {
        //
    }

    public function delete($id){
        Sparepart::find($id)->delete();
        toast('Data sparepart berhasil dihapus','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        Sparepart::whereIn('id',$req->pilih)->delete();
        toast('Data sparepart berhasil dihapus','success');
        return redirect()->back();
    }

    public function sendParts(){
        $data = Sparepart::all();
        return SparepartResource::collection($data);
    }

    public function sendPartsCat($cat){
        $data = Sparepart::where('category', $cat)
        ->get();
        return SparepartResource::collection($data);
    }

    public function sendPartsCategory(){
        $data = Sparepart::groupBy('category')
        ->get();
        return SparepartCategoryResource::collection($data);
    }
}
