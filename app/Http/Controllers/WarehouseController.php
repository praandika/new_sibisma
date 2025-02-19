<?php

namespace App\Http\Controllers;

use App\Exports\GenerateQR;
use App\Models\Warehouse;
use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Unit;
use App\Models\WarehouseName;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dealer;
use App\Models\WarehouseSale;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $start = $req->start;
        $end = $req->end;
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        if ($start == null || $end == null) {
            $data = Warehouse::join('colors','warehouses.color_name','colors.color_name')
            ->where('in_date',$today)
            ->orderBy('in_date', 'desc')
            ->select('warehouses.*','colors.color_code')
            ->get();
        } else {
            $data = Warehouse::join('colors','warehouses.color_name','colors.color_name')
            ->whereBetween('in_date',[$start, $end])
            ->orderBy('in_date', 'desc')
            ->select('warehouses.*','colors.color_code')
            ->get();
        }

        return view('page', compact('start','end','data'));
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

    public function entry($code, $model, $color, $year){
        $cek = Warehouse::where('code', $code)->count();
        if ($cek > 0) {
            return redirect()->route('warehouse.detail', ['code' => $code]);
        } else {
            $model = str_replace('_', ' ', $model);
            $color = str_replace('_', ' ', $color);
            $today = Carbon::now('GMT+8')->format('Y-m-d');
            $gudang = WarehouseName::all();
            $dc = Auth::user()->dealer_code;
            $firstName = Auth::user()->first_name;
            $dealerName = Dealer::where('dealer_code',$dc)->pluck('dealer_name');
            $dealerName = $dealerName[0];
            $colorCode = Color::where('color_name',$color)->pluck('color_code');
            $colorCode = $colorCode[0];
            return view('page', compact('code','dealerName','firstName','gudang','model','dc','color','year','today','colorCode'));
        }
    }

    public function out(){
        // 
    }

    public function detail($code){
        $data = Warehouse::join('colors','warehouses.color_name','colors.color_name')
        ->where('warehouses.code', $code)
        ->select('warehouses.id','warehouses.code','warehouses.model_name','warehouses.color_name','warehouses.gudang','warehouses.year_mc','warehouses.in_date','warehouses.engine_no','warehouses.frame_no','warehouses.pic','warehouses.status','colors.color_code', 'warehouses.note')
        ->get();

        $id = Warehouse::where('warehouses.code', $code)->sum('id');
        $gudang = Warehouse::where('warehouses.code', $code)->pluck('gudang');
        $gudang = $gudang[0];

        $dataGudang = WarehouseName::all();

        return view('page', compact('data', 'code', 'id','gudang','dataGudang'));
    }

    public function sell($id){
        $today = Carbon::now('GMT+8')->format('Y-m-d');

        $sale = new WarehouseSale;
        $sale->warehouse_id = $id;
        $sale->sale_date = $today;
        $sale->status = "Idle";
        
        $data = Warehouse::find($id);
        $data->status = "Sold";
        $data->out_date = $today;
        $data->note = "Terjual";

        $sale->save();
        $data->update();

        toast('Sold!','success');
        return redirect()->back();
    }

    public function move(Request $req, $id){
        if ($req->new == $req->old) {
            toast('Pilih Gudang Lain, Unit sudah di '.$req->new,'warning');
            return redirect()->back();
        } else {
            $today = Carbon::now('GMT+8')->format('Y-m-d');

            $data = Warehouse::find($id);
            $data->status = "Move";
            $data->out_date = $today;
            $data->gudang = $req->new;
            $data->note = "Pindah dari ".$req->old." ke ".$req->new;

            $data->update();

            toast('Move to '.$req->new,'success');
            return redirect()->back();
        }
    }

    public function generate($dealer){
        $dealerName = Dealer::where('dealer_code',$dealer)->pluck('dealer_name');
        $dealerName = $dealerName[0];
        $yearNow = Carbon::now('GMT+8')->format('Y');
        $yearLast = $yearNow - 1;
        $unit = Unit::join('colors','units.color_id','colors.id')
        ->where('units.year_mc',$yearNow)
        ->orWhere('units.year_mc',$yearLast)
        ->orderBy('units.model_name','asc')
        ->select('units.model_name','units.year_mc','colors.color_name','colors.color_code')
        ->get();

        return view('page', compact('dealer','dealerName','unit','yearLast'));
    }

    public function generating(Request $req){
        
        $date = Carbon::now('GMT+8')->format('YmdHis');
        $dealer = Auth::user()->dealer_code;
        $baris = $req->baris;
        $year = $req->year;
        $model = str_replace(' ', '_', $req->model_name);
        $color = str_replace(' ', '_', $req->color);
        // dd($gudang);
        
        return (new GenerateQR)->dealer($dealer)->date($date)->baris($baris)->model($model)->color($color)->year($year)->download('Generate_QR_'.$dealer.'-'.$date.'.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $data = new Warehouse;
        $data->code = $req->code;
        $data->dealer_code = $req->dealer_code;
        $data->model_name = $req->model_name;
        $data->color_name = $req->color_name;
        $data->year_mc = $req->year_mc;
        $data->engine_no = strtoupper($req->engine_no);
        $data->in_date = $req->allocation_date;
        $data->gudang = $req->gudang;
        $data->pic = $req->pic;
        $data->status = "In Stock";
        $data->note = "Sampai di ".$req->gudang;
        $data->save();
        toast('Unit '.$req->model_name.' '.$req->color_name.'-'.$req->engine_no.' In Stock','success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        return view('page',compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        //
    }

    public function name(){
        $data = WarehouseName::all();
        return view('page',compact('data'));
    }

    public function wStore(Request $req){
        $data = new WarehouseName;
        $data->name = $req->name;
        $data->address = $req->address;
        $data->save();
        toast('Data Warehouse Name berhasil disimpan','success');
        return redirect()->route('warehousename.index')->with('display', true);
    }

    public function wEdit($id){
        $data = WarehouseName::where('id',$id)->first();
        return view('page',compact('data'));
    }

    public function wUpdate(Request $req){
        $data = WarehouseName::find($req->id);
        $data->name = $req->name;
        $data->address = $req->address;
        $data->update();
        toast('Data Warehouse Name berhasil diubah','success');
        return redirect()->back();
    }

    public function wDelete($id){
        WarehouseName::where('id',$id)->delete();
        toast('Data Warehouse Name berhasil dihapus','success');
        return redirect()->back();
    }
}
