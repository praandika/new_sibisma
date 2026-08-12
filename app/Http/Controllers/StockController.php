<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\StockColorResource;
use App\Http\Resources\StockResource;
use Illuminate\Http\Request;
use App\Models\Dealer;
use App\Models\Stock;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\UnitOnHand;

class StockController extends Controller
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
        // Checking Stock
        $cek = Stock::where([['unit_id',$req->unit_id],['dealer_id',$req->dealer_id]])->count();
        if ($cek > 0) {
            alert()->warning('Warning','Unit is already at '.$req->dealer_name.'');
            return redirect()->back()->with('display', true)->withInput($req->input());
        } else {
            $data = new Stock;
            $data->unit_id = $req->unit_id;
            $data->dealer_id = $req->dealer_id;
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;
            if ($req->qty == '') {
                $data->qty = 0;
            } else {
                $data->qty = $req->qty;
            }
            $data->save();

            // Write log
            $log = new Log;
            $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
            $log->activity = 'creates stock data';
            $log->user_id = Auth::user()->id;
            $log->save();

            toast('Data stock berhasil disimpan','success');
            return redirect()->back()->with('display', true);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        $otherColors = Stock::join('units','units.id','=','stocks.unit_id')
        ->where([
            ['units.model_name', $stock->unit->model_name],
            ['stocks.qty', '>', 0],
        ])
        ->groupBy('color_id')
        ->get();

        $otherDealers = Stock::join('units','units.id','=','stocks.unit_id')
        ->join('dealers','dealers.id','=','stocks.dealer_id')
        ->where([
            ['units.model_name', $stock->unit->model_name],
            ['stocks.qty', '>', 0],
        ])
        ->groupBy('dealer_id')
        ->get();

        $otherYears = Stock::join('units','units.id','=','stocks.unit_id')
        ->join('dealers','dealers.id','=','stocks.dealer_id')
        ->where([
            ['units.model_name', $stock->unit->model_name],
            ['stocks.qty', '>', 0],
        ])
        ->groupBy('year_mc')
        ->get();
        // dd($otherYears);
        return view('page', compact('stock','otherColors','otherDealers','otherYears'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        // 
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
        Stock::find($id)->delete();

        // Write log
        $log = new Log;
        $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
        $log->activity = 'deletes a stock data';
        $log->user_id = Auth::user()->id;
        $log->save();

        toast('Data stock berhasil dihapus','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        Stock::whereIn('id',$req->pilih)->delete();

        // Write log
        $log = new Log;
        $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
        $log->activity = 'deletes some stocks data';
        $log->user_id = Auth::user()->id;
        $log->save();

        toast('Data stock berhasil dihapus','success');
        return redirect()->back();
    }

    public function ratio(){
        return view('page');
    }

    public function sendAvailable($model){
        $data = Stock::join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','dealers.id')
        ->where([
            ['units.model_name', str_replace('_', ' ', $model)],
            ['stocks.qty', '>', 0],
            ['dealers.dealer_code','!=','AA0104F'],
            ['dealers.dealer_code','!=','YIMM'],
        ])
        ->orderBy('dealers.dealer_code','asc')
        ->groupBy('dealers.dealer_name')
        ->select('dealers.dealer_name','dealers.address','dealers.phone2')
        ->get();
        
        return StockResource::collection($data);
    }

    public function sendAvailableColor($model){
        $year = Carbon::now()->format('Y');
        $data = Stock::join('units','stocks.unit_id','units.id')
        ->join('dealers','stocks.dealer_id','dealers.id')
        ->join('colors','units.color_id','colors.id')
        ->where([
            ['units.model_name', str_replace('_', ' ', $model)],
            ['stocks.qty', '>', 0],
            ['units.year_mc', $year],
            ['dealers.dealer_code','!=','AA0104F'],
            ['dealers.dealer_code','!=','YIMM'],
        ])
        ->select('dealers.dealer_name','dealers.address','dealers.phone2','colors.color_name','colors.color_code')
        ->get();
        
        return StockColorResource::collection($data);
    }

    // DIRECT TO PAGE STOCK
    public function showStockOnhand(){
        return view('page');
    }

    public function showStockMutation(){
        return view('page');
    }

    public function showStockRequested(){
        return view('page');
    }

    public function showStockSold(){
        return view('page');
    }
    // DIRECT TO PAGE STOCK

    // DATA STOCK ONHAND AJAX
    public function dataStockOnHand(Request $request)
    {
        try {
            $keywords = preg_split('/\s+/', trim($request->search));

            if (Auth::user()->dealer_code == 'group') {
                $query = UnitOnhand::query()
                ->join('dealers','unit_on_hands.dealer_code','=','dealers.dealer_code')
                ->where('unit_on_hands.status', 'onhand')
                ->select(
                    'unit_on_hands.*','dealers.dealer_name'
                );
            } else {
                $query = UnitOnhand::query()
                ->join('dealers','unit_on_hands.dealer_code','=','dealers.dealer_code')
                ->where('unit_on_hands.status', 'onhand')
                ->where('unit_on_hands.dealer_code',Auth::user()->dealer_code)
                ->select(
                    'unit_on_hands.*','dealers.dealer_name'
                );
            }

            // SEARCH
            if ($request->filled('search')) {

                $keywords = preg_split('/\s+/', trim($request->search));

                foreach ($keywords as $keyword) {

                    $query->where(function ($q) use ($keyword) {

                        $q->where('unit_on_hands.faktur_color', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.year_mc', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.frame_no', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.engine_no', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.model_name', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.price', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.receive_time', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.location', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.status', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.info', 'like', "%{$keyword}%");

                    });

                }
            }

            // Lalu urutkan data
            $query->orderBy('unit_on_hands.receive_time', 'asc');

            $data = $query->paginate(10);

            return response()->json($data);

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ],500);

        }
    }

    // DATA STOCK MUTATION AJAX
    public function dataStockMutation(Request $request)
    {
        try {
            $keywords = preg_split('/\s+/', trim($request->search));

            if (Auth::user()->dealer_code == 'group') {
                $query = UnitOnhand::query()
                ->join('dealers','unit_on_hands.dealer_code','=','dealers.dealer_code')
                ->where('unit_on_hands.status', 'mutation')
                ->select(
                    'unit_on_hands.*','dealers.dealer_name'
                );
            } else {
                $query = UnitOnhand::query()
                ->join('dealers','unit_on_hands.dealer_code','=','dealers.dealer_code')
                ->where('unit_on_hands.status', 'mutation')
                ->where('unit_on_hands.dealer_code',Auth::user()->dealer_code)
                ->select(
                    'unit_on_hands.*','dealers.dealer_name'
                );
            }

            // SEARCH
            if ($request->filled('search')) {

                $keywords = preg_split('/\s+/', trim($request->search));

                foreach ($keywords as $keyword) {

                    $query->where(function ($q) use ($keyword) {

                        $q->where('unit_on_hands.faktur_color', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.year_mc', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.frame_no', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.engine_no', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.model_name', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.price', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.receive_time', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.location', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.status', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.info', 'like', "%{$keyword}%");

                    });

                }
            }

            // Lalu urutkan data
            $query->orderBy('unit_on_hands.receive_time', 'asc');

            $data = $query->paginate(10);

            return response()->json($data);

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ],500);

        }
    }

    // DATA STOCK REQUESTED AJAX
    public function dataStockRequested(Request $request)
    {
        try {
            $keywords = preg_split('/\s+/', trim($request->search));

            if (Auth::user()->dealer_code == 'group') {
                $query = UnitOnhand::query()
                ->join('dealers','unit_on_hands.dealer_code','=','dealers.dealer_code')
                ->where('unit_on_hands.status', 'mutation')
                ->select(
                    'unit_on_hands.*','dealers.dealer_name'
                );
            } else {
                $query = UnitOnhand::query()
                ->join('dealers','unit_on_hands.dealer_code','=','dealers.dealer_code')
                ->where('unit_on_hands.status', 'mutation')
                ->where('unit_on_hands.point_code',Auth::user()->dealer_code)
                ->select(
                    'unit_on_hands.*','dealers.dealer_name'
                );
            }

            // SEARCH
            if ($request->filled('search')) {

                $keywords = preg_split('/\s+/', trim($request->search));

                foreach ($keywords as $keyword) {

                    $query->where(function ($q) use ($keyword) {

                        $q->where('unit_on_hands.faktur_color', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.year_mc', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.frame_no', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.engine_no', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.model_name', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.price', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.receive_time', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.location', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.status', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.info', 'like', "%{$keyword}%");

                    });

                }
            }

            // Lalu urutkan data
            $query->orderBy('unit_on_hands.updated_at', 'asc');

            $data = $query->paginate(10);

            return response()->json($data);

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ],500);

        }
    }

    // DATA STOCK SOLD AJAX
    public function dataStockSold(Request $request)
    {
        try {
            $keywords = preg_split('/\s+/', trim($request->search));

            if (Auth::user()->dealer_code == 'group') {
                $query = UnitOnhand::query()
                ->join('dealers','unit_on_hands.dealer_code','=','dealers.dealer_code')
                ->where('unit_on_hands.status', 'sold')
                ->select(
                    'unit_on_hands.*','dealers.dealer_name'
                );
            } else {
                $query = UnitOnhand::query()
                ->join('dealers','unit_on_hands.dealer_code','=','dealers.dealer_code')
                ->where('unit_on_hands.status', 'sold')
                ->where('unit_on_hands.dealer_code',Auth::user()->dealer_code)
                ->select(
                    'unit_on_hands.*','dealers.dealer_name'
                );
            }

            // SEARCH
            if ($request->filled('search')) {

                $keywords = preg_split('/\s+/', trim($request->search));

                foreach ($keywords as $keyword) {

                    $query->where(function ($q) use ($keyword) {

                        $q->where('unit_on_hands.faktur_color', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.year_mc', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.frame_no', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.engine_no', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.model_name', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.price', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.receive_time', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.location', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.status', 'like', "%{$keyword}%")
                            ->orWhere('unit_on_hands.info', 'like', "%{$keyword}%");

                    });

                }
            }

            // Lalu urutkan data
            $query->orderBy('unit_on_hands.receive_time', 'asc');

            $data = $query->paginate(10);

            return response()->json($data);

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ],500);

        }
    }
}
