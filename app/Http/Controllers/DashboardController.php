<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\Spk;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('page');
    }

    public function simulasi(){
        $year = Carbon::now()->format('Y');
        $lastYear = $year - 1;
        $data = Unit::join('colors','colors.id','=','units.color_id')
        ->where('units.year_mc',$year)
        ->orWhere('units.model_name','Fazzio Neo Hybrid')
        ->orWhere('units.model_name','Fazzio Lux')
        ->groupBy('units.model_name')
        ->orderBy('units.model_name', 'asc')
        ->get();

        return view('simulasi', compact('data'));
    }

    public function listRequestStock(Request $request)
    {
        try {
            $search = $request->search;

            $data = Spk::query()
                ->join('dealers','spks.dealer_code','=','dealers.dealer_code')
                ->where('spks.point_code', Auth::user()->dealer_code)
                ->where('spks.order_status', 'REQUEST STOCK')
                ->select(
                    'spks.*','dealers.dealer_name'
                )
                ->when($search, function ($q) use ($search) {
                    $q->where('spks.order_name', 'like', "%{$search}%")
                    ->orWhere('spks.ktp_number', 'like', "%{$search}%")
                    ->orWhere('spks.payment_method', 'like', "%{$search}%")
                    ->orWhere('spks.order_status', 'like', "%{$search}%")
                    ->orWhere('spks.spk_no', 'like', "%{$search}%")
                    ->orWhere('spks.model_name', 'like', "%{$search}%");
                })
                ->orderby('spks.updated_at', 'asc')
                ->paginate(10);

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
