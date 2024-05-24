<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\SpecDimensiResource;
use App\Http\Resources\SpecKelistrikanResource;
use App\Http\Resources\SpecMesinResource;
use App\Http\Resources\SpecRangkaResource;
use App\Models\Specification;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year = Carbon::now()->format('Y');
         // Finding Unit ID where not in Specification's table
        $cekModel = Specification::pluck('model_name');

        $dataUnit = Unit::where('year_mc', $year)
        ->whereNotIn('model_name',$cekModel)
        ->groupBy('model_name')
        ->get();

        $data = Specification::select('model_name','mesin','rangka','dimensi','kelistrikan','id')
        ->get();

        return view('page', compact('data','dataUnit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        
        $dataMesin = [];
        for ($i=0; $i < count($req->mesin_title); $i++) { 
            $newDataMesin = [$req->mesin_title[$i] => $req->mesin_spec[$i]];
            $dataMesin += $newDataMesin;
        }

        $dataRangka = [];
        for ($i=0; $i < count($req->rangka_title); $i++) { 
            $newDataRangka = [$req->rangka_title[$i] => $req->rangka_spec[$i]];
            $dataRangka += $newDataRangka;
        }

        $dataDimensi = [];
        for ($i=0; $i < count($req->dimensi_title); $i++) { 
            $newDataDimensi = [$req->dimensi_title[$i] => $req->dimensi_spec[$i]];
            $dataDimensi += $newDataDimensi;
        }

        $dataKelistrikan = [];
        for ($i=0; $i < count($req->kelistrikan_title); $i++) { 
            $newDataKelistrikan = [$req->kelistrikan_title[$i] => $req->kelistrikan_spec[$i]];
            $dataKelistrikan += $newDataKelistrikan;
        }

        Specification::insert([
            'model_name' => $req->model_name,
            'mesin' => json_encode($dataMesin),
            'rangka' => json_encode($dataRangka),
            'dimensi' => json_encode($dataDimensi),
            'kelistrikan' => json_encode($dataKelistrikan),
            'created_by' => Auth::user()->id
        ]);

        toast('Data specification berhasil disimpan','success');
        return redirect()->route('specification.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Specification  $specification
     * @return \Illuminate\Http\Response
     */
    public function show(Specification $specification)
    {
        $mesin = Specification::where('model_name',str_replace('_', ' ', $specification->model_name))->pluck('mesin');
        if (count($mesin) > 0) {
            $mesin = json_decode($mesin[0], true);
        }

        $rangka = Specification::where('model_name',str_replace('_', ' ', $specification->model_name))->pluck('rangka');
        if (count($rangka) > 0) {
            $rangka = json_decode($rangka[0], true);
        }

        $dimensi = Specification::where('model_name',str_replace('_', ' ', $specification->model_name))->pluck('dimensi');
        if (count($dimensi) > 0) {
            $dimensi = json_decode($dimensi[0], true);
        }

        $kelistrikan = Specification::where('model_name',str_replace('_', ' ', $specification->model_name))->pluck('kelistrikan');
        if (count($kelistrikan) > 0) {
            $kelistrikan = json_decode($kelistrikan[0], true);
        }
        return view('page', compact('specification','mesin','rangka','dimensi','kelistrikan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specification  $specification
     * @return \Illuminate\Http\Response
     */
    public function edit(Specification $specification)
    {
        return view('page', compact('specification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specification  $specification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Specification $specification)
    {
        $data = Specification::find($specification->id);
        $data->mesin = $req->mesin;
        $data->rangka = $req->rangka;
        $data->dimensi = $req->dimensi;
        $data->kelistrikan = $req->kelistrikan;
        $data->update();
        toast('Data spesifikasi berhasil diupdate','success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specification  $specification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specification $specification)
    {
        //
    }

    public function delete($id){
        Specification::find($id)->delete();
        toast('Data specification berhasil dihapus','success');
        return redirect()->back();
    }

    public function sendSpecMesin($model) {
        $mesin = Specification::where('model_name',str_replace('_', ' ', $model))->select('mesin')->get();
        return SpecMesinResource::collection($mesin);
    }

    public function sendSpecRangka($model) {
        $rangka = Specification::where('model_name',str_replace('_', ' ', $model))->select('rangka')->get();

        return SpecRangkaResource::collection($rangka);
    }

    public function sendSpecDimensi($model) {
        $dimensi = Specification::where('model_name',str_replace('_', ' ', $model))->select('dimensi')->get();

        return SpecDimensiResource::collection($dimensi);
    }

    public function sendSpecKelistrikan($model) {
        $kelistrikan = Specification::where('model_name',str_replace('_', ' ', $model))->select('kelistrikan')->get();

        return SpecKelistrikanResource::collection($kelistrikan);
    }
}
