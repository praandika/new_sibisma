<?php

namespace App\Http\Controllers;

use App\Imports\AllocationsImport;
use App\Models\Allocation;
use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Stock;
use Auth;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $start = $req->start;
        $end = $req->end;

        if ($start == null || $end == null) {
            if ($dc == 'group') {
                $data = Allocation::selectRaw(
                    'allocation_date, COUNT(frame_no) as entry,
                    dealer_code')
                ->where('allocation_date',$today)
                ->groupBy('allocation_date','dealer_code')
                ->get();
                $stock = Stock::orderBy('qty','desc')->get();
                return view('page', compact('data', 'stock','start','end'));
    
            } else {
                $data = Allocation::selectRaw(
                    'allocation_date, COUNT(frame_no) as entry,
                    dealer_code')
                ->where('allocation_date',$today)
                ->where('dealer_code',$dc)
                ->groupBy('allocation_date')
                ->get();
                $stock = Stock::where('dealer_id',$did)->orderBy('qty','desc')->get('stocks.*');
                
                $dealerName = Dealer::where('dealer_code',$dc)->pluck('dealer_name');
                $dealerName = $dealerName[0];
                $dealerCode = $dc;

                return view('page', compact('data','dealerName', 'dealerCode', 'stock','start','end'));
            }
        } else {
            if ($dc == 'group') {
                $data = Allocation::selectRaw(
                    'allocation_date, COUNT(frame_no) as entry,
                    dealer_code')
                ->whereBetween('allocation_date',[$req->start, $req->end])
                ->groupBy('allocation_date')
                ->get();
                $stock = Stock::orderBy('qty','desc')->get();
                return view('page', compact('data', 'stock','start','end'));
    
            } else {
                $data = Allocation::selectRaw(
                    'allocation_date, COUNT(frame_no) as entry,
                    dealer_code')
                ->whereBetween('allocation_date',[$req->start, $req->end])
                ->where('dealer_code',$dc)
                ->groupBy('allocation_date')
                ->get();
                $stock = Stock::where('dealer_id',$did)->orderBy('qty','desc')->get('stocks.*');
                
                $dealerName = Dealer::where('dealer_code',$dc)->pluck('dealer_name');
                $dealerName = $dealerName[0];
                $dealerCode = $dc;

                return view('page', compact('data','dealerName', 'dealerCode', 'stock','start','end'));
            }
        }
    }

    public function out()
    {
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        $today = Carbon::now('GMT+8')->format('Y-m-d');

        if ($dc == 'group') {
            $data = Allocation::where('out_status','yes')
            ->where('updated_at','LIKE', '%'.$today.'%')
            ->get();
            $stock = Allocation::where('out_status','no')
            ->orderby('allocation_date','asc')
            ->get();
            return view('page', compact('data', 'stock'));

        } else {
            $data = Allocation::where('out_status','yes')
            ->where('updated_at','LIKE', '%'.$today.'%')
            ->where('dealer_code', $dc)
            ->get();
            
            $stock = Allocation::where('out_status','no')
            ->where('dealer_code', $dc)
            ->orderby('allocation_date','asc')
            ->get();
            
            $dealerName = Dealer::where('dealer_code',$dc)->pluck('dealer_name');
            $dealerName = $dealerName[0];
            $dealerCode = $dc;

            return view('page', compact('data','dealerName', 'dealerCode', 'stock'));
        }
    }

    public function importExcel(Request $req){
        $req->validate([
            'excel' => 'required|mimes:xlsx,xsl,csv',
        ]);

        $file = $req->file('excel');
        $file_name = time()."_".$file->getClientOriginalName();
        $dir_file = 'allocation_import';
        $file->move($dir_file,$file_name);

        // Import Data
        Excel::import(new AllocationsImport, public_path('allocation_import/'.$file_name));

        toast('Data allocation berhasil di import','success');
        return redirect()->back();

    }

    public function storeOut(Request $req){
        $data = Allocation::find($req->id);
        $data->out_status = 'yes';
        $data->allocation_out_date = $req->allocation_date;
        $data->update();
        toast($req->frame_no.' berhasil keluar','success');
        return redirect()->back()->withInput($req->except('model_name', 'color', 'frame_no', 'engine_no', 'dealer'));
    }

    public function deleteStoreOut($status, $id) {
        $data = Allocation::find($id);
        $data->out_status = 'no';
        $data->allocation_out_date = '';
        $data->update();
        toast('Allocation Out berhasil dihapus','success');
        return redirect()->back();
    }

    public function detail($date, $dealer){
        $data = Allocation::where([
            ['allocation_date', $date],
            ['dealer_code', $dealer]
        ])->get();

        return view('page', compact('data','date','dealer'));
    }

    public function search(Request $req){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        $frame = $req->frame;
        $start = $req->start;
        $end = $req->end;

        if ($frame == null && $start == null && $end == null) {
            if ($dc == 'group') {
                $data = Allocation::orderBy('created_at', 'desc')->limit(1)->get();
            } else {
                $data = Allocation::orderBy('created_at', 'desc')->where('dealer_code', $dc)->limit(1)->get();
            }
        } elseif($start == null || $end == null) {
            if ($dc == 'group') {
                $data = Allocation::where('frame_no', $frame)->get();
                
            } else {
                $data = Allocation::where([
                    ['frame_no', $frame],
                    ['dealer_code', $dc]
                ])->get();
            }
        } elseif($frame == null) {
            if ($dc == 'group') {
                $data = Allocation::whereBetween('allocation_date', [$start, $end])->get();
            } else {
                $data = Allocation::whereBetween('allocation_date', [$start, $end])
                ->where('dealer_code', $dc)->get();
            }
        } else {
            if ($dc == 'group') {
                $data = Allocation::whereBetween('allocation_date', [$start, $end])
                ->where('frame_no', $frame)->get();
            } else {
                $data = Allocation::whereBetween('allocation_date', [$start, $end])
                ->where([
                    ['frame_no', $frame],
                    ['dealer_code', $dc]
                ])->get();
            }
        }
        return view('page', compact('data', 'start', 'end', 'frame'));
    }

    public function report(Request $req){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        $start = $req->start;
        $end = $req->end;

        $month = Carbon::now('GMT+8')->format('m');
        $today = Carbon::now('GMT+8')->format('d-m-Y');
        $yearNow = Carbon::now('GMT+8')->format('Y');

        if ($start == null || $end == null) {
            if ($dc == 'group') {
                $entry = Allocation::whereMonth('allocation_date',$month)
                ->count();
                $sold = Allocation::whereMonth('allocation_date',$month)
                ->where('out_status','yes')
                ->count();
                $stock = Allocation::where('out_status','no')
                ->count();

                // Most Stock
                $mostStockName = Allocation::where('out_status','no')
                ->selectRaw('COUNT(frame_no) as stock, model_name')
                ->groupBy('model_name')
                ->orderBy('stock','desc')
                ->limit(5)
                ->pluck('model_name')
                ->toArray();

                $mostStockCount = Allocation::where('out_status','no')
                ->selectRaw('COUNT(frame_no) as stock, model_name')
                ->groupBy('model_name')
                ->orderBy('stock','desc')
                ->limit(5)
                ->pluck('stock')
                ->toArray();

                $chartMostStock = [
                    'labels' => $mostStockName,
                    'data' => $mostStockCount
                ];

            } else {
                $entry = Allocation::whereMonth('allocation_date',$month)
                ->where('dealer_code', $dc)
                ->count();
                $sold = Allocation::whereMonth('allocation_date',$month)
                ->where('dealer_code', $dc)
                ->where('out_status','yes')
                ->count();
                $stock = Allocation::where('out_status','no')
                ->where('dealer_code', $dc)
                ->count();

                // Most Stock
                $mostStockName = Allocation::where('out_status','no')
                ->selectRaw('COUNT(frame_no) as stock, model_name')
                ->where('dealer_code', $dc)
                ->where('out_status','no')
                ->groupBy('model_name')
                ->orderBy('stock','desc')
                ->limit(5)
                ->pluck('model_name')
                ->toArray();

                $mostStockCount = Allocation::where('out_status','no')
                ->selectRaw('COUNT(frame_no) as stock, model_name')
                ->where('dealer_code', $dc)
                ->where('out_status','no')
                ->groupBy('model_name')
                ->orderBy('stock','desc')
                ->limit(5)
                ->pluck('stock')
                ->toArray();

                $chartMostStock = [
                    'labels' => $mostStockName,
                    'data' => $mostStockCount
                ];
            }

        } else {
            if ($dc == 'group') {
                $entry = Allocation::whereBetween('allocation_date', [$start, $end])
                ->count();
                $sold = Allocation::whereBetween('allocation_date', [$start, $end])
                ->where('out_status','yes')
                ->count();
                $stock = Allocation::where('out_status','no')
                ->whereBetween('allocation_date', [$start, $end])
                ->count();

                // Most Stock
                $mostStockName = Allocation::where('out_status','no')
                ->selectRaw('COUNT(frame_no) as stock, model_name')
                ->whereBetween('allocation_date', [$start, $end])
                ->groupBy('model_name')
                ->orderBy('stock','desc')
                ->limit(5)
                ->pluck('model_name')
                ->toArray();

                $mostStockCount = Allocation::where('out_status','no')
                ->selectRaw('COUNT(frame_no) as stock, model_name')
                ->whereBetween('allocation_date', [$start, $end])
                ->groupBy('model_name')
                ->orderBy('stock','desc')
                ->limit(5)
                ->pluck('stock')
                ->toArray();

                $chartMostStock = [
                    'labels' => $mostStockName,
                    'data' => $mostStockCount
                ];

            } else {
                $entry = Allocation::whereBetween('allocation_date', [$start, $end])
                ->where('dealer_code', $dc)
                ->count();
                $sold = Allocation::whereBetween('allocation_date', [$start, $end])
                ->where('dealer_code', $dc)
                ->where('out_status','yes')
                ->count();
                $stock = Allocation::where('out_status','no')
                ->whereBetween('allocation_date', [$start, $end])
                ->where('dealer_code', $dc)
                ->count();

                // Most Stock
                $mostStockName = Allocation::where('out_status','no')
                ->selectRaw('COUNT(frame_no) as stock, model_name')
                ->where('dealer_code', $dc)
                ->whereBetween('allocation_date', [$start, $end])
                ->groupBy('model_name')
                ->orderBy('stock','desc')
                ->limit(5)
                ->pluck('model_name')
                ->toArray();

                $mostStockCount = Allocation::where('out_status','no')
                ->selectRaw('COUNT(frame_no) as stock, model_name')
                ->where('dealer_code', $dc)
                ->whereBetween('allocation_date', [$start, $end])
                ->groupBy('model_name')
                ->orderBy('stock','desc')
                ->limit(5)
                ->pluck('stock')
                ->toArray();

                $chartMostStock = [
                    'labels' => $mostStockName,
                    'data' => $mostStockCount
                ];
            }
        }

        if ($dc == 'group') {
            // Chart Entry
            $janEntry = Allocation::whereMonth('allocation_date',1)
            ->whereYear('allocation_date', $yearNow)
                            ->count();
            $febEntry = Allocation::whereMonth('allocation_date',2)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $marEntry = Allocation::whereMonth('allocation_date',3)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $aprEntry = Allocation::whereMonth('allocation_date',4)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $mayEntry = Allocation::whereMonth('allocation_date',5)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $junEntry = Allocation::whereMonth('allocation_date',6)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $julEntry = Allocation::whereMonth('allocation_date',7)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $augEntry = Allocation::whereMonth('allocation_date',8)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $sepEntry = Allocation::whereMonth('allocation_date',9)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $octEntry = Allocation::whereMonth('allocation_date',10)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $novEntry = Allocation::whereMonth('allocation_date',11)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $decEntry = Allocation::whereMonth('allocation_date',12)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            // Chart Sold
            $janSold = Allocation::whereMonth('allocation_date',1)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $febSold = Allocation::whereMonth('allocation_date',2)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $marSold = Allocation::whereMonth('allocation_date',3)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $aprSold = Allocation::whereMonth('allocation_date',4)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $maySold = Allocation::whereMonth('allocation_date',5)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $junSold = Allocation::whereMonth('allocation_date',6)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $julSold = Allocation::whereMonth('allocation_date',7)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $augSold = Allocation::whereMonth('allocation_date',8)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $sepSold = Allocation::whereMonth('allocation_date',9)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $octSold = Allocation::whereMonth('allocation_date',10)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $novSold = Allocation::whereMonth('allocation_date',11)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $decSold = Allocation::whereMonth('allocation_date',12)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            // Chart Stock
            $janStock = Allocation::whereMonth('allocation_date',1)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $febStock = Allocation::whereMonth('allocation_date',2)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $marStock = Allocation::whereMonth('allocation_date',3)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $aprStock = Allocation::whereMonth('allocation_date',4)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $mayStock = Allocation::whereMonth('allocation_date',5)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $junStock = Allocation::whereMonth('allocation_date',6)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $julStock = Allocation::whereMonth('allocation_date',7)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $augStock = Allocation::whereMonth('allocation_date',8)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $sepStock = Allocation::whereMonth('allocation_date',9)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $octStock = Allocation::whereMonth('allocation_date',10)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $novStock = Allocation::whereMonth('allocation_date',11)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $decStock = Allocation::whereMonth('allocation_date',12)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            // Chart Ratio
            if ($janStock <= 0 && $janSold <= 0) {
                $janRatio = 0;
            } elseif($janSold <=0) {
                $janRatio = $janStock / $janStock;
            } else {
                $janRatio = $janStock / $janSold;
            }

            if ($febStock <= 0 && $febSold <= 0) {
                $febRatio = 0;
            } elseif($febSold <=0) {
                $febRatio = $febStock / $febStock;
            } else {
                $febRatio = $febStock / $febSold;
            }
            
            if ($marStock <= 0 && $marSold <= 0) {
                $marRatio = 0;
            } elseif($marSold <=0) {
                $marRatio = $marStock / $marStock;
            } else {
                $marRatio = $marStock / $marSold;
            }

            if ($aprStock <= 0 && $aprSold <= 0) {
                $aprRatio = 0;
            } elseif($aprSold <=0) {
                $aprRatio = $aprStock / $aprStock;
            } else {
                $aprRatio = $aprStock / $aprSold;
            }

            if ($mayStock <= 0 && $maySold <= 0) {
                $mayRatio = 0;
            } elseif($maySold <=0) {
                $mayRatio = $mayStock / $mayStock;
            } else {
                $mayRatio = $mayStock / $maySold;
            }

            if ($junStock <= 0 && $junSold <= 0) {
                $junRatio = 0;
            } elseif($junSold <=0) {
                $junRatio = $junStock / $junStock;
            } else {
                $junRatio = $junStock / $junSold;
            }

            if ($julStock <= 0 && $julSold <= 0) {
                $julRatio = 0;
            } elseif($julSold <=0) {
                $julRatio = $julStock / $julStock;
            } else {
                $julRatio = $julStock / $julSold;
            }

            if ($augStock <= 0 && $augSold <= 0) {
                $augRatio = 0;
            } elseif($augSold <=0) {
                $augRatio = $augStock / $augStock;
            } else {
                $augRatio = $augStock / $augSold;
            }

            if ($sepStock <= 0 && $sepSold <= 0) {
                $sepRatio = 0;
            } elseif($sepSold <=0) {
                $sepRatio = $sepStock / $sepStock;
            } else {
                $sepRatio = $sepStock / $sepSold;
            }

            if ($octStock <= 0 && $octSold <= 0) {
                $octRatio = 0;
            } elseif($octSold <=0) {
                $octRatio = $octStock / $octStock;
            } else {
                $octRatio = $octStock / $octSold;
            }

            if ($novStock <= 0 && $novSold <= 0) {
                $novRatio = 0;
            } elseif($novSold <=0) {
                $novRatio = $novStock / $novStock;
            } else {
                $novRatio = $novStock / $novSold;
            }
            
            if ($decStock <= 0 && $decSold <= 0) {
                $decRatio = 0;
            } elseif($decSold <=0) {
                $decRatio = $decStock / $decStock;
            } else {
                $decRatio = $decStock / $decSold;
            }
            
            $chartStockRatio = [
                'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'entry' => [$janEntry, $febEntry, $marEntry, $aprEntry, $mayEntry, $junEntry, $julEntry, $augEntry, $sepEntry, $octEntry, $novEntry, $decEntry],
                'sold' => [$janSold, $febSold, $marSold, $aprSold, $maySold, $junSold, $julSold, $augSold, $sepSold, $octSold, $novSold, $decSold],
                'instock' => [$janStock, $febStock, $marStock, $aprStock, $mayStock, $junStock, $julStock, $augStock, $sepStock, $octStock, $novStock, $decStock],
                'ratio' =>[$janRatio, $febRatio, $marRatio, $aprRatio, $mayRatio, $junRatio, $julRatio, $augRatio, $sepRatio, $octRatio, $novRatio, $decRatio],
            ];

            // Sold Chart
            $year1 = Carbon::now('GMT+8')->format('Y');
            $year2 = $year1 - 1;
            $year3 = $year1 - 2;

            // This Year
            $janSold1 = Allocation::whereMonth('allocation_date',1)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $febSold1 = Allocation::whereMonth('allocation_date',2)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $marSold1 = Allocation::whereMonth('allocation_date',3)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $aprSold1 = Allocation::whereMonth('allocation_date',4)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $maySold1 = Allocation::whereMonth('allocation_date',5)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $junSold1 = Allocation::whereMonth('allocation_date',6)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $julSold1 = Allocation::whereMonth('allocation_date',7)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $augSold1 = Allocation::whereMonth('allocation_date',8)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $sepSold1 = Allocation::whereMonth('allocation_date',9)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $octSold1 = Allocation::whereMonth('allocation_date',10)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $novSold1 = Allocation::whereMonth('allocation_date',11)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $decSold1 = Allocation::whereMonth('allocation_date',12)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();

            // Last Year
            $janSold2 = Allocation::whereMonth('allocation_date',1)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $febSold2 = Allocation::whereMonth('allocation_date',2)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $marSold2 = Allocation::whereMonth('allocation_date',3)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $aprSold2 = Allocation::whereMonth('allocation_date',4)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $maySold2 = Allocation::whereMonth('allocation_date',5)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $junSold2 = Allocation::whereMonth('allocation_date',6)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $julSold2 = Allocation::whereMonth('allocation_date',7)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $augSold2 = Allocation::whereMonth('allocation_date',8)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $sepSold2 = Allocation::whereMonth('allocation_date',9)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $octSold2 = Allocation::whereMonth('allocation_date',10)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $novSold2 = Allocation::whereMonth('allocation_date',11)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $decSold2 = Allocation::whereMonth('allocation_date',12)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();

            // Past Year
            $janSold3 = Allocation::whereMonth('allocation_date',1)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $febSold3 = Allocation::whereMonth('allocation_date',2)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $marSold3 = Allocation::whereMonth('allocation_date',3)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $aprSold3 = Allocation::whereMonth('allocation_date',4)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $maySold3 = Allocation::whereMonth('allocation_date',5)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $junSold3 = Allocation::whereMonth('allocation_date',6)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $julSold3 = Allocation::whereMonth('allocation_date',7)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $augSold3 = Allocation::whereMonth('allocation_date',8)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $sepSold3 = Allocation::whereMonth('allocation_date',9)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $octSold3 = Allocation::whereMonth('allocation_date',10)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $novSold3 = Allocation::whereMonth('allocation_date',11)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $decSold3 = Allocation::whereMonth('allocation_date',12)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();

            $chartSold = [
                'year1' => $year1,
                'year2' => $year2,
                'year3' => $year3,
                'data1' => [$janSold1, $febSold1, $marSold1, $aprSold1, $maySold1, $junSold1, $julSold1, $augSold1, $sepSold1, $octSold1, $novSold1, $decSold1],
                'data2' => [$janSold2, $febSold2, $marSold2, $aprSold2, $maySold2, $junSold2, $julSold2, $augSold2, $sepSold2, $octSold2, $novSold2, $decSold2],
                'data3' => [$janSold3, $febSold3, $marSold3, $aprSold3, $maySold3, $junSold3, $julSold3, $augSold3, $sepSold3, $octSold3, $novSold3, $decSold3],
            ];

        } else {
            // Chart Entry
            $janEntry = Allocation::whereMonth('allocation_date',1)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
                            ->count();
            $febEntry = Allocation::whereMonth('allocation_date',2)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $marEntry = Allocation::whereMonth('allocation_date',3)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $aprEntry = Allocation::whereMonth('allocation_date',4)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $mayEntry = Allocation::whereMonth('allocation_date',5)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $junEntry = Allocation::whereMonth('allocation_date',6)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $julEntry = Allocation::whereMonth('allocation_date',7)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $augEntry = Allocation::whereMonth('allocation_date',8)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $sepEntry = Allocation::whereMonth('allocation_date',9)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $octEntry = Allocation::whereMonth('allocation_date',10)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $novEntry = Allocation::whereMonth('allocation_date',11)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            $decEntry = Allocation::whereMonth('allocation_date',12)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->count();
            // Chart Sold
            $janSold = Allocation::whereMonth('allocation_date',1)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $febSold = Allocation::whereMonth('allocation_date',2)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $marSold = Allocation::whereMonth('allocation_date',3)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $aprSold = Allocation::whereMonth('allocation_date',4)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $maySold = Allocation::whereMonth('allocation_date',5)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $junSold = Allocation::whereMonth('allocation_date',6)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $julSold = Allocation::whereMonth('allocation_date',7)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $augSold = Allocation::whereMonth('allocation_date',8)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $sepSold = Allocation::whereMonth('allocation_date',9)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $octSold = Allocation::whereMonth('allocation_date',10)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $novSold = Allocation::whereMonth('allocation_date',11)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $decSold = Allocation::whereMonth('allocation_date',12)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            // Chart Stock
            $janStock = Allocation::whereMonth('allocation_date',1)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'yes')
            ->count();
            $febStock = Allocation::whereMonth('allocation_date',2)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $marStock = Allocation::whereMonth('allocation_date',3)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $aprStock = Allocation::whereMonth('allocation_date',4)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $mayStock = Allocation::whereMonth('allocation_date',5)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $junStock = Allocation::whereMonth('allocation_date',6)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $julStock = Allocation::whereMonth('allocation_date',7)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $augStock = Allocation::whereMonth('allocation_date',8)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $sepStock = Allocation::whereMonth('allocation_date',9)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $octStock = Allocation::whereMonth('allocation_date',10)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $novStock = Allocation::whereMonth('allocation_date',11)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            $decStock = Allocation::whereMonth('allocation_date',12)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $yearNow)
            ->where('out_status', 'no')
            ->count();
            // Chart Ratio
            if ($janStock <= 0 && $janSold <= 0) {
                $janRatio = 0;
            } elseif($janSold <=0) {
                $janRatio = $janStock / $janStock;
            } else {
                $janRatio = $janStock / $janSold;
            }

            if ($febStock <= 0 && $febSold <= 0) {
                $febRatio = 0;
            } elseif($febSold <=0) {
                $febRatio = $febStock / $febStock;
            } else {
                $febRatio = $febStock / $febSold;
            }
            
            if ($marStock <= 0 && $marSold <= 0) {
                $marRatio = 0;
            } elseif($marSold <=0) {
                $marRatio = $marStock / $marStock;
            } else {
                $marRatio = $marStock / $marSold;
            }

            if ($aprStock <= 0 && $aprSold <= 0) {
                $aprRatio = 0;
            } elseif($aprSold <=0) {
                $aprRatio = $aprStock / $aprStock;
            } else {
                $aprRatio = $aprStock / $aprSold;
            }

            if ($mayStock <= 0 && $maySold <= 0) {
                $mayRatio = 0;
            } elseif($maySold <=0) {
                $mayRatio = $mayStock / $mayStock;
            } else {
                $mayRatio = $mayStock / $maySold;
            }

            if ($junStock <= 0 && $junSold <= 0) {
                $junRatio = 0;
            } elseif($junSold <=0) {
                $junRatio = $junStock / $junStock;
            } else {
                $junRatio = $junStock / $junSold;
            }

            if ($julStock <= 0 && $julSold <= 0) {
                $julRatio = 0;
            } elseif($julSold <=0) {
                $julRatio = $julStock / $julStock;
            } else {
                $julRatio = $julStock / $julSold;
            }

            if ($augStock <= 0 && $augSold <= 0) {
                $augRatio = 0;
            } elseif($augSold <=0) {
                $augRatio = $augStock / $augStock;
            } else {
                $augRatio = $augStock / $augSold;
            }

            if ($sepStock <= 0 && $sepSold <= 0) {
                $sepRatio = 0;
            } elseif($sepSold <=0) {
                $sepRatio = $sepStock / $sepStock;
            } else {
                $sepRatio = $sepStock / $sepSold;
            }

            if ($octStock <= 0 && $octSold <= 0) {
                $octRatio = 0;
            } elseif($octSold <=0) {
                $octRatio = $octStock / $octStock;
            } else {
                $octRatio = $octStock / $octSold;
            }

            if ($novStock <= 0 && $novSold <= 0) {
                $novRatio = 0;
            } elseif($novSold <=0) {
                $novRatio = $novStock / $novStock;
            } else {
                $novRatio = $novStock / $novSold;
            }
            
            if ($decStock <= 0 && $decSold <= 0) {
                $decRatio = 0;
            } elseif($decSold <=0) {
                $decRatio = $decStock / $decStock;
            } else {
                $decRatio = $decStock / $decSold;
            }
            
            $chartStockRatio = [
                'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'entry' => [$janEntry, $febEntry, $marEntry, $aprEntry, $mayEntry, $junEntry, $julEntry, $augEntry, $sepEntry, $octEntry, $novEntry, $decEntry],
                'sold' => [$janSold, $febSold, $marSold, $aprSold, $maySold, $junSold, $julSold, $augSold, $sepSold, $octSold, $novSold, $decSold],
                'instock' => [$janStock, $febStock, $marStock, $aprStock, $mayStock, $junStock, $julStock, $augStock, $sepStock, $octStock, $novStock, $decStock],
                'ratio' =>[$janRatio, $febRatio, $marRatio, $aprRatio, $mayRatio, $junRatio, $julRatio, $augRatio, $sepRatio, $octRatio, $novRatio, $decRatio],
            ];

            // Sold Chart
            $year1 = Carbon::now('GMT+8')->format('Y');
            $year2 = $year1 - 1;
            $year3 = $year1 - 2;

            // This Year
            $janSold1 = Allocation::whereMonth('allocation_date',1)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $febSold1 = Allocation::whereMonth('allocation_date',2)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $marSold1 = Allocation::whereMonth('allocation_date',3)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $aprSold1 = Allocation::whereMonth('allocation_date',4)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $maySold1 = Allocation::whereMonth('allocation_date',5)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $junSold1 = Allocation::whereMonth('allocation_date',6)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $julSold1 = Allocation::whereMonth('allocation_date',7)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $augSold1 = Allocation::whereMonth('allocation_date',8)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $sepSold1 = Allocation::whereMonth('allocation_date',9)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $octSold1 = Allocation::whereMonth('allocation_date',10)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $novSold1 = Allocation::whereMonth('allocation_date',11)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();
            $decSold1 = Allocation::whereMonth('allocation_date',12)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year1)
            ->where('out_status', 'yes')
            ->count();

            // Last Year
            $janSold2 = Allocation::whereMonth('allocation_date',1)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $febSold2 = Allocation::whereMonth('allocation_date',2)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $marSold2 = Allocation::whereMonth('allocation_date',3)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $aprSold2 = Allocation::whereMonth('allocation_date',4)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $maySold2 = Allocation::whereMonth('allocation_date',5)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $junSold2 = Allocation::whereMonth('allocation_date',6)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $julSold2 = Allocation::whereMonth('allocation_date',7)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $augSold2 = Allocation::whereMonth('allocation_date',8)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $sepSold2 = Allocation::whereMonth('allocation_date',9)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $octSold2 = Allocation::whereMonth('allocation_date',10)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $novSold2 = Allocation::whereMonth('allocation_date',11)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();
            $decSold2 = Allocation::whereMonth('allocation_date',12)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year2)
            ->where('out_status', 'yes')
            ->count();

            // Past Year
            $janSold3 = Allocation::whereMonth('allocation_date',1)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $febSold3 = Allocation::whereMonth('allocation_date',2)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $marSold3 = Allocation::whereMonth('allocation_date',3)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $aprSold3 = Allocation::whereMonth('allocation_date',4)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $maySold3 = Allocation::whereMonth('allocation_date',5)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $junSold3 = Allocation::whereMonth('allocation_date',6)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $julSold3 = Allocation::whereMonth('allocation_date',7)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $augSold3 = Allocation::whereMonth('allocation_date',8)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $sepSold3 = Allocation::whereMonth('allocation_date',9)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $octSold3 = Allocation::whereMonth('allocation_date',10)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $novSold3 = Allocation::whereMonth('allocation_date',11)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();
            $decSold3 = Allocation::whereMonth('allocation_date',12)
            ->where('dealer_code', $dc)
            ->whereYear('allocation_date', $year3)
            ->where('out_status', 'yes')
            ->count();

            $chartSold = [
                'year1' => $year1,
                'year2' => $year2,
                'year3' => $year3,
                'data1' => [$janSold1, $febSold1, $marSold1, $aprSold1, $maySold1, $junSold1, $julSold1, $augSold1, $sepSold1, $octSold1, $novSold1, $decSold1],
                'data2' => [$janSold2, $febSold2, $marSold2, $aprSold2, $maySold2, $junSold2, $julSold2, $augSold2, $sepSold2, $octSold2, $novSold2, $decSold2],
                'data3' => [$janSold3, $febSold3, $marSold3, $aprSold3, $maySold3, $junSold3, $julSold3, $augSold3, $sepSold3, $octSold3, $novSold3, $decSold3],
            ];
        }

        return view('page', compact('entry','sold','stock', 'today','start','end','chartStockRatio','chartMostStock','chartSold'));
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
        $data = new Allocation;
        $data->allocation_date = $req->allocation_date;
        $data->model_name = $req->model_name;
        $data->color = $req->color;
        $data->frame_no = $req->frame_no;
        $data->engine_no = $req->engine_no;
        $data->dealer_code = $req->dealer_code;
        $data->save();

        toast('Data allocation berhasil disimpan','success');
        return redirect()->back()->with('display', true);
    }

    public function delete($id, $date, $dealer){
        $cek = Allocation::find($id);

        if ($cek->out_status == 'yes') {
            toast('Unit sudah terjual','warning');
            return redirect()->back()->with([
                'date' => $date,
                'dealer' => $dealer
            ]);
        } else {
            Allocation::find($id)->delete();
            toast('Data allocation berhasil dihapus','success');
            return redirect()->back()->with([
                'date' => $date,
                'dealer' => $dealer
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Allocation  $allocation
     * @return \Illuminate\Http\Response
     */
    public function show(Allocation $allocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Allocation  $allocation
     * @return \Illuminate\Http\Response
     */
    public function edit(Allocation $allocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Allocation  $allocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Allocation $allocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Allocation  $allocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Allocation $allocation)
    {
        //
    }
}
