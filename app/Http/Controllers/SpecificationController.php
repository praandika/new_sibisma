<?php

namespace App\Http\Controllers;

use App\Models\Specification;
use App\Http\Controllers\Controller;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        Specification::insert([
            'model_name' => $req->model_name
        ]);

        for ($i=0; $i < count($req->mesin_title); $i++) { 
            $dataMesin = [$req->]
            Specification::insert([
                'mesin' => $req->color_name[$i],
                'color_faktur' => $req->color_faktur[$i],
                'color_code' => $req->color_code[$i],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
        toast('Data color berhasil disimpan','success');
        return redirect()->route('color.index');
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
