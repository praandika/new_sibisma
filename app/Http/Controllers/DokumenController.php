<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Sale;
use App\Models\Dealer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        $today = Carbon::now('GMT+8')->format('Y-m-d');

        if ($dc == 'group') {
            $sale = Sale::orderBy('sale_date','desc')->get();
            $data = Document::join('sales','documents.sale_id','sales.id')
            ->join('stocks','sales.stock_id','stocks.id')
            ->join('units','stocks.unit_id','units.id')
            ->join('users','documents.created_by','users.id')
            ->select('sales.sale_date', 'sales.customer_name', 'units.model_name', 'documents.stck', 'documents.stnk', 'documents.bpkb', 'sales.frame_no', 'documents.id as id', 'users.first_name','documents.nopol')
            ->limit(20)->get();
            return view('page', compact('data','today','sale'));
        }else{
            $sale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('stocks.dealer_id',$did)
            ->orderBy('sale_date','desc')->get();
            $data = Document::join('sales','documents.sale_id','sales.id')
            ->join('stocks','sales.stock_id','stocks.id')
            ->join('units','stocks.unit_id','units.id')
            ->join('users','documents.created_by','users.id')
            ->select('sales.sale_date', 'sales.customer_name', 'units.model_name', 'documents.stck', 'documents.stnk', 'documents.bpkb', 'sales.frame_no', 'documents.id as id', 'users.first_name','documents.nopol')
            ->where('stocks.dealer_id',$did)
            ->limit(20)->get();
            return view('page', compact('data','today','sale'));
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
    public function store(Request $req)
    {
        // Get Stok ID from Input
        $saleId = $req->sale_id;

            $data = new Document;
            $data->sale_id = $req->sale_id;
            $data->stck = $req->stck;
            $data->stnk = $req->stnk;
            $data->bpkb = $req->bpkb;
            $data->nopol = $req->nopol;
            $data->document_note = $req->document_note;
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;
            $data->save();

            // Update Sale Table
            $sale = Sale::where('id',$saleId)->first();
            $sale->nik = $req->nik;
            $sale->customer_name = $req->customer_name;
            $sale->phone = $req->phone;
            $sale->frame_no = $req->frame_no;
            $sale->engine_no = $req->engine_no;
            $sale->address = $req->address;
            $sale->updated_by = Auth::user()->id;
            $sale->save();

            toast('Data sale berhasil disimpan','success');
            return redirect()->back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        return view('page', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        return view('page', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Document $document)
    {

        //update document
        $data = Document::find($document->id);
        $data->stck = $req->stck;
        $data->stnk = $req->stnk;
        $data->bpkb = $req->bpkb;
        $data->nopol = $req->nopol;
        if($req->stck != 0)
        {
            $data->stck_status = 'finished';

            if($req->stnk != 0)
            {
                $data->stnk_status = 'finished';

                if($req->bpkb != 0)
                {
                    $data->bpkb_status = 'finished';
                }else{
                    $data->bpkb_status = 'on process';
                }
            }else{
                $data->stnk_status = 'on process';
            }
        }else{
            $data->stck_status = 'on process';
        }
        $data->document_note = $req->document_note;
        $data->save();

        //update sale
        $saleId = $req->sale_id;

        $sale = Sale::where('id',$saleId)->first();
        $sale->nik = $req->nik;
        $sale->customer_name = $req->customer_name;
        $sale->phone = $req->phone;
        $sale->frame_no = $req->frame_no;
        $sale->engine_no = $req->engine_no;
        $sale->address = $req->address;
        $sale->updated_by = Auth::user()->id;
        $sale->save();

        toast('Data unit berhasil disimpan','success');
        return redirect()->back();
        
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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
                $sale = Sale::orderBy('sale_date','desc')->get();
                $data = Document::join('sales','documents.sale_id','sales.id')
                ->join('stocks','sales.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('users','documents.created_by','users.id')
                ->select('sales.sale_date', 'sales.customer_name', 'units.model_name', 'documents.stck', 'documents.stnk', 'documents.bpkb', 'sales.frame_no', 'documents.id as id', 'users.first_name')
                ->limit(20)->get();
            }else{
                $sale = Sale::join('stocks','sales.stock_id','stocks.id')
                ->where('stocks.dealer_id',$did)
                ->orderBy('sale_date','desc')->get();
                $data = Document::join('sales','documents.sale_id','sales.id')
                ->join('stocks','sales.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('users','documents.created_by','users.id')
                ->select('sales.sale_date', 'sales.customer_name', 'units.model_name', 'documents.stck', 'documents.stnk', 'documents.bpkb', 'sales.frame_no', 'documents.id as id', 'users.first_name')
                ->where('stocks.dealer_id',$did)
                ->limit(20)->get();
            }
            
        } else {
            if ($dc == 'group') {
                $sale = Sale::orderBy('sale_date','desc')->get();
                $data = Document::join('sales','documents.sale_id','sales.id')
                ->join('stocks','sales.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('users','documents.created_by','users.id')
                ->whereBetween('sales.sale_date',[$req->start, $req->end])
                ->select('sales.sale_date', 'sales.customer_name', 'units.model_name', 'documents.stck', 'documents.stnk', 'documents.bpkb', 'sales.frame_no', 'documents.id as id', 'users.first_name')->get();
            }else{
                $sale = Sale::join('stocks','sales.stock_id','stocks.id')
                ->where('stocks.dealer_id',$did)
                ->orderBy('sale_date','desc')->get();
                $data = Document::join('sales','documents.sale_id','sales.id')
                ->join('stocks','sales.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('users','documents.created_by','users.id')
                ->whereBetween('sales.sale_date',[$req->start, $req->end])
                ->select('sales.sale_date', 'sales.customer_name', 'units.model_name', 'documents.stck', 'documents.stnk', 'documents.bpkb', 'sales.frame_no', 'documents.id as id', 'users.first_name')
                ->where('stocks.dealer_id',$did)->get();
            }
        }
        return view('page', compact('data','start','end'));
    }
}
