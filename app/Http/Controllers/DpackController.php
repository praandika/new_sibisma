<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SyncLog;

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
}
