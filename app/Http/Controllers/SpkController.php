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
use App\Models\Sale;
use App\Models\HistoryCredit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Prospect;
use App\Models\UnitOnHand;
use App\Models\MasterUnit;
use Illuminate\Support\Facades\DB;

class SpkController extends Controller
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
        $stock = Stock::join('units','stocks.unit_id','units.id')
            ->join('colors','units.color_id','colors.id')
            ->join('dealers','stocks.dealer_id','dealers.id')
            ->select('units.model_name','colors.color_name','colors.color_code','units.year_mc','stocks.qty','dealers.dealer_code','dealers.dealer_name','units.price','stocks.id as id')
            ->where('stocks.dealer_id',$did)
            ->orderBy('stocks.qty','desc')
            ->get();

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
        ->orderBy('spks.created_at','desc')
        ->select('spks.order_status','spks.credit_status','spks.payment_method','spks.spk_date','spks.sale_status','spks.spk_no','spks.order_name','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone','colors.color_code','units.model_name', 'spks.created_at')->get();

        return view('page', compact('stock','leasing','today','data','manpowerID','manpowerName','dealerCode','spk_no','unitData','colorData','microfinance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $random = Carbon::now('GMT+8')->format('YmdHisv');
        $dc = Auth::user()->dealer_code;
        $spk_no = 'SPK'.$random.$dc;
        $microfinance = Leasing::where('leasing_category','!=','credit')->get();
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        return view('page', compact('today', 'dc', 'spk_no','microfinance'));
    }

    // MODAL PROSPECT AJAX
    public function prospectSearch(Request $request)
    {
        $data = Prospect::query()
            ->where('dealer_code', Auth::user()->dealer_code)
            ->where('salesman', Auth::user()->name)
            ->where('status', '!=', 'spk');

        if ($request->filled('search')) {

            $keywords = preg_split(
                '/\s+/',
                trim($request->search)
            );

            foreach ($keywords as $keyword) {

                $data->where(function ($q) use ($keyword) {

                    $q->where('customer_name', 'like', "%{$keyword}%")
                        ->orWhere('phone', 'like', "%{$keyword}%")
                        ->orWhere('ktp_no', 'like', "%{$keyword}%")
                        ->orWhere('interest_type', 'like', "%{$keyword}%")
                        ->orWhere('interest_color', 'like', "%{$keyword}%")
                        ->orWhere('salesman', 'like', "%{$keyword}%")
                        ->orWhere('prospect_key', 'like', "%{$keyword}%");
                });

            }
        }

        $data = $data->orderBy('prospect_date', 'desc')
        ->paginate(10);

        return response()->json($data);
    }

    // DATA SPK AJAX
    public function spkData(Request $request)
    {
        try {
            $keywords = preg_split('/\s+/', trim($request->search));

            if (Auth::user()->access == 'salesman') {
                $query = Spk::query()
                ->where('dealer_code', Auth::user()->dealer_code)
                ->where('manpower', Auth::user()->name);
            } else if (Auth::user()->dealer_code == 'group'){
                $query = Spk::query();
            } else {
                $query = Spk::query()
                ->where('dealer_code', Auth::user()->dealer_code);
            }

            // SEARCH
            if ($request->filled('search')) {

                $keywords = preg_split('/\s+/', trim($request->search));

                foreach ($keywords as $keyword) {

                    $query->where(function ($q) use ($keyword) {

                        $q->where('order_name', 'like', "%{$keyword}%")
                        ->orWhere('ktp_number', 'like', "%{$keyword}%")
                        ->orWhere('payment_method', 'like', "%{$keyword}%")
                        ->orWhere('order_status', 'like', "%{$keyword}%")
                        ->orWhere('spk_no', 'like', "%{$keyword}%")
                        ->orWhere('model_name', 'like', "%{$keyword}%");
                    });

                }
            }

            // Lalu urutkan data
            $query->orderby('spk_date', 'asc');

            $data = $query->paginate(10);

            return response()->json([
                'dealer' => Auth::user()->dealer_code,
                'data'   => $data,
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ],500);

        }
    }

    // CEK STOCK AJAX
    public function checkStock(Request $request)
    {
        try {
            $search = $request->search;

            $data = UnitOnhand::query()
                ->where('model_name', $request->model)
                ->where('info', 'ready')
                ->where('status', 'onhand')
                ->where('faktur_color', $request->color)
                ->where('dealer_code', Auth::user()->dealer_code)
                ->when($search, function ($q) use ($search) {
                    $q->where('frame_no', 'like', "%{$search}%");
                })
                ->orderBy('receive_time', 'asc')
                ->paginate(10);

            return response()->json([
                'ready' => $data->total() > 0,
                'data'  => $data
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ],500);

        }
    }

    // MODAL DATA STOCK AJAX
    public function dataStock(Request $request)
    {
        try {
            $keywords = preg_split('/\s+/', trim($request->search));

            $query = UnitOnhand::query()
            ->join('dealers','unit_on_hands.dealer_code','=','dealers.dealer_code')
            ->where('unit_on_hands.info', 'ready')
            ->where('unit_on_hands.status', 'onhand')
            ->select(
                'unit_on_hands.*','dealers.dealer_name'
            );

            // Dealer Saya
            if($request->boolean('onlyDealer')){
                $query->where(
                    'unit_on_hands.dealer_code',
                    Auth::user()->dealer_code
                );
            }else{

                // Semua dealer
                $query->orderByRaw(
                    "CASE
                        WHEN unit_on_hands.dealer_code = ? THEN 0
                        ELSE 1
                    END",
                    [Auth::user()->dealer_code]
                );

            }

            // SEARCH
            if ($request->filled('search')) {

                $keywords = preg_split('/\s+/', trim($request->search));

                foreach ($keywords as $keyword) {

                    $query->where(function ($q) use ($keyword) {

                        $q->where('unit_on_hands.model_name', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.faktur_color', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.year_mc', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.dealer_code', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.frame_no', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.engine_no', 'like', "%{$keyword}%");

                    });

                }
            }

            // Lalu urutkan data di masing-masing dealer
            $query->orderBy('unit_on_hands.receive_time', 'desc');

            $data = $query->paginate(10);

            return response()->json([
                'dealer' => Auth::user()->dealer_code,
                'data'   => $data,
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ],500);

        }
    }

    // MODAL STOCK ONHAND WHERE MODEL TYPE ? AJAX ON REQUEST STOCK
    public function dataStockRequest(Request $request)
    {
        try {
            $keywords = preg_split('/\s+/', trim($request->search));

            $query = UnitOnhand::query()
            ->join('dealers','unit_on_hands.dealer_code','=','dealers.dealer_code')
            ->where('unit_on_hands.info', 'ready')
            ->where('unit_on_hands.status', 'onhand')
            ->where('unit_on_hands.dealer_code',Auth::user()->dealer_code)
            ->select(
                'unit_on_hands.*','dealers.dealer_name'
            );

            // FILTER BY MODEL NAME (dari faktur_color_filter di form edit)
            if ($request->filled('model_name')) {
                $query->where('unit_on_hands.model_name', $request->model_name);
            }

            // FILTER BY MODEL NAME (dari model_name_color di form edit)
            if ($request->filled('color')) {
                $query->where('unit_on_hands.faktur_color', $request->color);
            }

            // SEARCH
            if ($request->filled('search')) {

                $keywords = preg_split('/\s+/', trim($request->search));

                foreach ($keywords as $keyword) {

                    $query->where(function ($q) use ($keyword) {

                        $q->where('unit_on_hands.faktur_color', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.year_mc', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.frame_no', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.engine_no', 'like', "%{$keyword}%");

                    });

                }
            }

            // Lalu urutkan data di masing-masing dealer
            $query->orderBy('unit_on_hands.receive_time', 'desc');

            $data = $query->paginate(10);

            return response()->json([
                'dealer' => Auth::user()->dealer_code,
                'data'   => $data,
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ],500);

        }
    }

    // CEK HARGA MOTOR AJAX
    public function checkPrice(Request $request)
    {
        $unit = MasterUnit::where('model_name', $request->model)->first();

        return response()->json([
            'price' => $unit ? $unit->price : 0
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $today = Carbon::now('GMT+8')->format('Y-m-d');

        if ($request->discount == '') {
            $discount = 0;
        } else {
            $discount = $request->discount;
        }

        if ($request->deposit == '') {
            $deposit = 0;
        } else {
            $deposit = $request->deposit;
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

        $reason = "";
        if ($request->payment == 'CREDITCARD') {
            // Cek status kredit
            if($request->credit_status == 'acc'){
                $reason = 'ACC';
            } else if($request->credit_status == 'survey'){
                $reason = 'Mulai Survey';
            } else {
                $reason = "";
            }
        }

        $data = new Spk;
        $data->dealer_code = Auth::user()->dealer_code;
        $data->point_code = Auth::user()->dealer_code;
        $data->spk_no = $request->spk_no;
        $data->prospect_key = $request->prospect_key;
        $data->spk_date = $today;
        $data->prospect_date = $request->prospect_date;
        $data->order_name = strtoupper($request->customer_name);
        $data->gender = strtoupper($request->gender);
        $data->stnk_name = strtoupper($request->stnk_name);
        $data->model_name = strtoupper($request->model_name);
        $data->frame_no = strtoupper($request->frame_no);
        $data->engine_no = strtoupper($request->engine_no);
        $data->year_mc = $request->year;
        $data->price = preg_replace('/[^0-9]/', '', $request->price);
        $data->faktur_color = strtoupper($request->color);
        $data->address = strtoupper($request->address);
        $data->address_shipment = strtoupper($request->address_shipment);
        $data->spk_phone = $request->phone;
        $data->ktp_number = $request->ktp;
        $data->kk_number = $request->kk;
        $data->pemohon_name = strtoupper($request->pemohon_name);
        $data->deposit = $deposit;
        $data->downpayment = $request->downpayment;
        $data->discount = $discount;
        $data->leasing = strtoupper($request->leasing);
        $data->microfinance = strtoupper($request->microfinance);
        $data->manpower = $request->manpower;
        $data->description = strtoupper($request->description);
        $data->payment_method = $request->payment;
        $data->bunga = $request->bunga;
        $data->tenor = $request->tenor;
        $data->reason = strtoupper($reason);
        $data->credit_status = $request->credit_status;
        $data->order_status = strtoupper($request->order_status);
        $data->sale_status = 'pending';
        $data->ktp = $ktp_file;
        $data->created_by = Auth::user()->id;
        $data->save();
        toast('SPK berhasil dibuat','success');

        // UPDATE STATUS STOCK
        if ($request->filled('frame_no')) {
            $unit = UnitOnHand::where('frame_no', $request->frame_no)->first();

            if ($unit) {
                $unit->status = 'onhold';
                $unit->info = 'booked by '.Auth::user()->name.' - '.Auth::user()->dealer_code;
                $unit->save();
            }
        }

        // UPDATE STATUS PROSPECT
        if ($request->filled('prospect_key')) {
            $prospect = Prospect::where('prospect_key', $request->prospect_key)->first();

            if ($prospect) {
                $prospect->status = 'spk';
                $prospect->save();
            }
        }

        if ($request->payment == 'CREDITCARD') {
            $history = new HistoryCredit;
            $history->spk = $request->spk_no;
            $history->leasing = $request->leasing;
            $history->update_date = $today;
            $history->credit_status = $request->credit_status;
            $history->reason = $reason;
            $history->pemohon_name = strtoupper($request->pemohon_name);
            $history->save();
            toast('History Credit berhasil disimpan','success');
        }

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
        $leasing = Leasing::where('leasing_code','!=','CASH')->get();
        $microfinance = Leasing::where('leasing_category','!=','credit')->get();

        return view('page', compact('spk','leasing','microfinance'));
    }

    // REJECT REQUEST STOCK SPK
    public function rejectStock($spk_no, $dealer_code)
    {
        $data = Spk::where('spk_no', $spk_no)->first();

        if (!$data) {
            toast('SPK tidak ditemukan','error');
            return redirect()->back();
        }

        if ($data->order_status != 'REQUEST STOCK') {
            toast('SPK tidak dalam status REQUEST STOCK','error');
            return redirect()->back();
        }

        $data->order_status = 'REJECTED';
        $data->point_code = $dealer_code;
        $data->updated_by = Auth::user()->id;
        $data->save();

        toast('Request stock rejected','success');
        return redirect()->back();
    }

    // CHANGE STOCK ON REQUEST STOCK SPK
    public function changeStock($spk_no, $dealer_code, $model, $color)
    {
        $spk = Spk::where('spk_no', $spk_no)->get();
        return view('page', compact('spk','spk_no','dealer_code', 'model','color'));
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
        if ($request->request_type == 'request_stock') {

            // Request Stock Action
            $data = Spk::find($spk->id);
            $data->order_status = 'REQUEST STOCK';
            $data->model_name = strtoupper($request->model_name);
            $data->faktur_color = strtoupper($request->color);
            $data->year_mc = $request->year;
            $data->point_code = $request->point_code;
            $data->update();
            toast('Request stock berhasil dikirim','success');
            return redirect()->route('spk.get',$request->spk_no);

        } else {
            // Update SPK Action
            $today = Carbon::now('GMT+8')->format('Y-m-d');

            if ($request->discount == '') {
                $discount = 0;
            } else {
                $discount = $request->discount;
            }

            if ($request->deposit == '') {
                $deposit = 0;
            } else {
                $deposit = $request->deposit;
            }

            $data = Spk::find($spk->id);
            $data->order_name = strtoupper($request->customer_name);
            $data->gender = strtoupper($request->gender);
            $data->stnk_name = strtoupper($request->stnk_name);
            $data->model_name = strtoupper($request->model_name);
            $data->frame_no = strtoupper($request->frame_no);
            $data->engine_no = strtoupper($request->engine_no);
            $data->year_mc = $request->year;
            $data->price = preg_replace('/[^0-9]/', '', $request->price);
            $data->faktur_color = strtoupper($request->color);
            $data->address = strtoupper($request->address);
            $data->address_shipment = strtoupper($request->address_shipment);
            $data->spk_phone = $request->phone;
            $data->ktp_number = $request->ktp;
            $data->kk_number = $request->kk;
            $data->pemohon_name = strtoupper($request->pemohon_name);
            $data->deposit = $deposit;
            $data->downpayment = $request->downpayment;
            $data->discount = $discount;
            $data->leasing = strtoupper($request->leasing);
            $data->microfinance = strtoupper($request->microfinance);
            $data->description = strtoupper($request->description);
            $data->payment_method = $request->payment;
            $data->bunga = $request->bunga;
            $data->tenor = $request->tenor;
            $data->reason = strtoupper($request->reason);
            $data->credit_status = $request->credit_status;
            $data->order_status = strtoupper($request->order_status);
            $data->updated_by = Auth::user()->id;

            // Save Record to History Credit

            if ($request->payment_method == 'CREDITCARD') {
                $history = new HistoryCredit;
                $history->leasing_id = $request->leasing_id;
                $history->spk = $request->spk_no;
                $history->update_date = $today;
                $history->credit_status = $request->credit_status;
                $history->pemohon_name = strtoupper($request->pemohon_name);
                $history->reason = strtoupper($request->reason);
                $history->save();
                toast('History Credit berhasil disimpan','success');
            }

            // Upload KTP jika ada file baru
            if ($request->hasFile('picture')) {

                if ($data->ktp && $data->ktp != 'noimage.jpg') {
                    @unlink(public_path('img/ktp/'.$data->ktp));
                }

                $img = $request->file('picture');
                $ktpFile = time().'_'.$img->getClientOriginalName();
                $img->move(public_path('img/ktp'), $ktpFile);

                $data->ktp = $ktpFile;

            } elseif ($request->hasFile('photo')) {

                if ($data->ktp && $data->ktp != 'noimage.jpg') {
                    @unlink(public_path('img/ktp/'.$data->ktp));
                }

                $img = $request->file('photo');
                $ktpFile = time().'_'.$img->getClientOriginalName();
                $img->move(public_path('img/ktp'), $ktpFile);

                $data->ktp = $ktpFile;
            }

            // simpan semua perubahan
            $data->save();

            toast('SPK berhasil diubah','success');
            return redirect()->route('spk.get',$request->spk_no);
        } // End of Save Action
    }

    public function processChangeStock(Request $request, $spk, $dealer_code)
    {
        // UPDATE SPK
        $data = Spk::where('spk_no', $spk)->first();
        $data->model_name = strtoupper($request->model_name);
        $data->frame_no = strtoupper($request->frame_no);
        $data->engine_no = strtoupper($request->engine_no);
        $data->year_mc = $request->year;
        $data->price = preg_replace('/[^0-9]/', '', $request->price);
        $data->faktur_color = strtoupper($request->color);
        $data->order_status = strtoupper('READY');
        $data->point_code = $dealer_code;
        $data->updated_by = Auth::user()->id;
        $data->update();

        // UPDATE STOCK INFO
        $unit = UnitOnHand::where('frame_no', $request->frame_no)->first();
        $unit->point_code = $dealer_code;
        $unit->status = 'mutation';
        $unit->info = 'mutation from '.Auth::user()->dealer_code.' to '.$dealer_code;
        $unit->update();

        toast('Request Stock Approved','success');
        return redirect()->route('dashboard');
    }

    public function processSale($spk_no)
    {
        $spk = Spk::where('spk_no', $spk_no)->firstOrFail();

        // Cegah SPK diproses dua kali
        if ($spk->sales_status == 'SOLD') {
            toast('SPK sudah SOLD.', 'warning');

            return redirect()->back();
        }

        // Validasi data wajib
        if (
            blank($spk->ktp_number) ||
            blank($spk->spk_phone) ||
            blank($spk->address_shipment) ||
            blank($spk->frame_no) ||
            blank($spk->faktur_color) ||
            blank($spk->ktp) ||
            blank($spk->stnk_name)
        ) {
            toast('Data SPK belum lengkap.', 'error');

            return redirect()->back();
        }

        DB::transaction(function () use ($spk) {

            // INSERT SALES
            $sale = new Sale;
            $sale->spk_no = $spk->spk_no;
            $sale->dealer_code = $spk->dealer_code;
            $sale->customer_name = $spk->order_name;
            $sale->model_name = $spk->model_name;
            $sale->frame_no = $spk->frame_no;
            $sale->engine_no = $spk->engine_no;
            $sale->sale_date = now();
            $sale->created_by = Auth::id();
            $sale->save();

            // UPDATE SPK
            $spk->sales_status = 'SOLD';
            $spk->sold_date = now();
            $spk->save();

            // UPDATE UNIT ON HAND
            $unit = UnitOnhand::where(
                'frame_no',
                $spk->frame_no
            )->first();

            if ($unit) {
                $unit->status = 'sold';
                $unit->info = 'sold';
                $unit->save();
            }
        });

        toast('Penjualan berhasil diproses.', 'success');

        return redirect()->route('spk.get', $spk->spk_no);
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
                ->orderBy('spks.created_at','desc')
                ->select('spks.order_status','spks.credit_status','spks.payment_method','spks.spk_date','spks.sale_status','spks.spk_no','spks.order_name','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone','colors.color_code','units.model_name','dealers.dealer_code', 'spks.created_at')->limit(50)->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->join('dealers','stocks.dealer_id','dealers.id')
                ->where('stocks.dealer_id',$did)
                ->orderBy('spks.created_at','desc')
                ->select('spks.order_status','spks.credit_status','spks.payment_method','spks.spk_date','spks.sale_status','spks.spk_no','spks.order_name','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone','colors.color_code','units.model_name', 'spks.created_at')->limit(50)->get();
            }
            
        } else {
            if ($dc == 'group') {
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->join('dealers','stocks.dealer_id','dealers.id')
                ->whereBetween('spk_date',[$req->start, $req->end])
                ->orderBy('spks.created_at','desc')
                ->select('spks.order_status','spks.credit_status','spks.payment_method','spks.spk_date','spks.sale_status','spks.spk_no','spks.order_name','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone','colors.color_code','units.model_name','dealers.dealer_code', 'spks.created_at')->get();
            }else{
                $data = Spk::join('stocks','spks.stock_id','stocks.id')
                ->join('units','stocks.unit_id','units.id')
                ->join('colors','units.color_id','colors.id')
                ->join('manpowers','spks.manpower_id','manpowers.id')
                ->join('dealers','stocks.dealer_id','dealers.id')
                ->where('stocks.dealer_id',$did)
                ->whereBetween('spk_date',[$req->start, $req->end])
                ->orderBy('spks.created_at','desc')
                ->select('spks.order_status','spks.credit_status','spks.payment_method','spks.spk_date','spks.sale_status','spks.spk_no','spks.order_name','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone','colors.color_code','units.model_name', 'spks.created_at')->get();
            }
        }
        return view('page', compact('data','start','end','unitData','colorData'));
    }

    public function historySalesman(Request $req){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        $yearNow = Carbon::now('GMT+8')->format('Y');
        $yearBefore = $yearNow - 1;

        $unitData = Unit::where('year_mc',$yearNow)
        ->orWhere('year_mc',$yearBefore)
        ->groupBy('model_name')
        ->get();

        $colorData = Color::all();

        $manpowerID = Manpower::where('user_id',Auth::user()->id)->sum('id');
        $manpowerName = Manpower::where('user_id',Auth::user()->id)->pluck('name');
        $manpowerName = $manpowerName[0];

        $start = $req->start;
        $end = $req->end;
        if ($start == null && $end == null) {
            $data = Spk::join('stocks','spks.stock_id','stocks.id')
            ->join('units','stocks.unit_id','units.id')
            ->join('colors','units.color_id','colors.id')
            ->join('manpowers','spks.manpower_id','manpowers.id')
            ->join('dealers','stocks.dealer_id','dealers.id')
            ->where('spks.manpower_id',$manpowerID)
            ->orderBy('spks.created_at','desc')
            ->select('spks.order_status','spks.credit_status','spks.payment_method','spks.spk_date','spks.sale_status','spks.spk_no','spks.order_name','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone','colors.color_code','units.model_name', 'spks.created_at')->limit(50)->get();
            
        } else {
            $data = Spk::join('stocks','spks.stock_id','stocks.id')
            ->join('units','stocks.unit_id','units.id')
            ->join('colors','units.color_id','colors.id')
            ->join('manpowers','spks.manpower_id','manpowers.id')
            ->join('dealers','stocks.dealer_id','dealers.id')
            ->where('spks.manpower_id',$manpowerID)
            ->whereBetween('spk_date',[$req->start, $req->end])
            ->orderBy('spks.created_at','desc')
            ->select('spks.order_status','spks.credit_status','spks.payment_method','spks.spk_date','spks.sale_status','spks.spk_no','spks.order_name','spks.id as id_spk','manpowers.name as salesman','spks.spk_phone','colors.color_code','units.model_name', 'spks.created_at')->get();
        }
        return view('page', compact('data','start','end','unitData','colorData'));
    }

    public function get($spk_no){
        $data = Spk::join('dealers','spks.dealer_code','=','dealers.dealer_code')
        ->select('spks.order_status','spks.credit_status','spks.payment_method','spks.spk_date','spks.sale_status','spks.spk_no','spks.order_name','spks.id as id_spk','spks.manpower as salesman','spks.spk_phone','spks.faktur_color','spks.model_name','spks.price','spks.address as customer_address','spks.stnk_name','spks.leasing','spks.description','spks.ktp_number','spks.deposit','spks.downpayment','spks.discount','spks.payment','spks.created_at','spks.bunga','spks.tenor','spks.address_shipment','spks.microfinance','spks.ktp','spks.frame_no')
        ->where('spks.spk_no',$spk_no)
        ->firstOrFail();

        $id = Spk::where('spk_no',$spk_no)->value('id');

        return view('page', compact('data','spk_no','id'));
    }

    // History Credit
    public function historyCredit($spk_no){
        $data = HistoryCredit::join('spks','history_credits.spk','=','spks.spk_no')
        ->join('stocks','spks.stock_id','=','stocks.id')
        ->join('leasings','history_credits.leasing_id','=','leasings.id')
        ->join('units','stocks.unit_id','units.id')
        ->join('colors','units.color_id','colors.id')
        ->join('manpowers','spks.manpower_id','manpowers.id')
        ->join('dealers','stocks.dealer_id','dealers.id')
        ->select('history_credits.spk','spks.order_name','history_credits.credit_status','history_credits.reason','spks.spk_date','history_credits.update_date','history_credits.pemohon_name','manpowers.name as salesman','leasings.leasing_code')
        ->where('history_credits.spk',$spk_no)
        ->orderBy('history_credits.update_date','asc')
        ->get();

        return view('page', compact('data','spk_no'));
    }

    public function printPDF($spk_no){
        $dc = Auth::user()->dealer_code;
        $dealer = Dealer::where('dealer_code',$dc)->get();

        $data = Spk::join('dealers','spks.dealer_code','=','dealers.dealer_code')
        ->select('spks.order_status','spks.credit_status','spks.payment_method','spks.spk_date','spks.sale_status','spks.spk_no','spks.order_name','spks.id as id_spk','spks.manpower as salesman','spks.spk_phone as customer_phone','spks.faktur_color','spks.model_name','spks.price','spks.address as customer_address','spks.address_shipment as customer_address_shipment','spks.stnk_name','spks.leasing','spks.description','spks.ktp_number','spks.deposit','spks.downpayment','spks.discount','spks.payment','spks.created_at','spks.bunga','spks.tenor','spks.address_shipment','spks.microfinance','spks.year_mc','spks.manpower')
        ->where('spks.spk_no',$spk_no)
        ->get();

        $printDate = Carbon::now('GMT+8')->format('j F Y H:i:s');

        $pdf = PDF::loadView('export.pdf-spk',compact('data','spk_no','printDate','dealer'));
        $pdf->setPaper('A5', 'landscape');
        return $pdf->stream('spk_'.$spk_no.'.pdf');
    }

    public function downloadPDF($spk_no){
        $dc = Auth::user()->dealer_code;
        $dealer = Dealer::where('dealer_code',$dc)->get();

        $data = Spk::join('dealers','spks.dealer_code','=','dealers.dealer_code')
        ->select('spks.order_status','spks.credit_status','spks.payment_method','spks.spk_date','spks.sale_status','spks.spk_no','spks.order_name','spks.id as id_spk','spks.manpower as salesman','spks.spk_phone as customer_phone','spks.faktur_color','spks.model_name','spks.price','spks.address as customer_address','spks.address_shipment as customer_address_shipment','spks.stnk_name','spks.leasing','spks.description','spks.ktp_number','spks.deposit','spks.downpayment','spks.discount','spks.payment','spks.created_at','spks.bunga','spks.tenor','spks.address_shipment','spks.microfinance','spks.year_mc','spks.manpower')
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
