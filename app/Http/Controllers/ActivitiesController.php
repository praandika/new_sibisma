<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use App\Http\Controllers\Controller;
use App\Models\Acttype;
use App\Models\Dealer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivitiesController extends Controller
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
        $thisMonth = Carbon::now('GMT+8')->format('m');
        $acttypes = Acttype::all();
        $dealer = Dealer::where('dealer_code','!=','YIMM')->get();

        if ($dc == 'group') {
            $data = Activities::whereMonth('start_date', $thisMonth)->orderBy('start_date','desc')->get();
        }else{
            $data = Activities::join('dealers','activities.dealer_id','dealers.id')
            ->where('dealers.dealer_code',$dc)
            ->whereMonth('activities.start_date', $thisMonth)
            ->orderBy('activities.start_date','desc')
            ->get();
        }
        return view('page', compact('data','acttypes','dealer'));
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
        $dc = Auth::user()->dealer_code;
        $num = Activities::where('dealer_id',$req->dealer_id)->count();
        $date = Carbon::now('GMT+8')->format('Ymd');

        $data = new Activities;
        if ($dc == 'group'){
            $act_code = 'ACT'.$req->dealer_code.$date.sprintf("%03s", $num + 1);
            $data->act_code = $act_code;
        } else {
            $act_code = 'ACT'.$dc.$date.sprintf("%03s", $num + 1);
            $data->act_code = $act_code;
        }
        $data->acttype_id = $req->acttype_id;
        $data->start_date = $req->start_date;
        $data->end_date = $req->end_date;
        $data->dealer_id = $req->dealer_id;
        $data->prospect_cold = $req->prospect_cold;
        $data->prospect_warm = $req->prospect_warm;
        $data->prospect_hot = $req->prospect_hot;
        $data->prospect_deal = $req->prospect_deal;
        $data->target_sales = $req->target_sales;
        $data->note_event = $req->note_event;
        $data->problem = $req->problem;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        $data->save();
        toast('Data activity berhasil disimpan','success');
        return redirect()->route('activities.add-detail')->with('display', true);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activities  $activities
     * @return \Illuminate\Http\Response
     */
    public function show(Activities $activities)
    {
        return view('page', compact('activities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activities  $activities
     * @return \Illuminate\Http\Response
     */
    public function edit(Activities $activities)
    {
        return view('page', compact('jobvacancy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activities  $activities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Activities $activities)
    {
        $data = Activities::find($activities->id);
        $data->acttype_id = $req->acttype_id;
        $data->start_date = $req->start_date;
        $data->end_date = $req->end_date;
        $data->dealer_id = $req->dealer_id;
        $data->prospect_cold = $req->prospect_cold;
        $data->prospect_warm = $req->prospect_warm;
        $data->prospect_hot = $req->prospect_hot;
        $data->prospect_deal = $req->prospect_deal;
        $data->target_sales = $req->target_sales;
        $data->note_event = $req->note_event;
        $data->problem = $req->problem;
        $data->updated_by = Auth::user()->id;
        $data->update();
        toast('Data activity berhasil diubah','success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activities  $activities
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activities $activities)
    {
        //
    }

    public function delete($id){
        Activities::find($id)->delete();
        toast('Data activity terhapus','success');
        return redirect()->back();
    }
}
