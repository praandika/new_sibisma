<?php

namespace App\Http\Controllers;

use App\Models\DeliveryOrder;
use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Sale;
use App\Models\SaleDelivery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class DeliveryOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page');
    }

    // DATA DELIVERY ORDER AJAX -> TABEL SALE DELIVERY
    public function doData(Request $request)
    {
        try {

            if (Auth::user()->dealer_code == 'group') {

                $query = SaleDelivery::with('spk');

            } else {

                $query = SaleDelivery::with('spk')
                    ->where('dealer_code', Auth::user()->dealer_code);
            }

            // =========================
            // SEARCH
            // =========================

            if ($request->filled('search')) {

                $keywords = preg_split('/\s+/', trim($request->search));

                foreach ($keywords as $keyword) {

                    $query->where(function ($q) use ($keyword) {

                        // SEARCH DI SALE DELIVERY
                        $q->Where('driver_name', 'like', "%{$keyword}%")
                            ->orWhere('notes', 'like', "%{$keyword}%")
                            ->orWhere('spk_no', 'like', "%{$keyword}%");

                        // SEARCH DI TABEL SPK
                        $q->orWhereHas('spk', function ($spk) use ($keyword) {

                            $spk->where('order_name', 'like', "%{$keyword}%")
                                ->orWhere('model_name', 'like', "%{$keyword}%")
                                ->orWhere('faktur_color', 'like', "%{$keyword}%")
                                ->orWhere('year_mc', 'like', "%{$keyword}%")
                                ->orWhere('ktp_number', 'like', "%{$keyword}%")
                                ->orWhere('kk_number', 'like', "%{$keyword}%")
                                ->orWhere('address', 'like', "%{$keyword}%")
                                ->orWhere('spk_phone', 'like', "%{$keyword}%")
                                ->orWhere('manpower', 'like', "%{$keyword}%")
                                ->orWhere('frame_no', 'like', "%{$keyword}%")
                                ->orWhere('engine_no', 'like', "%{$keyword}%")
                                ->orWhere('payment_method', 'like', "%{$keyword}%");

                        });

                    });

                }
            }

            // =========================
            // ORDER
            // =========================

            $query->orderBy('do_date', 'desc');

            // =========================
            // PAGINATION
            // =========================

            $data = $query->paginate(10);

            return response()->json([
                'dealer' => Auth::user()->dealer_code,
                'data'   => $data,
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function history(Request $req){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        $start = $req->start;
        $end = $req->end;
        if ($start == null && $end == null) {
            if ($dc == 'group') {
                $data = Sale::join('stocks','sales.stock_id','stocks.id')
                ->join('users','sales.created_by','users.id')
                ->orderBy('sales.id','desc')
                ->select('*','sales.id as id_sale','users.first_name')->limit(50)->get();
            }else{
                $data = Sale::join('stocks','sales.stock_id','stocks.id')
                ->join('users','sales.created_by','users.id')
                ->where('stocks.dealer_id',$did)
                ->orderBy('sales.id','desc')
                ->select('*','sales.id as id_sale','users.first_name')
                ->limit(50)->get();
            }
            
        } else {
            if ($dc == 'group') {
                $data = Sale::join('stocks','sales.stock_id','stocks.id')
                ->join('users','sales.created_by','users.id')
                ->whereBetween('sale_date',[$req->start, $req->end])
                ->orderBy('sales.id','desc')
                ->get();
            }else{
                $data = Sale::join('stocks','sales.stock_id','stocks.id')
                ->join('users','sales.created_by','users.id')
                ->where('stocks.dealer_id',$did)
                ->whereBetween('sale_date',[$req->start, $req->end])
                ->orderBy('sales.id','desc')
                ->get();
            }
        }
        return view('page', compact('data','start','end'));
    }

    public function printPDF($spk_no){
        $dc = Auth::user()->dealer_code;
        $dealer = Dealer::where('dealer_code',$dc)->firstOrFail();

        $data = SaleDelivery::where('spk_no', $spk_no)->firstOrFail();

        $printDate = Carbon::now('GMT+8')->format('j F Y H:i:s');

        $pdf = PDF::loadView('export.pdf-do',compact('data','printDate','dealer'));
        $pdf->setPaper('A5', 'potrait');
        return $pdf->stream('DO_'.$data->sale->customer_name.'-'.$data->sale->model_name.'.pdf');
    }

    public function downloadPDF($spk_no){
        $dc = Auth::user()->dealer_code;
        $dealer = Dealer::where('dealer_code',$dc)->firstOrFail();

        $data = SaleDelivery::where('spk_no', $spk_no)->firstOrFail();

        $printDate = Carbon::now('GMT+8')->format('j F Y H:i:s');

        $pdf = PDF::loadView('export.pdf-do',compact('data','printDate','dealer'));
        $pdf->setPaper('A5', 'potrait');
        
        return $pdf->download('DO_'.$data->sale->customer_name.'-'.$data->sale->model_name.'.pdf');
    }
}
