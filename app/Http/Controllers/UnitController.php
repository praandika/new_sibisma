<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ColorResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\UnitDetailResource;
use App\Http\Resources\UnitResource;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Color;
use App\Models\Dealer;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;


class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Unit::all();
        $color = Color::all();
        return view('page', compact('data','color'));
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
        $req->validate([
            'image' => 'image|mimes:jpeg,png,jpg',
        ]);

        $data = new Unit;
        $data->model_name = $req->model_name;
        $data->category = $req->category;
        $data->color_id = $req->color_id;
        $data->year_mc = $req->year_mc;
        $data->price = $req->price;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        if ($req->image == '') {
            $data->image = 'noimage.jpg';
            $data->save();
            toast('Data unit berhasil disimpan','success');
            return redirect()->back()->with('display', true);
        } else {
            $img = $req->file('image');
            $img_file = time()."_".$img->getClientOriginalName();
            $dir_img = 'img/motorcycle';
            $img->move($dir_img,$img_file);
            $data->image = $img_file;
            $data->save();
            toast('Data unit berhasil disimpan','success');
            return redirect()->back()->with('display', true);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        return view('page', compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        $color = Color::all();
        return view('page', compact('unit','color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Unit $unit)
    {
        $data = Unit::find($unit->id);
        $data->model_name = $req->model_name;
        $data->category = $req->category;
        $data->color_id = $req->color_id;
        $data->year_mc = $req->year_mc;
        $data->price = $req->price;
        if ($req->hasfile('image')) {
            if ($data->image != '' && $data->image != 'noimage.jpg') {
                $img_prev = $req->img_prev;
                unlink('img/motorcycle/'.$img_prev);
            }

            $img = $req->file('image');
            $img_file = time()."_".$img->getClientOriginalName();
            $dir_img = 'img/motorcycle';
            $img->move($dir_img,$img_file);

            $data->image = $img_file;
            $data->save();
            toast('Data unit berhasil disimpan','success');
            return redirect()->back();
        }else{
            $data->save();
            toast('Data unit berhasil disimpan','success');
            return redirect()->back();
        }
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
        Unit::find($id)->delete();
        toast('Data unit berhasil dihapus','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        Unit::whereIn('id',$req->pilih)->delete();
        toast('Data unit berhasil dihapus','success');
        return redirect()->back();
    }

    public function addalltostock(){
        $data = Dealer::leftJoin('stocks','stocks.dealer_id','=','dealers.id')
        ->selectRaw('dealers.id as id, dealers.dealer_code as code, dealers.dealer_name as dealer, sum(stocks.qty) as stock')
        ->where('dealers.dealer_name','!=','Yamaha Indonesia Motor MFG')
        ->groupBy('dealers.dealer_name')
        ->get();
        $tahunUnit = Unit::select('year_mc')->groupBy('year_mc')->get();
        return view('page', compact('data','tahunUnit'));
    }

    public function addalltostockStore(Request $req){
        // Finding Unit ID where not in stock's table
        $cekStock = Stock::join('units','stocks.unit_id','=','units.id')
        ->where([
            ['stocks.dealer_id',$req->dealer_id],
            ['units.year_mc',$req->year_mc],
        ])
        ->pluck('stocks.unit_id');

        $data = Unit::where('year_mc',$req->year_mc)
        ->whereNotIn('id',$cekStock)
        ->pluck('id');

        // dd($data, $cekStock);
        
        if (count($data) <= 0) {
            toast($req->dealer_name.' sudah ada semua stock '.$req->year_mc.'','warning');
            return redirect()->back()->with('display', true);
        } else {
            for ($i=0; $i < count($data); $i++) { 
                Stock::insert([
                    'unit_id' => $data[$i],
                    'dealer_id' => $req->dealer_id,
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                    'qty' => 0,
                    'created_at' => Carbon::now('GMT+8'),
                ]);
            }
            toast(count($data).' stock '.$req->year_mc.' berhasil disimpan','success');
            return redirect()->back()->with('display', true);
        }
    }

    public function sendModel() {
        $year = Carbon::now()->format('Y');
        $data = Unit::where('year_mc', $year)
        ->groupBy('model_name')
        ->get();
        return UnitResource::collection($data);
    }

    public function sendSearch(Request $request) {
        $year = Carbon::now()->format('Y');
        $data =  Unit::where([
            ['year_mc',$year],
            ['model_name', 'like', '%'.$request->search.'%']
        ])
        ->groupBy('model_name')
        ->get();
        return UnitResource::collection($data);
    }

    public function sendModelCat($cat) {
        $year = Carbon::now()->format('Y');
        $data = Unit::where([
            ['year_mc',$year],
            ['category',$cat]
        ])
        ->groupBy('model_name')
        ->get();
        return UnitResource::collection($data);
    }

    public function sendModelDetail($model) {
        $year = Carbon::now()->format('Y');
        $data = Unit::where([
            ['year_mc',$year],
            ['model_name',str_replace('_', ' ', $model)]
        ])
        ->groupBy('model_name')
        ->get();
        return UnitDetailResource::collection($data);
    }

    public function sendCategory(){
        $year = Carbon::now()->format('Y');
        $data = Unit::where('year_mc',$year)
        ->groupBy('category')
        ->get();
        return CategoryResource::collection($data);
    }

    public function sendColor($model) {
        $year = Carbon::now()->format('Y');
        $data = Unit::join('colors','units.color_id','colors.id')
        ->where([
            ['units.year_mc',$year],
            ['units.model_name',str_replace('_', ' ', $model)]
        ])
        ->groupBy('colors.color_name')
        ->get();
        return ColorResource::collection($data);
    }

    public function sendImage($model) {
        $year = Carbon::now()->format('Y');
        $data = Unit::join('colors','units.color_id','colors.id')
        ->where([
            ['units.year_mc',$year],
            ['units.model_name',str_replace('_', ' ', $model)]
        ])
        ->groupBy('colors.color_name')
        ->get();
        return ImageResource::collection($data);
    }
}
