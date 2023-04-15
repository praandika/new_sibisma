<?php

namespace App\Http\Controllers;

use App\Models\Spk;
use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Dealer;
use App\Models\Leasing;
use App\Models\Manpower;
use App\Models\Stock;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class SpkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = SPK::count();
        $random = Carbon::now('GMT+8')->format('HmsYmd');
        
        $dc = Auth::user()->dealer_code;
        
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        $spk_no = 'SPK'.$count.$random.$dc;

        $leasing = Leasing::all();
        $microfinance = Leasing::where('leasing_category','!=','credit')->get();
        $today = Carbon::now('GMT+8')->format('Y-m-d');

        $yearNow = Carbon::now('GMT+8')->format('Y');
        $yearBefore = $yearNow - 1;

        $unitData = Unit::where('year_mc',$yearNow)
        ->orWhere('year_mc',$yearBefore)
        ->groupBy('model_name')
        ->get();

        $colorData = Color::all();

        if ($dc == 'group') {
            $stock = Stock::orderBy('qty','desc')->get();
            $manpower = Manpower::join('dealers','manpowers.dealer_id','=','dealers.id')
            ->where([
                ['manpowers.category','SAL'],
                ['manpowers.status','active']
            ])
            ->select('manpowers.id as id_manpower','manpowers.name','manpowers.position','manpowers.gender','dealers.dealer_code')
            ->get();
            $data = Spk::join('stocks','spks.stock_id','stocks.id')
            ->join('units','stocks.unit_id','units.id')
            ->join('colors','units.color_id','colors.id')
            ->join('manpowers','spks.manpower_id','manpowers.id')
            ->join('dealers','stocks.dealer_id','dealers.id')
            ->where('credit_status','survey')
            ->orWhere('order_status','indent')
            ->orderBy('spks.id','desc')
            ->select('spks.order_status','spks.credit_status','spks.payment_method','spks.spk_date','spks.sale_status','spks.spk_no','spks.order_name','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone','colors.color_code','units.model_name','dealers.dealer_code')->get();
            $countManpower = Manpower::count();
            if ($countManpower <= 0) {
                alert()->warning('Add Manpower','Manpower data is not available!');
                return redirect()->route('manpower.index');
            } else {
                return view('page', compact('stock','leasing','today','data','manpower','spk_no','unitData','colorData','microfinance'));
            }
            
        }else{
            $dealerCode = $dc;
            $stock = Stock::where('dealer_id',$did)->orderBy('qty','desc')->get('stocks.*');
            
            $manpower = Manpower::join('dealers','manpowers.dealer_id','=','dealers.id')
            ->where([
                ['manpowers.dealer_id',$did],
                ['manpowers.category','SAL'],
                ['manpowers.status','active']
            ])
            ->select('manpowers.id as id_manpower','manpowers.name','manpowers.position','manpowers.gender','dealers.dealer_code')
            ->get();

            $data = Spk::join('stocks','spks.stock_id','stocks.id')
            ->join('units','stocks.unit_id','units.id')
            ->join('colors','units.color_id','colors.id')
            ->join('manpowers','spks.manpower_id','manpowers.id')
            ->join('dealers','stocks.dealer_id','dealers.id')
            ->where('dealers.dealer_code',$dc)
            ->where(function($query){
                $query->where('credit_status','survey')
                ->orWhere('order_status','indent');
            })
            ->orderBy('spks.id','desc')
            ->select('spks.order_status','spks.credit_status','spks.payment_method','spks.spk_date','spks.sale_status','spks.spk_no','spks.order_name','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone','colors.color_code','units.model_name')->get();

            $countManpower = Manpower::where('dealer_id',$did)
            ->count();
            if ($countManpower <= 0) {
                alert()->warning('Add Manpower','Manpower data is not available!');
                return redirect()->route('manpower.index');
            } else {
                return view('page', compact('stock','leasing','today','data','manpower','dealerCode','spk_no','unitData','colorData','microfinance'));
            }
        }
    }

    public function spkSalesman(){
        $count = SPK::count();
        $random = Carbon::now('GMT+8')->format('HmsYmd');
        
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        $dealerCode = $dc;

        $spk_no = 'SPK'.$count.$random.$dc;

        $leasing = Leasing::all();
        $microfinance = Leasing::where('leasing_category','!=','credit')->get();
        $today = Carbon::now('GMT+8')->format('Y-m-d');

        $yearNow = Carbon::now('GMT+8')->format('Y');
        $yearBefore = $yearNow - 1;

        $unitData = Unit::where('year_mc',$yearNow)
        ->orWhere('year_mc',$yearBefore)
        ->groupBy('model_name')
        ->get();

        $colorData = Color::all();
        $stock = Stock::where('dealer_id',$did)->orderBy('qty','desc')->get('stocks.*');

        $manpowerID = Manpower::where('user_id',Auth::user()->id)->sum('id');
        $manpowerName = Manpower::where('user_id',Auth::user()->id)->pluck('name');
        $manpowerName = $manpowerName[0];
        

        $data = Spk::join('stocks','spks.stock_id','stocks.id')
        ->join('units','stocks.unit_id','units.id')
        ->join('colors','units.color_id','colors.id')
        ->join('manpowers','spks.manpower_id','manpowers.id')
        ->join('dealers','stocks.dealer_id','dealers.id')
        ->where('spks.manpower_id',$manpowerID)
        ->where(function($query){
            $query->where('credit_status','survey')
            ->orWhere('order_status','indent');
        })
        ->orderBy('spks.id','desc')
        ->select('spks.order_status','spks.credit_status','spks.payment_method','spks.spk_date','spks.sale_status','spks.spk_no','spks.order_name','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone','colors.color_code','units.model_name')->get();

        return view('page', compact('stock','leasing','today','data','manpowerID','manpowerName','dealerCode','spk_no','unitData','colorData','microfinance'));
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
        if ($request->discount == '') {
            $discount = 0;
        } else {
            $discount = $request->discount;
        }

        if ($request->tandajadi == '') {
            $tandajadi = 0;
        } else {
            $tandajadi = $request->tandajadi;
        }

        if ($request->payment_method == 'cash') {
            $credit_status = 'cash';
            $leasing = $request->leasing_id_cash;
        } else {
            $credit_status = $request->credit_status;
            $leasing = $request->leasing_id;
        }
        
        
        // Get KTP image
        if ($request->picture != '') {
            $img = $request->file('picture');
            $ktp_file = time()."_".$img->getClientOriginalName();
            $dir_img = 'img/ktp';
            $img->move($dir_img,$ktp_file);
        } elseif ($request->photo != '') {
            $img = $request->file('photo');
            $ktp_file = time()."_".$img->getClientOriginalName();
            $dir_img = 'img/ktp';
            $img->move($dir_img,$ktp_file);
        } elseif ($request->picture != '' && $request->photo != '') {
            $img = $request->file('picture');
            $ktp_file = time()."_".$img->getClientOriginalName();
            $dir_img = 'img/ktp';
            $img->move($dir_img,$ktp_file);
        } else {
            $ktp_file = 'noimage.jpg';
        }
        

        $data = new Spk;
        $data->spk_no = $request->spk_no;
        $data->spk_date = $request->spk_date;
        $data->order_name = strtoupper($request->order_name);
        $data->address = strtoupper($request->address);
        $data->spk_phone = $request->phone;
        $data->stnk_name = strtoupper($request->stnk_name);
        $data->stock_id = $request->stock_id;
        $data->tandajadi = $tandajadi;
        $data->downpayment = $request->downpayment;
        $data->discount = $discount;
        $data->leasing_id = $leasing;
        $data->manpower_id = $request->manpower_id;
        $data->description = strtoupper($request->description);
        $data->payment_method = $request->payment_method;
        $data->credit_status = $credit_status;
        $data->order_status = $request->order_status;
        $data->sale_status = 'pending';
        $data->ktp = $ktp_file;
        $data->created_by = Auth::user()->id;
        $data->save();
        toast('SPK berhasil dibuat','success');
        return redirect()->route('spk.get',$request->spk_no);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spk  $spk
     * @return \Illuminate\Http\Response
     */
    public function show(Spk $spk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spk  $spk
     * @return \Illuminate\Http\Response
     */
    public function edit(Spk $spk)
    {
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        $leasing = Leasing::where('leasing_code','!=','CASH')->get();

        if ($dc == 'group') {
            $stock = Stock::orderBy('qty','desc')->get();
            $manpower = Manpower::join('dealers','manpowers.dealer_id','=','dealers.id')
            ->where([
                ['manpowers.category','SAL'],
                ['manpowers.status','active']
            ])
            ->select('manpowers.id as id_manpower','manpowers.name','manpowers.position','manpowers.gender','dealers.dealer_code')
            ->get();
        } else {
            $stock = Stock::where('dealer_id',$did)->orderBy('qty','desc')->get('stocks.*');
            $manpower = Manpower::join('dealers','manpowers.dealer_id','=','dealers.id')
            ->where([
                ['manpowers.dealer_id',$did],
                ['manpowers.category','SAL'],
                ['manpowers.status','active']
            ])
            ->select('manpowers.id as id_manpower','manpowers.name','manpowers.position','manpowers.gender','dealers.dealer_code')
            ->get();
        }
        return view('page', compact('spk','stock','manpower','leasing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spk  $spk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spk $spk)
    {
        if ($request->discount == '') {
            $discount = 0;
        } else {
            $discount = $request->discount;
        }

        if ($request->tandajadi == '') {
            $tandajadi = 0;
        } else {
            $tandajadi = $request->tandajadi;
        }

        if ($request->payment_method == 'cash') {
            $credit_status = 'cash';
            $leasing = 1;
        } else {
            $credit_status = $request->credit_status;
            $leasing = $request->leasing_id;
        }

        $data = Spk::find($spk->id);
        $data->spk_no = $request->spk_no;
        $data->spk_date = $request->spk_date;
        $data->order_name = strtoupper($request->order_name);
        $data->address = strtoupper($request->address);
        $data->spk_phone = $request->phone;
        $data->stnk_name = strtoupper($request->stnk_name);
        $data->stock_id = $request->stock_id;
        $data->tandajadi = $tandajadi;
        $data->downpayment = $request->downpayment;
        $data->discount = $discount;
        $data->payment = $request->payment;
        $data->leasing_id = $leasing;
        $data->manpower_id = $request->manpower_id;
        $data->description = strtoupper($request->description);
        $data->payment_method = $request->payment_method;
        $data->credit_status = $credit_status;
        $data->order_status = $request->order_status;
        $data->sale_status = $request->sale_status;
        $data->created_by = Auth::user()->id;

        if ($request->ktp_file_prev == '' || $request->ktp_file_prev == null) {
            // Get KTP image and Store
            if ($request->picture != '') {
                $img = $request->file('picture');
                $ktp_file = time()."_".$img->getClientOriginalName();
                $dir_img = 'img/ktp';
                $img->move($dir_img,$ktp_file);
            } elseif ($request->photo != '') {
                $img = $request->file('photo');
                $ktp_file = time()."_".$img->getClientOriginalName();
                $dir_img = 'img/ktp';
                $img->move($dir_img,$ktp_file);
            } elseif ($request->picture != '' && $request->photo != '') {
                $img = $request->file('picture');
                $ktp_file = time()."_".$img->getClientOriginalName();
                $dir_img = 'img/ktp';
                $img->move($dir_img,$ktp_file);
            } else {
                $ktp_file = 'noimage.jpg';
            }

        $data->ktp = $ktp_file;
        $data->update();
        toast('SPK berhasil diubah','success');
        return redirect()->route('spk.get',$request->spk_no);

        } else {
            //  Get KTP image and update
            if ($request->picture != '') {
                if ($request->hasfile('picture')) {
                    if ($request->ktp_file_prev != '' && $request->ktp_file_prev != 'noimage.jpg') {
                        $img_prev = $request->ktp_file_prev;
                        unlink('img/ktp/'.$img_prev);
                    }
        
                    $img = $request->file('picture');
                    $ktp_file = time()."_".$img->getClientOriginalName();
                    $dir_img = 'img/ktp';
                    $img->move($dir_img,$ktp_file);

        $data->ktp = $ktp_file;
        $data->update();
        toast('SPK berhasil diubah','success');
        return redirect()->route('spk.get',$request->spk_no);

                }
            } elseif ($request->photo != '') {
                if ($request->hasfile('photo')) {
                    if ($request->ktp_file_prev != '' && $request->ktp_file_prev != 'noimage.jpg') {
                        $img_prev = $request->ktp_file_prev;
                        unlink('img/ktp/'.$img_prev);
                    }
        
                    $img = $request->file('photo');
                    $ktp_file = time()."_".$img->getClientOriginalName();
                    $dir_img = 'img/ktp';
                    $img->move($dir_img,$ktp_file);
            
        $data->ktp = $ktp_file;
        $data->update();
        toast('SPK berhasil diubah','success');
        return redirect()->route('spk.get',$request->spk_no);

                }
            } elseif ($request->picture != '' && $request->photo != '') {
                if ($request->hasfile('picture')) {
                    if ($request->ktp_file_prev != '' && $request->ktp_file_prev != 'noimage.jpg') {
                        $img_prev = $request->ktp_file_prev;
                        unlink('img/ktp/'.$img_prev);
                    }
        
                    $img = $request->file('picture');
                    $ktp_file = time()."_".$img->getClientOriginalName();
                    $dir_img = 'img/ktp';
                    $img->move($dir_img,$ktp_file);

        $data->ktp = $ktp_file;
        $data->update();
        toast('SPK berhasil diubah','success');
        return redirect()->route('spk.get',$request->spk_no);
                }
            } else {
                $data->update();
                toast('SPK berhasil diubah','success');
                return redirect()->route('spk.get',$request->spk_no);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spk  $spk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spk $spk)
    {
        //
    }

    public function history(Request $req){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        $yearNow = Carbon::now('GMT+8')->format('Y');
        $yearBefore = $yearNow - 1;

        $unitData = Unit::where('year_mc',$yearNow)
        ->orWhere('year_mc',$yearBefore)
        ->groupBy('model_name')
        ->get();

        $colorData = Color::all();

        $start = $req->start;
        $end = $req->end;
        if ($start == null && $end == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->join('dealers','stocks.dealer_id','dealers.id')
                ->orderBy('spks.id','desc')
                ->select('spks.order_status','spks.credit_status','spks.payment_method','spks.spk_date','spks.sale_status','spks.spk_no','spks.order_name','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone','colors.color_code','units.model_name','dealers.dealer_code')->limit(50)->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->join('dealers','stocks.dealer_id','dealers.id')
                ->where('stocks.dealer_id',$did)
                ->orderBy('spks.id','desc')
                ->select('spks.order_status','spks.credit_status','spks.payment_method','spks.spk_date','spks.sale_status','spks.spk_no','spks.order_name','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone','colors.color_code','units.model_name')->limit(50)->get();
            }
            
        } else {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->join('dealers','stocks.dealer_id','dealers.id')
                ->whereBetween('spk_date',[$req->start, $req->end])
                ->orderBy('spk_date','desc')
                ->select('spks.order_status','spks.credit_status','spks.payment_method','spks.spk_date','spks.sale_status','spks.spk_no','spks.order_name','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone','colors.color_code','units.model_name','dealers.dealer_code')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->join('dealers','stocks.dealer_id','dealers.id')
                ->where('stocks.dealer_id',$did)
                ->whereBetween('spk_date',[$req->start, $req->end])
                ->orderBy('spk_date','desc')
                ->select('spks.order_status','spks.credit_status','spks.payment_method','spks.spk_date','spks.sale_status','spks.spk_no','spks.order_name','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone','colors.color_code','units.model_name')->get();
            }
        }
        return view('page', compact('data','start','end','unitData','colorData'));
    }

    public function get($spk_no){
        $data = Spk::join('stocks','spks.stock_id','=','stocks.id')
        ->join('leasings','spks.leasing_id','=','leasings.id')
        ->join('units','stocks.unit_id','units.id')
        ->join('colors','units.color_id','colors.id')
        ->join('manpowers','spks.manpower_id','manpowers.id')
        ->join('dealers','stocks.dealer_id','dealers.id')
        ->select('spks.order_status','spks.credit_status','spks.payment_method','spks.spk_date','spks.sale_status','spks.spk_no','spks.order_name','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone','colors.color_code','units.model_name','colors.color_faktur','units.price','spks.address as customer_address','spks.stnk_name','leasings.leasing_code','spks.description','spks.ktp','spks.tandajadi','spks.downpayment','spks.discount','spks.payment')
        ->where('spks.spk_no',$spk_no)
        ->get();

        return view('page', compact('data','spk_no'));
    }

    public function printPDF($spk_no){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        $dealer = Dealer::where('dealer_code',$dc)->get();

        $data = Spk::join('stocks','spks.stock_id','=','stocks.id')
        ->join('leasings','spks.leasing_id','=','leasings.id')
        ->join('manpowers','spks.manpower_id','=','manpowers.id')
        ->select('*','spks.address as customer_address','spks.spk_phone as customer_phone')
        ->where('spks.spk_no',$spk_no)
        ->get();
        $printDate = Carbon::now('GMT+8')->format('j F Y H:i:s');

        $pdf = PDF::loadView('export.pdf-spk',compact('data','spk_no','printDate','dealer'));
        $pdf->setPaper('A5', 'landscape');
        return $pdf->stream('spk_'.$spk_no.'.pdf');
    }

    public function downloadPDF($spk_no){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        $dealer = Dealer::where('dealer_code',$dc)->get();

        $data = Spk::join('stocks','spks.stock_id','=','stocks.id')
        ->join('leasings','spks.leasing_id','=','leasings.id')
        ->join('manpowers','spks.manpower_id','=','manpowers.id')
        ->select('*','spks.address as customer_address','spks.spk_phone as customer_phone')
        ->where('spks.spk_no',$spk_no)
        ->get();
        $printDate = Carbon::now('GMT+8')->format('j F Y H:i:s');

        $pdf = PDF::loadView('export.pdf-spk',compact('data','spk_no','printDate','dealer'));
        $pdf->setPaper('A5', 'landscape');
        return $pdf->download('spk_'.$spk_no.'.pdf');
    }

    public function ktpPDF($spk_no){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        $dealer = Dealer::where('dealer_code',$dc)->get();

        $data = Spk::join('stocks','spks.stock_id','=','stocks.id')
        ->join('leasings','spks.leasing_id','=','leasings.id')
        ->join('manpowers','spks.manpower_id','=','manpowers.id')
        ->select('*','spks.address as customer_address','spks.spk_phone as customer_phone')
        ->where('spks.spk_no',$spk_no)
        ->get();
        $printDate = Carbon::now('GMT+8')->format('j F Y H:i:s');

        $pdf = PDF::loadView('export.pdf-ktp',compact('data','spk_no','printDate','dealer'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('ktp_'.$spk_no.'.pdf');
    }

    public function delete($id){
        $spk_no = Spk::where('id',$id)->pluck('spk_no');
        $spk_no = $spk_no[0];

        $name = Spk::where('id',$id)->pluck('order_name');
        $name = $name[0];

        Spk::find($id)->delete();
        toast('Data spk '.$spk_no.' '.$name.' berhasil dihapus','success');
        return redirect()->back();
    }

    public function filter(Request $req){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        $yearNow = Carbon::now('GMT+8')->format('Y');
        $yearBefore = $yearNow - 1;

        $unitData = Unit::where('year_mc',$yearNow)
        ->orWhere('year_mc',$yearBefore)
        ->groupBy('model_name')
        ->get();

        $colorData = Color::all();

        $unit = $req->unit;
        $nameCustomer = $req->customerName;
        $color = $req->color;
        $creditStatus = $req->creditStatus;
        $paymentMethod = $req->paymentMethod;

        $unitName = $req->unitName;
        $colorName = $req->colorName;

        // Filter Payment Method
        if ($unit == null && $nameCustomer == null && $color == null && $creditStatus == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where('spks.payment_method',$paymentMethod)
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }
        
        // Filter Credit Status
        } elseif ($unit == null && $nameCustomer == null && $color == null && $paymentMethod == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where('spks.credit_status',$creditStatus)
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['spks.credit_status',$creditStatus],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Color
        } elseif ($unit == null && $nameCustomer == null && $creditStatus == null && $paymentMethod == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where('colors.color_code',$color)
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['colors.color_code',$color],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Name
        } elseif ($unit == null && $color == null && $creditStatus == null && $paymentMethod == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where('spks.order_name','like','%'.$nameCustomer.'%')
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Unit
        } elseif ($nameCustomer == null && $color == null && $creditStatus == null && $paymentMethod == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where('units.id',$unit)
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['units.id',$unit],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Unit & Name
        } elseif ($color == null && $creditStatus == null && $paymentMethod == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['units.id',$unit],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['units.id',$unit],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Unit & Color
        } elseif ($nameCustomer == null && $creditStatus == null && $paymentMethod == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['units.id',$unit],
                    ['colors.color_code',$color],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['units.id',$unit],
                    ['colors.color_code',$color],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }
        
        // Filter Unit & Credit Status
        } elseif ($nameCustomer == null && $color == null && $paymentMethod == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['units.id',$unit],
                    ['spks.credit_status',$creditStatus],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['units.id',$unit],
                    ['spks.credit_status',$creditStatus],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Unit & Payment Method
        } elseif ($nameCustomer == null && $color == null && $creditStatus == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['units.id',$unit],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['units.id',$unit],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Name & Color
        } elseif ($unit == null && $creditStatus == null && $paymentMethod == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['colors.color_code',$color],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['colors.color_code',$color],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Name & Credit Status
        } elseif ($unit == null && $color == null && $paymentMethod == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['spks.credit_status',$creditStatus],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['spks.credit_status',$creditStatus],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Name & Payment Method
        } elseif ($unit == null && $color == null && $creditStatus == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Color & Credit Status
        } elseif ($unit == null && $nameCustomer == null && $paymentMethod == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['colors.color_code',$color],
                    ['spks.credit_status',$creditStatus],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['colors.color_code',$color],
                    ['spks.credit_status',$creditStatus],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Color & Payment Method
        } elseif ($unit == null && $nameCustomer == null && $creditStatus == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['colors.color_code',$color],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['colors.color_code',$color],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Credit Status & Payment Method
        } elseif ($unit == null && $nameCustomer == null && $color == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['spks.credit_status',$creditStatus],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['spks.credit_status',$creditStatus],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Unit & Name & Color
        } elseif ($creditStatus == null && $paymentMethod == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['units.id',$unit],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['colors.color_code',$color],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['units.id',$unit],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['colors.color_code',$color],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Unit & Name & Credit Status
        } elseif ($color == null && $paymentMethod == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['units.id',$unit],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['spks.credit_status',$creditStatus],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['units.id',$unit],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['spks.credit_status',$creditStatus],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Unit & Name & Payment Method
        } elseif ($color == null && $creditStatus == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['units.id',$unit],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['units.id',$unit],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Unit & Color & Credit Status
        } elseif ($nameCustomer == null && $paymentMethod == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['units.id',$unit],
                    ['colors.color_code',$color],
                    ['spks.credit_status',$creditStatus],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['units.id',$unit],
                    ['colors.color_code',$color],
                    ['spks.credit_status',$creditStatus],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Unit & Color & Payment Method
        } elseif ($nameCustomer == null && $creditStatus == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['units.id',$unit],
                    ['colors.color_code',$color],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['units.id',$unit],
                    ['colors.color_code',$color],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Unit & Credit Status & Payment Method
        } elseif ($nameCustomer == null && $color == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['units.id',$unit],
                    ['spks.credit_status',$creditStatus],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['units.id',$unit],
                    ['spks.credit_status',$creditStatus],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Name & Color & Credit Status
        } elseif ($unit == null && $paymentMethod == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['colors.color_code',$color],
                    ['spks.credit_status',$creditStatus],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['colors.color_code',$color],
                    ['spks.credit_status',$creditStatus],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Name & Color & Payment Method
        } elseif ($unit == null && $creditStatus == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['colors.color_code',$color],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['colors.color_code',$color],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Color & Credit Status & Payment Method
        } elseif ($unit == null && $nameCustomer == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['colors.color_code',$color],
                    ['spks.credit_status',$creditStatus],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['colors.color_code',$color],
                    ['spks.credit_status',$creditStatus],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Unit & Name & Color & Credit Status
        } elseif ($paymentMethod == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['units.id',$unit],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['colors.color_code',$color],
                    ['spks.credit_status',$creditStatus],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['units.id',$unit],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['colors.color_code',$color],
                    ['spks.credit_status',$creditStatus],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Unit & Name & Color & Payment Method
        } elseif ($creditStatus == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['units.id',$unit],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['colors.color_code',$color],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['units.id',$unit],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['colors.color_code',$color],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Unit & Color & Credit Status & Payment Method
        } elseif ($nameCustomer == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['units.id',$unit],
                    ['colors.color_code',$color],
                    ['spks.credit_status',$creditStatus],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['units.id',$unit],
                    ['colors.color_code',$color],
                    ['spks.credit_status',$creditStatus],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Unit & Name & Credit Status & Payment Method
        } elseif ($color == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['units.id',$unit],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['spks.credit_status',$creditStatus],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['units.id',$unit],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['spks.credit_status',$creditStatus],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter Name & Color & Credit Status & Payment Method
        } elseif ($unit == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['colors.color_code',$color],
                    ['spks.credit_status',$creditStatus],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['colors.color_code',$color],
                    ['spks.credit_status',$creditStatus],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }

        // Filter All
        } elseif ($unit != null && $nameCustomer != null && $color != null && $creditStatus != null && $paymentMethod != null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['units.id',$unit],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['colors.color_code',$color],
                    ['spks.credit_status',$creditStatus],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where([
                    ['stocks.dealer_id',$did],
                    ['units.id',$unit],
                    ['spks.order_name','like','%'.$nameCustomer.'%'],
                    ['colors.color_code',$color],
                    ['spks.credit_status',$creditStatus],
                    ['spks.payment_method',$paymentMethod],
                ])
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->get();
            }
        }else {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->limit(50)->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->where('stocks.dealer_id',$did)
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone as customer_phone')->limit(50)->get();
            }
        }
        return view('page', compact('data','unitName','colorName','paymentMethod','creditStatus','paymentMethod','nameCustomer','unit','color','unitData','colorData'));
    }
}
