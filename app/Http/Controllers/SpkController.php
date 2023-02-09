<?php

namespace App\Http\Controllers;

use App\Models\Spk;
use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Leasing;
use App\Models\Manpower;
use App\Models\Stock;
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
        $today = Carbon::now('GMT+8')->format('Y-m-d');


        if ($dc == 'group') {
            $stock = Stock::orderBy('qty','desc')->get();
            $manpower = Manpower::join('dealers','manpowers.dealer_id','=','dealers.id')
            ->where('manpowers.category','SAL')
            ->select('manpowers.id as id_manpower','manpowers.name','manpowers.position','manpowers.gender','dealers.dealer_code')
            ->get();
            $data = Spk::join('stocks','spks.stock_id','stocks.id')
            ->join('users','spks.created_by','users.id')
            ->where('credit_status','survey')
            ->orWhere('order_status','indent')
            ->orderBy('spks.id','desc')
            ->select('*','spks.id as id_spk','users.first_name','spks.phone as customer_phone')->get();
            $countManpower = Manpower::count();
            if ($countManpower <= 0) {
                alert()->warning('Add Manpower','Manpower data is not available!');
                return redirect()->route('manpower.index');
            } else {
                return view('page', compact('stock','leasing','today','data','manpower','spk_no'));
            }
        }else{
            $stock = Stock::where('dealer_id',$did)->orderBy('qty','desc')->get('stocks.*');
            $manpower = Manpower::join('dealers','manpowers.dealer_id','=','dealers.id')
            ->where([
                ['manpowers.dealer_id',$did],
                ['manpowers.category','SAL']
            ])
            ->select('manpowers.id as id_manpower','manpowers.name','manpowers.position','manpowers.gender','dealers.dealer_code')
            ->get();

            $dealerCode = $dc;
            $data = Spk::join('stocks','spks.stock_id','stocks.id')
            ->join('users','spks.created_by','users.id')
            ->join('dealers','stocks.dealer_id','dealers.id')
            ->where('dealers.dealer_code',$dc)
            ->where(function($query){
                $query->where('credit_status','survey')
                      ->orWhere('order_status','indent');
            })
            ->orderBy('spks.id','desc')
            ->select('*','spks.id as id_spk','users.first_name','spks.phone as customer_phone')->get();
            $countManpower = Manpower::where('dealer_id',$did)
            ->count();
            if ($countManpower <= 0) {
                alert()->warning('Add Manpower','Manpower data is not available!');
                return redirect()->route('manpower.index');
            } else {
                return view('page', compact('stock','leasing','today','data','manpower','dealerCode','spk_no'));
            }
        }
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

        if ($request->payment_method == 'cash') {
            $credit_status = 'cash';
            $leasing = 1;
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
        $data->phone = $request->phone;
        $data->stnk_name = strtoupper($request->stnk_name);
        $data->stock_id = $request->stock_id;
        $data->downpayment = $request->downpayment;
        $data->discount = $discount;
        $data->payment = $request->payment;
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
            ->where('manpowers.category','SAL')
            ->select('manpowers.id as id_manpower','manpowers.name','manpowers.position','manpowers.gender','dealers.dealer_code')
            ->get();
        } else {
            $stock = Stock::where('dealer_id',$did)->orderBy('qty','desc')->get('stocks.*');
            $manpower = Manpower::join('dealers','manpowers.dealer_id','=','dealers.id')
            ->where([
                ['manpowers.dealer_id',$did],
                ['manpowers.category','SAL']
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

        if ($request->payment_method == 'cash') {
            $credit_status = 'cash';
            $leasing = 1;
        } else {
            $credit_status = $request->credit_status;
            $leasing = $request->leasing_id;
        }

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
                }
            }
        }

        $data = Spk::find($spk->id);
        $data->spk_no = $request->spk_no;
        $data->spk_date = $request->spk_date;
        $data->order_name = $request->order_name;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->stnk_name = $request->stnk_name;
        $data->stock_id = $request->stock_id;
        $data->downpayment = $request->downpayment;
        $data->discount = $discount;
        $data->payment = $request->payment;
        $data->leasing_id = $leasing;
        $data->manpower_id = $request->manpower_id;
        $data->description = $request->description;
        $data->payment_method = $request->payment_method;
        $data->credit_status = $credit_status;
        $data->order_status = $request->order_status;
        $data->sale_status = $request->sale_status;
        $data->ktp = $ktp_file;
        $data->created_by = Auth::user()->id;
        $data->update();
        toast('SPK berhasil diubah','success');
        return redirect()->route('spk.get',$request->spk_no);
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

        $start = $req->start;
        $end = $req->end;
        if ($start == null && $end == null) {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('users','spks.created_by','users.id')
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','users.first_name','spks.phone as customer_phone')->limit(50)->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('users','spks.created_by','users.id')
                ->where('stocks.dealer_id',$did)
                ->orderBy('spks.id','desc')
                ->select('*','spks.id as id_spk','users.first_name','spks.phone as customer_phone')->limit(50)->get();
            }
            
        } else {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('users','spks.created_by','users.id')
                ->whereBetween('spk_date',[$req->start, $req->end])
                ->orderBy('spk_date','desc')
                ->select('*','spks.id as id_spk','users.first_name','spks.phone as customer_phone')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('users','spks.created_by','users.id')
                ->where('stocks.dealer_id',$did)
                ->whereBetween('spk_date',[$req->start, $req->end])
                ->orderBy('spk_date','desc')
                ->select('*','spks.id as id_spk','users.first_name','spks.phone as customer_phone')->get();
            }
        }
        return view('page', compact('data','start','end'));
    }

    public function get($spk_no){
        $data = Spk::join('stocks','spks.stock_id','=','stocks.id')
        ->join('leasings','spks.leasing_id','=','leasings.id')
        ->join('manpowers','spks.manpower_id','=','manpowers.id')
        ->select('*','spks.address as customer_address','spks.phone as customer_phone')
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
        ->select('*','spks.address as customer_address','spks.phone as customer_phone')
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
        ->select('*','spks.address as customer_address','spks.phone as customer_phone')
        ->where('spks.spk_no',$spk_no)
        ->get();
        $printDate = Carbon::now('GMT+8')->format('j F Y H:i:s');

        $pdf = PDF::loadView('export.pdf-spk',compact('data','spk_no','printDate','dealer'));
        $pdf->setPaper('A5', 'landscape');
        return $pdf->download('spk_'.$spk_no.'.pdf');
    }
}
