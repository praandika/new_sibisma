<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

        $mesin = Specification::where('model_name','Aerox 155')->pluck('mesin');
        if (count($mesin) > 0) {
            $mesin = json_decode($mesin[0], true);
        }

        $rangka = Specification::where('model_name','Aerox 155')->pluck('rangka');
        if (count($rangka) > 0) {
            $rangka = json_decode($rangka[0], true);
        }

        $data = Specification::select('model_name','mesin','rangka','dimensi','kelistrikan','id')
        ->get();
        return view('page', compact('data','dataUnit','mesin','rangka'));
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
        Specification::insert([
            'model_name' => $req->model_name,
            'mesin' => json_encode($dataMesin),
            'rangka' => json_encode($dataRangka)
        ]);
        toast('Data color berhasil disimpan','success');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specification  $specification
     * @return \Illuminate\Http\Response
     */
    public function edit(Specification $specification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specification  $specification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specification $specification)
    {
        //
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
}
