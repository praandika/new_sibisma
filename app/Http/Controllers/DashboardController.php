<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\Spk;
use App\Models\UnitOnHand;
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

            if (Auth::user()->dealer_code == 'group') {
                $data = Spk::query()
                ->join('dealers','spks.dealer_code','=','dealers.dealer_code')
                ->where('spks.order_status', 'REQUEST STOCK')
                ->select('spks.*','dealers.dealer_name');
            } else {
                $data = Spk::query()
                ->join('dealers','spks.dealer_code','=','dealers.dealer_code')
                ->where('spks.point_code', Auth::user()->dealer_code)
                ->where('spks.order_status', 'REQUEST STOCK')
                ->select('spks.*','dealers.dealer_name');
            }

            if ($request->filled('search')) {

                $keywords = preg_split(
                    '/\s+/',
                    trim($request->search)
                );

                foreach ($keywords as $keyword) {

                    $data->where(function ($q) use ($keyword) {
                        $q->where('spks.order_name', 'like', "%{$keyword}%")
                            ->orWhere('spks.ktp_number', 'like', "%{$keyword}%")
                            ->orWhere('spks.payment_method', 'like', "%{$keyword}%")
                            ->orWhere('spks.order_status', 'like', "%{$keyword}%")
                            ->orWhere('spks.spk_no', 'like', "%{$keyword}%")
                            ->orWhere('spks.model_name', 'like', "%{$keyword}%");
                    });
                }

            }

            $data = $data->orderby('spks.updated_at', 'asc')
            ->paginate(10);

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function mutationRequestStock(Request $request)
    {
        try {

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
                ->where('unit_on_hands.dealer_code', Auth::user()->dealer_code)
                ->select(
                    'unit_on_hands.*','dealers.dealer_name'
                );
            }

            if ($request->filled('search')) {

                $keywords = preg_split(
                    '/\s+/',
                    trim($request->search)
                );

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

            $data = $query->orderby('unit_on_hands.updated_at', 'desc')
            ->paginate(10);

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
