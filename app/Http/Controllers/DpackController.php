<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SyncLog;
use Illuminate\Support\Facades\Artisan;
use App\Models\Prospect;
use Illuminate\Support\Facades\Auth;

class DpackController extends Controller
{
    public function index()
    {
        return view('page');
    }

    public function log()
    {
        $data = SyncLog::latest()
        ->take(100)
        ->get();

        return response()->json($data);
    }

    // PANGGIL COMMAND PROSPECT
    public function manualSyncProspect(Request $request)
    {
        try {
            // jumlah prospect sebelum sync
            $before = Prospect::count();

            // jalankan command
            Artisan::call('sync:prospect', [
                'dealer_code' => Auth::user()->dealer_code,
                'salesman'    => Auth::user()->name
            ]);

            // jumlah prospect setelah sync
            $after = Prospect::count();

            return response()->json([
                'success' => true,
                'new_data' => $after - $before,
                'total' => $after
            ]); 
        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);

        }
    }
}
