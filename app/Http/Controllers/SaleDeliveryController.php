<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDelivery;
use App\Models\Manpower;
use App\Models\Dealer;
use App\Models\Log;
use App\Models\Spk;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleDeliveryController extends Controller
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
        $time = Carbon::now('GMT+8')->format('h:i:s');

        $year = Carbon::now('GMT+8')->format('Y');

        if ($dc == 'group') {
            $data = SaleDelivery::join('sales','sale_deliveries.sale_id','sales.id')
            ->join('stocks','sales.stock_id','stocks.id')
            ->whereYear('sales.sale_date',$year)
            ->orderBy('sale_delivery_date','desc')
            ->select('*','sale_deliveries.id as delivery_id','sale_deliveries.status as delivery_status')->get();
            $manpower = Manpower::where('position','Driver')->get();
            $sale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->whereYear('sales.sale_date',$year)
            ->where([
                ['sales.status','pending'],
                ['sales.frame_no','!=',null],
            ])
            ->orderBy('sales.sale_date','desc')
            ->select('sales.*','stocks.unit_id')->get();
            return view('page', compact('data','manpower','today','sale','time'));
        }else{
            $data = SaleDelivery::join('sales','sale_deliveries.sale_id','sales.id')
            ->join('stocks','sales.stock_id','stocks.id')
            ->whereYear('sales.sale_date',$year)
            ->where('stocks.dealer_id',$did)
            ->orderBy('sale_delivery_date','desc')
            ->select('*','sale_deliveries.id as delivery_id','sale_deliveries.status as delivery_status')->get();

            $manpower = Manpower::where('position','Driver')
            ->where('dealer_id',$did)->get();
            $sale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->whereYear('sales.sale_date',$year)
            ->where([
                ['stocks.dealer_id',$did],
                ['sales.status','pending'],
                ['sales.frame_no','!=',null],
            ])
            ->orderBy('sales.sale_date','desc')
            ->select('sales.*','stocks.unit_id')->get();
            return view('page', compact('data','manpower','today','sale','time'));
        }
    }

    // ***** CREATE DO --> HALAMAN DATA SALES
    public function createDo($spk_id){
        $data = SaleDelivery::where('spk_id', $spk_id)->firstOrFail();
        return view('page', compact($data));
    }

    // ***** PROSES STORE DO AND UPDATE DO DATE ON SPKS --> HALAMAN SHOW SALES
    public function processDo(Request $request, $spk_no){
        // ==========================================
        // 1. VALIDASI INPUT
        // ==========================================

        $request->validate([
            'self_pickup'   => 'nullable|boolean',
            'driver_name'   => 'nullable|string|max:100',
            'backup_driver' => 'nullable|string|max:100',
            'notes'         => 'nullable|string',
        ]);


        // ==========================================
        // 2. CEK SELF PICKUP
        // ==========================================

        $selfPickup = $request->boolean('self_pickup');


        // ==========================================
        // 3. JIKA BUKAN AMBIL SENDIRI
        //    DRIVER WAJIB DIISI
        // ==========================================

        if (!$selfPickup && !$request->filled('driver_name')) {

            toast('Nama sopir wajib diisi jika unit dikirim.','warning');
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Nama sopir wajib diisi jika unit dikirim.'
                );
        }


        try {

            $deliveryOrder = DB::transaction(function () use (
                $request,
                $spk_no,
                $selfPickup
            ) {

                // ==========================================
                // 4. AMBIL SPK
                // ==========================================

                $spk = Spk::where('spk_no', $spk_no)
                    ->lockForUpdate()
                    ->first();

                if (!$spk) {
                    throw new \Exception(
                        'Data SPK tidak ditemukan.'
                    );
                }


                // ==========================================
                // 5. SPK HARUS SUDAH SOLD
                // ==========================================

                if (strtoupper($spk->order_status) !== 'SOLD') {

                    throw new \Exception(
                        'SPK belum berstatus SOLD.'
                    );
                }


                // ==========================================
                // 6. AMBIL DATA SALES
                // ==========================================

                $sale = Sale::where('spk_no', $spk_no)
                    ->lockForUpdate()
                    ->first();

                if (!$sale) {

                    throw new \Exception(
                        'Data Sales untuk SPK ' .
                        $spk_no .
                        ' tidak ditemukan.'
                    );
                }


                // ==========================================
                // 7. CEK DO SUDAH ADA ATAU BELUM
                // ==========================================

                $existingDo = SaleDelivery::where(
                    'spk_no',
                    $spk_no
                )->first();

                if ($existingDo) {

                    throw new \Exception(
                        'Delivery Order untuk SPK ' .
                        $spk_no .
                        ' sudah dibuat.'
                    );
                }


                // ==========================================
                // 8. BUAT DELIVERY ORDER
                // ==========================================

                $deliveryOrder = new SaleDelivery;
                $deliveryOrder->spk_no = $spk->spk_no;
                $deliveryOrder->sale_id = $sale->id;
                $deliveryOrder->dealer_code = $spk->dealer_code;
                $deliveryOrder->do_date = now();


                // ==========================================
                // 9. SELF PICKUP
                // ==========================================

                $deliveryOrder->self_pickup = $selfPickup ? 1 : 0;


                // ==========================================
                // 10. DRIVER
                // ==========================================

                if ($selfPickup) {

                    // CUSTOMER AMBIL SENDIRI

                    $deliveryOrder->driver_name = null;
                    $deliveryOrder->backup_driver = null;

                } else {

                    // UNIT DIKIRIM

                    $deliveryOrder->driver_name =
                        trim($request->driver_name);

                    $deliveryOrder->backup_driver =
                        $request->filled('backup_driver')
                            ? trim($request->backup_driver)
                            : null;
                }


                // ==========================================
                // 11. CATATAN
                // ==========================================

                $deliveryOrder->notes =
                    $request->filled('notes')
                        ? trim($request->notes)
                        : null;


                // ==========================================
                // 12. STATUS DELIVERY
                // ==========================================

                $deliveryOrder->status = 'PROCESS';


                // ==========================================
                // 13. USER PEMBUAT DO
                // ==========================================

                $deliveryOrder->created_by = Auth::id();


                // ==========================================
                // 14. SAVE DELIVERY ORDER
                // ==========================================

                $deliveryOrder->save();


                // ==========================================
                // 15. UPDATE SPK
                // ==========================================

                $spk->delivery_status = 'PROCESS';
                $spk->order_status = 'DELIVERY';
                $spk->do_date = now();

                $spk->save();


                // ==========================================
                // RETURN DATA DO
                // ==========================================

                return $deliveryOrder;
            });


            // ==========================================
            // 16. BERHASIL
            // ==========================================

            toast('DO berhasil dibuat.','success');
            return redirect()
                ->route(
                    'do.print',
                    $deliveryOrder->spk_no
                );

        } catch (\Throwable $e) {

            // ==========================================
            // 18. ERROR
            // ==========================================

            toast($e->getMessage(),'error');
            return redirect()->back();
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
        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SaleDelivery $saleDelivery)
    {
        return view('page', compact('saleDelivery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleDelivery $saleDelivery)
    {
        $manpower = Manpower::where('position','Driver')->get();
        return view('page', compact('saleDelivery','manpower'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, SaleDelivery $saleDelivery)
    {
        $data = SaleDelivery::find($saleDelivery->id);
        $data->main_driver = $req->main_driver;
        $data->backup_driver = $req->backup_driver;
        $data->note = $req->note;
        $data->updated_by = Auth::user()->id;
        $data->save();

        // Write log
        $log = new Log;
        $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
        $log->activity = 'updates sale deliveries data';
        $log->user_id = Auth::user()->id;
        $log->save();

        toast('Data sale delivery berhasil diubah','success');
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

    public function delete($id){
        $sale_id = SaleDelivery::where('id',$id)
        ->pluck('sale_id');
        $sale_id = $sale_id[0];
        
        SaleDelivery::find($id)->delete();

        // Update Sale Status
        $sale = Sale::find($sale_id);
        $sale->status = 'pending';
        $sale->update();

        // Write log
        $log = new Log;
        $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
        $log->activity = 'deletes sale deliveries data';
        $log->user_id = Auth::user()->id;
        $log->save();

        toast('Data sale delivery berhasil dihapus','success');
        return redirect()->back();
    }

    public function history(Request $req){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        $year = Carbon::now('GMT+8')->format('Y');

        $start = $req->start;
        $end = $req->end;
        if ($start == null && $end == null) {
            if ($dc == 'group') {
                $data = SaleDelivery::join('sales','sale_deliveries.sale_id','sales.id')
                ->join('stocks','sales.stock_id','stocks.id')
                ->whereYear('sales.sale_date',$year)
                ->orderBy('sale_delivery_date','desc')
                ->select('*','sale_deliveries.id as delivery_id','sale_deliveries.status as delivery_status')->get();
            }else{
                $data = SaleDelivery::join('sales','sale_deliveries.sale_id','sales.id')
                ->join('stocks','sales.stock_id','stocks.id')
                ->whereYear('sales.sale_date',$year)
                ->where('stocks.dealer_id',$did)
                ->orderBy('sale_delivery_date','desc')
                ->select('*','sale_deliveries.id as delivery_id','sale_deliveries.status as delivery_status')->get();
            }
        } else {
            if ($dc == 'group') {
                $data = SaleDelivery::join('sales','sale_deliveries.sale_id','sales.id')
                ->join('stocks','sales.stock_id','stocks.id')
                ->whereBetween('sale_delivery_date',[$req->start, $req->end])
                ->orderBy('sale_delivery_date','desc')
                ->select('*','sale_deliveries.id as delivery_id','sale_deliveries.status as delivery_status')->get();
            }else{
                $data = SaleDelivery::join('sales','sale_deliveries.sale_id','sales.id')
                ->join('stocks','sales.stock_id','stocks.id')
                ->where('stocks.dealer_id',$did)
                ->whereBetween('sale_delivery_date',[$req->start, $req->end])
                ->orderBy('sale_delivery_date','desc')
                ->select('*','sale_deliveries.id as delivery_id','sale_deliveries.status as delivery_status')->get();
            }
            
        }
        return view('page', compact('data','start','end'));
    }
}
