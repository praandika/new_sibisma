<?php

namespace App\Http\Controllers;

use App\Models\STU;
use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class STUController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $yesterday = Carbon::yesterday('GMT+8')->format('Y-m-d');
        $data = STU::join('dealers','s_t_u_s.dealer_code','=','dealers.dealer_code')
        ->where('stu_date',$yesterday)
        ->orderBy('stu_date','desc')
        ->get();
        return view('page',compact('data'));
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
    public function store(Request $request)
    {
        for ($i=0; $i < count($request->dealer_code); $i++) { 
            STU::insert([
                'stu_date' => $request->stu_date,
                'dealer_code' => $request->dealer_code[$i],
                'stu' => $request->stu[$i],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
        toast('Data STU berhasil disimpan','success');
        return redirect()->route('stu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\STU  $sTU
     * @return \Illuminate\Http\Response
     */
    public function show(STU $sTU)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\STU  $sTU
     * @return \Illuminate\Http\Response
     */
    public function edit(STU $sTU)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\STU  $sTU
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, STU $sTU)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\STU  $sTU
     * @return \Illuminate\Http\Response
     */
    public function destroy(STU $sTU)
    {
        //
    }

    public function delete($id){
        STU::find($id)->delete();
        toast('Data stu berhasil dihapus','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        STU::whereIn('id',$req->pilih)->delete();
        toast('Data stu berhasil dihapus','success');
        return redirect()->back();
    }

    // PAGE Show All Achievment
    public function achievement(){
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m');
        $year = Carbon::now('GMT+8')->format('Y');
        $tgl = Carbon::now('GMT+8');
        $yesterday = Carbon::yesterday('GMT+8')->format('Y-m-d');

        $sentral = Dealer::where('dealer_code','AA0101')->sum('id');
        $cokro = Dealer::where('dealer_code','AA0102')->sum('id');
        $ud = Dealer::where('dealer_code','AA0104')->sum('id');
        $tts = Dealer::where('dealer_code','AA0105')->sum('id');
        $imbo = Dealer::where('dealer_code','AA0106')->sum('id');
        $mandiri = Dealer::where('dealer_code','AA0107')->sum('id');
        $wr = Dealer::where('dealer_code','AA0108')->sum('id');
        $sr = Dealer::where('dealer_code','AA0109')->sum('id');
        $fss = Dealer::where('dealer_code','AA0104F')->sum('id');
        $dalung = Dealer::where('dealer_code','AA0104-01')->sum('id');

        
        // Sentral
        $stu_01 = STU::where('dealer_code','AA0101')
        ->whereYear('stu_date',$year)
        ->whereMonth('stu_date',$month)
        ->where('stu_date','!=',$today)
        ->sum('stu');
        $real_01 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id',$sentral)
        ->whereYear('sale_date',$year)
        ->whereMonth('sale_date',$month)
        ->where('sale_date','!=',$today)
        ->sum('sale_qty');
            
        // Cokro
        $stu_02 = STU::where('dealer_code','AA0102')
        ->whereYear('stu_date',$year)
        ->whereMonth('stu_date',$month)
        ->where('stu_date','!=',$today)
        ->sum('stu');
        $real_02 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id',$cokro)
        ->whereYear('sale_date',$year)
        ->whereMonth('sale_date',$month)
        ->where('sale_date','!=',$today)
        ->sum('sale_qty');

        // UD
        $stu_04 = STU::where('dealer_code','AA0104')
        ->whereYear('stu_date',$year)
        ->whereMonth('stu_date',$month)
        ->where('stu_date','!=',$today)
        ->sum('stu');
        $real_04 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id',$ud)
        ->whereYear('sale_date',$year)
        ->whereMonth('sale_date',$month)
        ->where('sale_date','!=',$today)
        ->sum('sale_qty');

        // TTS
        $stu_05 = STU::where('dealer_code','AA0105')
        ->whereYear('stu_date',$year)
        ->whereMonth('stu_date',$month)
        ->where('stu_date','!=',$today)
        ->sum('stu');
        $real_05 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id',$tts)
        ->whereYear('sale_date',$year)
        ->whereMonth('sale_date',$month)
        ->where('sale_date','!=',$today)
        ->sum('sale_qty');

        // Imbo
        $stu_06 = STU::where('dealer_code','AA0106')
        ->whereYear('stu_date',$year)
        ->whereMonth('stu_date',$month)
        ->where('stu_date','!=',$today)
        ->sum('stu');
        $real_06 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id',$imbo)
        ->whereYear('sale_date',$year)
        ->whereMonth('sale_date',$month)
        ->where('sale_date','!=',$today)
        ->sum('sale_qty');

        // Mandiri
        $stu_07 = STU::where('dealer_code','AA0107')
        ->whereYear('stu_date',$year)
        ->whereMonth('stu_date',$month)
        ->where('stu_date','!=',$today)
        ->sum('stu');
        $real_07 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id',$mandiri)
        ->whereYear('sale_date',$year)
        ->whereMonth('sale_date',$month)
        ->where('sale_date','!=',$today)
        ->sum('sale_qty');

        // WR
        $stu_08 = STU::where('dealer_code','AA0108')
        ->whereYear('stu_date',$year)
        ->whereMonth('stu_date',$month)
        ->where('stu_date','!=',$today)
        ->sum('stu');
        $real_08 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id',$wr)
        ->whereYear('sale_date',$year)
        ->whereMonth('sale_date',$month)
        ->where('sale_date','!=',$today)
        ->sum('sale_qty');

        // SR
        $stu_09 = STU::where('dealer_code','AA0109')
        ->whereYear('stu_date',$year)
        ->whereMonth('stu_date',$month)
        ->where('stu_date','!=',$today)
        ->sum('stu');
        $real_09 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id',$sr)
        ->whereYear('sale_date',$year)
        ->whereMonth('sale_date',$month)
        ->where('sale_date','!=',$today)
        ->sum('sale_qty');

        // Dalung
        $stu_0401 = STU::where('dealer_code','AA0104-01')
        ->whereYear('stu_date',$year)
        ->whereMonth('stu_date',$month)
        ->where('stu_date','!=',$today)
        ->sum('stu');
        $real_0401 = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id',$dalung)
        ->whereYear('sale_date',$year)
        ->whereMonth('sale_date',$month)
        ->where('sale_date','!=',$today)
        ->sum('sale_qty');

        // FSS
        $stu_04F = STU::where('dealer_code','AA0104')
        ->whereYear('stu_date',$year)
        ->whereMonth('stu_date',$month)
        ->where('stu_date','!=',$today)
        ->sum('stu');
        $real_04F = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id',$sentral)
        ->whereYear('sale_date',$year)
        ->whereMonth('sale_date',$month)
        ->where('sale_date','!=',$today)
        ->sum('sale_qty');
        
        // Bisma Group
        $stu = STU::where('dealer_code','!=','AA0104F')
        ->whereYear('stu_date',$year)
        ->whereMonth('stu_date',$month)
        ->where('stu_date','!=',$today)
        ->sum('stu');
        $real = Sale::join('stocks','sales.stock_id','stocks.id')
        ->where('stocks.dealer_id','!=',$fss)
        ->whereYear('sale_date',$year)
        ->whereMonth('sale_date',$month)
        ->where('sale_date','!=',$today)
        ->sum('sale_qty');

        // Bisma Group + FSS
        $stuPlus = STU::whereYear('stu_date',$year)
        ->whereMonth('stu_date',$month)
        ->where('stu_date','!=',$today)
        ->sum('stu');
        $realPlus = Sale::join('stocks','sales.stock_id','stocks.id')
        ->whereYear('sale_date',$year)
        ->whereMonth('sale_date',$month)
        ->where('sale_date','!=',$today)
        ->sum('sale_qty');

        // Sentral
        if ($stu_01 == 0) {
            $vs_01 = 0*100;
        } else {
            $get_vs_01 = ($real_01 / $stu_01); 
            $vs_01 = ($get_vs_01 - 1)*100;
        }

        // Cokro
        if ($stu_02 == 0) {
            $vs_02 = 0*100;
        } else {
            $get_vs_02 = ($real_02 / $stu_02); 
            $vs_02 = ($get_vs_02 - 1)*100;
        }

        // UD
        if ($stu_04 == 0) {
            $vs_04 = 0*100;
        } else {
            $get_vs_04 = ($real_04 / $stu_04); 
            $vs_04 = ($get_vs_04 - 1)*100;
        }

        // TTS
        if ($stu_05 == 0) {
            $vs_05 = 0*100;
        } else {
            $get_vs_05 = ($real_05 / $stu_05); 
            $vs_05 = ($get_vs_05 - 1)*100;
        }

        // Imbo
        if ($stu_06 == 0) {
            $vs_06 = 0*100;
        } else {
            $get_vs_06 = ($real_06 / $stu_06); 
            $vs_06 = ($get_vs_06 - 1)*100;
        }

        // Mandiri
        if ($stu_07 == 0) {
            $vs_07 = 0*100;
        } else {
            $get_vs_07 = ($real_07 / $stu_07); 
            $vs_07 = ($get_vs_07 - 1)*100;
        }

        // WR
        if ($stu_08 == 0) {
            $vs_08 = 0*100;
        } else {
            $get_vs_08 = ($real_08 / $stu_08); 
            $vs_08 = ($get_vs_08 - 1)*100;
        }

        // SR
        if ($stu_09 == 0) {
            $vs_09 = 0*100;
        } else {
            $get_vs_09 = ($real_09 / $stu_09); 
            $vs_09 = ($get_vs_09 - 1)*100;
        }

        // Dalung
        if ($stu_0401 == 0) {
            $vs_0401 = 0*100;
        } else {
            $get_vs_0401 = ($real_0401 / $stu_0401); 
            $vs_0401 = ($get_vs_0401 - 1)*100;
        }

        // FSS
        if ($stu_04F == 0) {
            $vs_04F = 0*100;
        } else {
            $get_vs_04F = ($real_04F / $stu_04F); 
            $vs_04F = ($get_vs_04F - 1)*100;
        }

        // Bisma Group
        if ($stu == 0) {
            $vs = 0*100;
        } else {
            $get_vs = ($real / $stu); 
            $vs = ($get_vs - 1)*100;
        }

        // Bisma Group + FSS
        if ($stuPlus == 0) {
            $vsPlus = 0*100;
        } else {
            $get_vsPlus = ($realPlus / $stuPlus); 
            $vsPlus = ($get_vsPlus - 1)*100;
        }

        $vs_01 = number_format($vs_01, 1);
        $vs_02 = number_format($vs_02, 1);
        $vs_04 = number_format($vs_04, 1);
        $vs_05 = number_format($vs_05, 1);
        $vs_06 = number_format($vs_06, 1);
        $vs_07 = number_format($vs_07, 1);
        $vs_08 = number_format($vs_08, 1);
        $vs_09 = number_format($vs_09, 1);
        $vs_0401 = number_format($vs_0401, 1);
        $vs_04F = number_format($vs_04F, 1);
        $vs = number_format($vs, 1);
        $vsPlus = number_format($vsPlus, 1);
        return view('page', compact(
            'stu_01','real_01','vs_01',
            'stu_02','real_02','vs_02',
            'stu_04','real_04','vs_04',
            'stu_05','real_05','vs_05',
            'stu_06','real_06','vs_06',
            'stu_07','real_07','vs_07',
            'stu_08','real_08','vs_08',
            'stu_09','real_09','vs_09',
            'stu_0401','real_0401','vs_0401',
            'stu_04F','real_04F','vs_04F',
            'stu','real','vs',
            'stuPlus','realPlus','vsPlus',
            'yesterday'
        ));
    }
}
