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
    public function index()
    {
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        if ($dc == 'group') {
            $data = Allocation::selectRaw('allocation_date, COUNT(frame_no) as total_unit, dealer_code')
            ->groupBy('allocation_date')
            ->get();
            $stock = Stock::orderBy('qty','desc')->get();
            return view('page', compact('data', 'stock'));

        } else {
            $data = Allocation::selectRaw('allocation_date, COUNT(frame_no) as total_unit, dealer_code')
            ->where('dealer_code',$dc)
            ->groupBy('allocation_date')
            ->get();
            $stock = Stock::where('dealer_id',$did)->orderBy('qty','desc')->get('stocks.*');
            
            $dealerName = Dealer::where('dealer_code',$dc)->pluck('dealer_name');
            $dealerName = $dealerName[0];
            $dealerCode = $dc;

            return view('page', compact('data','dealerName', 'dealerCode', 'stock'));
        }
    }

    public function out()
    {
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        $today = Carbon::now('GMT+8')->format('Y-m-d');

        if ($dc == 'group') {
            $data = Allocation::where('out_status','yes')
            ->where('updated_at',$today)
            ->get();
            $stock = Allocation::where('out_status','no')
            ->orderby('allocation_date','asc')
            ->get();
            return view('page', compact('data', 'stock'));

        } else {
            $data = Allocation::where('out_status','yes')
            ->where('updated_at',$today)
            ->where('dealer_code', $dc)
            ->get();
            $stock = Allocation::where('out_status','no')
            ->where('dealer_code', $dc)
            ->orderby('allocation_date','asc')
            ->get();
            return view('page', compact('data', 'stock'));
            
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
        Allocation::find($id)->delete();
        toast('Data allocation berhasil dihapus','success');
        return redirect()->back()->with([
            'date' => $date,
            'dealer' => $dealer
        ]);
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
