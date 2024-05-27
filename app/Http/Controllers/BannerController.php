<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Banner::all();
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

        $data = new Banner;
        $data->title = $req->title;
        $data->link = $req->link;
        $data->status = 'active';
        if ($req->image == '') {
            $data->image = 'banner.png';
            $data->save();
            toast('Data banner berhasil disimpan','success');
            return redirect()->back()->with('display', true);
        } else {
            $img = $req->file('image');
            $img_file = time()."_".$img->getClientOriginalName();
            $dir_img = 'img/banner';
            $img->move($dir_img,$img_file);
            $data->image = $img_file;
            $data->save();
            toast('Data banner berhasil disimpan','success');
            return redirect()->back()->with('display', true);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        return view('page', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('page', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Banner $banner)
    {
        $data = Banner::find($banner->id);
        $data->title = $req->title;
        $data->link = $req->link;
        $data->status = $req->status;
        if ($req->hasfile('image')) {
            if ($data->image != '' && $data->image != 'banner.png') {
                $img_prev = $req->img_prev;
                unlink('img/banner/'.$img_prev);
            }

            $img = $req->file('image');
            $img_file = time()."_".$img->getClientOriginalName();
            $dir_img = 'img/banner';
            $img->move($dir_img,$img_file);

            $data->image = $img_file;
            $data->save();
            toast('Data banner berhasil diubah','success');
            return redirect()->back();
        }else{
            $data->save();
            toast('Data banner berhasil diubah','success');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        //
    }

    public function changeStatusBanner($id, $status){
        $data = Banner::where('id',$id)->first();
        if ($status == 'active') {
            $data->status = 'archive';
        } else {
            $data->status = 'active';
        }
        
        $data->update();
        toast('Status berhasil diubah','success');
        return redirect()->back();
    }

    public function delete($id){
        Banner::find($id)->delete();
        toast('Data banner berhasil dihapus','success');
        return redirect()->back();
    }

    public function sendBanner() {
        $data = Banner::where('status', 'active')
        ->get();
        return BannerResource::collection($data);
    }
}
