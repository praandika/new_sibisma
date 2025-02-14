<?php

namespace App\Http\Controllers;

use App\Exports\GenerateQR;
use App\Models\Warehouse;
use App\Http\Controllers\Controller;
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
        return view('page', compact('start','end'));
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

    public function entry($code, $wId){
        $cek = Warehouse::where('code', $code)->count();
        if ($cek > 0) {
            return redirect()->route('warehouse.detail', ['code' => $code, 'wId' => $wId]);
        } else {
            $today = Carbon::now('GMT+8')->format('Y-m-d');
            $gudang = WarehouseName::where('id', $wId)->pluck('name');
            $gudang = $gudang[0];
            $dc = Auth::user()->dealer_code;
            $firstName = Auth::user()->first_name;
            $dealerName = Dealer::where('dealer_code',$dc)->pluck('dealer_name');
            $dealerName = $dealerName[0];
            $thisYear = Carbon::now('GMT+8')->format('Y');
            $lastYear = $thisYear - 1;
            $unit = Unit::where('year_mc',$thisYear)
            ->join('colors','units.color_id','colors.id')
            ->orWhere('year_mc',$lastYear)
            ->orderBy('model_name', 'asc')
            ->orderBy('year_mc','desc')
            ->select('units.id','units.model_name','colors.color_name','colors.color_code','units.year_mc')
            ->get();
            return view('page', compact('code','dealerName','firstName','wId','gudang','unit','dc','lastYear','today'));
        }
    }

    public function out(){
        // 
    }

    public function detail($code, $wId){
        $data = Warehouse::join('colors','warehouses.color_name','colors.color_name')
        ->where('warehouses.code', $code)
        ->select('warehouses.id','warehouses.code','warehouses.model_name','warehouses.color_name','warehouses.gudang','warehouses.year_mc','warehouses.in_date','warehouses.engine_no','warehouses.frame_no','warehouses.pic','warehouses.status','colors.color_code', 'warehouses.note')
        ->get();

        $id = Warehouse::where('warehouses.code', $code)->sum('id');
        $gudang = Warehouse::where('warehouses.code', $code)->pluck('gudang');
        $gudang = $gudang[0];

        $dataGudang = WarehouseName::all();

        return view('page', compact('data', 'code', 'wId', 'id','gudang','dataGudang'));
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
        $lastCode = Warehouse::where('dealer_code', $dealer)
        ->orderBy('code','desc')->first();

        $gudang = WarehouseName::all();
        return view('page', compact('dealer','lastCode','dealerName','gudang'));
    }

    public function generating(Request $req){
        
        $date = Carbon::now('GMT+8')->format('YmdHis');
        $dealer = Auth::user()->dealer_code;
        $baris = $req->baris;
        $gudang = $req->gudang_id;
        // dd($gudang);
        
        return (new GenerateQR)->dealer($dealer)->date($date)->baris($baris)->gudang($gudang)->download('Generate_QR_'.$dealer.'-'.$date.'.xlsx');
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
        $data->frame_no = $req->frame_no;
        $data->engine_no = $req->engine_no;
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
