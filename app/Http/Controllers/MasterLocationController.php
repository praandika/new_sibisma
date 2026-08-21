<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MasterLocation;

class MasterLocationController extends Controller
{
    public function index(){
        return view('page');
    }

    /**
     * Simpan lokasi baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'location_code' => 'required|string|max:50',
            'location_name' => 'required|string|max:100',
        ]);

        $dealerCode = Auth::user()->dealer_code;

        // Cek apakah kode lokasi sudah digunakan
        $exists = MasterLocation::where('dealer_code', $dealerCode)
            ->where('location_code', $request->location_code)
            ->exists();

        if ($exists) {
            toast('Kode lokasi sudah digunakan.', 'warning');

            return redirect()->back()
                ->withInput();
        }

        MasterLocation::create([
            'dealer_code'   => $dealerCode,
            'location_code' => strtoupper($request->location_code),
            'location_name' => strtoupper($request->location_name),
            'status'        => 'ACTIVE',
            'created_by'    => Auth::id(),
        ]);

        toast('Lokasi berhasil ditambahkan.', 'success');

        return redirect()->route('master-location.index');
    }

    /**
     * Update lokasi.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'location_code' => 'required|string|max:50',
            'location_name' => 'required|string|max:100',
        ]);

        $dealerCode = Auth::user()->dealer_code;

        $location = MasterLocation::where('dealer_code', $dealerCode)
            ->where('id', $id)
            ->firstOrFail();

        // Cek duplicate kode kecuali dirinya sendiri
        $exists = MasterLocation::where('dealer_code', $dealerCode)
            ->where('location_code', $request->location_code)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            toast('Kode lokasi sudah digunakan.', 'warning');

            return redirect()->back()
                ->withInput();
        }

        $location->location_code = strtoupper($request->location_code);
        $location->location_name = strtoupper($request->location_name);
        $location->save();

        toast('Lokasi berhasil diperbarui.', 'success');

        return redirect()->route('master-location.index');
    }

    /**
     * Nonaktifkan lokasi.
     *
     * Kita tidak menghapus lokasi karena lokasi bisa sudah
     * digunakan oleh history stock opname.
     */
    public function deactivate($id)
    {
        $dealerCode = Auth::user()->dealer_code;

        $location = MasterLocation::where('dealer_code', $dealerCode)
            ->where('id', $id)
            ->firstOrFail();

        $location->status = 'INACTIVE';
        $location->save();

        toast('Lokasi berhasil dinonaktifkan.', 'success');

        return redirect()->route('master-location.index');
    }

    /**
     * DATA MASTER LOCATION AJAX
     */
    public function dataMasterLocation(Request $request){
        try {
            $keywords = preg_split('/\s+/', trim($request->search));

            if (Auth::user()->dealer_code == 'group') {
                $query = MasterLocation::query()
                ->with('dealer')
                ->get();
            } else {
                $query = MasterLocation::query()
                ->with('dealer')
                ->where('dealer_code', Auth::user()->dealer_code)
                ->get();
            }

            // SEARCH
            if ($request->filled('search')) {

                $keywords = preg_split('/\s+/', trim($request->search));

                foreach ($keywords as $keyword) {

                    $query->where(function ($q) use ($keyword) {

                        $q->where('location_name', 'like', "%{$keyword}%")
                            ->orWhere('status', 'like', "%{$keyword}%")
                            ->orWhere('dealer_code', 'like', "%{$keyword}%");
                    });

                }
            }

            // Lalu urutkan data
            $query->orderBy('dealer_code', 'asc');

            $data = $query->paginate(10);

            return response()->json($data);

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ],500);

        }
    }
}
