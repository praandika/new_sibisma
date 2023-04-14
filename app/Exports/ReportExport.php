<?php

namespace App\Exports;

use App\Models\Entry;
use App\Models\Sale;
use App\Models\Out;
use App\Models\SaleDelivery;
use App\Models\BranchDelivery;
use App\Models\Document;
use App\Models\StockHistory;
use App\Models\Dealer;
use App\Models\Log;
use App\Models\Opname;
use App\Models\Spk;
use App\Models\Stock;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\Auth;

class ReportExport implements FromView
{
    use Exportable;

    public function start(string $start)
    {
        $this->start = $start;
        return $this;
    }

    public function end(string $end)
    {
        $this->end = $end;
        return $this;
    }

    public function param(string $param){
        $this->param = $param;
        return $this;
    }

    public function view(): View{
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        
        if ($this->param == 'entry') {
            if ($dc == 'group') {
                return view('export.entry',[
                    'data' => Entry::whereBetween('entry_date', [$this->start, $this->end])
                    ->orderBy('entry_date','asc')->get()
                ]);
            } else {
                return view('export.entry',[
                    'data' => Entry::join('stocks','entries.stock_id','stocks.id')
                    ->join('dealers','entries.dealer_id','dealers.id')
                    ->where('stocks.dealer_id',$did)
                    ->whereBetween('entry_date', [$this->start, $this->end])
                    ->orderBy('entry_date','asc')
                    ->select('dealers.dealer_name','stocks.*','entries.*')->get()
                ]);
            }
        }elseif($this->param == 'sale') {
            if ($dc == 'group') {
                return view('export.sale_simple',[
                    'data' => Sale::join('stocks','sales.stock_id','stocks.id')
                    ->whereBetween('sales.sale_date', [$this->start, $this->end])
                    ->orderBy('sales.sale_date','asc')->get()
                ]);
            } else {
                if (Auth::user()->crud == 'simple') {
                    return view('export.sale_simple',[
                        'data' => Sale::join('stocks','sales.stock_id','stocks.id')
                        ->where('stocks.dealer_id',$did)
                        ->whereBetween('sales.sale_date', [$this->start, $this->end])
                        ->orderBy('sales.sale_date','asc')->get()
                    ]);
                } else {
                    return view('export.sale',[
                        'data' => Sale::join('stocks','sales.stock_id','stocks.id')
                        ->join('spks','sales.spk','spks.spk_no')
                        ->join('manpowers','spks.manpower_id','manpowers.id')
                        ->where('stocks.dealer_id',$did)
                        ->whereBetween('sales.sale_date', [$this->start, $this->end])
                        ->orderBy('sales.sale_date','asc')
                        ->select('*','manpowers.name as salesman','sales.address as sale_address')->get()
                    ]);
                }
            }
        }elseif($this->param == 'out') {
            if ($dc == 'group') {
                return view('export.out',[
                    'data' => Out::whereBetween('out_date', [$this->start, $this->end])
                    ->orderBy('out_date','asc')->get()
                ]);
            } else {
                return view('export.out',[
                    'data' => Out::join('stocks','outs.stock_id','stocks.id')
                    ->join('dealers','outs.dealer_id','dealers.id')
                    ->where('stocks.dealer_id',$did)
                    ->whereBetween('out_date', [$this->start, $this->end])
                    ->orderBy('out_date','asc')
                    ->select('dealers.dealer_name','stocks.*','outs.*')->get()
                ]);
            }
        }elseif($this->param == 'sale-delivery') {
            if ($dc == 'group') {
                return view('export.sale-delivery',[
                    'data' => SaleDelivery::whereBetween('sale_delivery_date', [$this->start, $this->end])
                    ->orderBy('sale_delivery_date','asc')->get()
                ]);
            } else {
                return view('export.sale-delivery',[
                    'data' => SaleDelivery::with(['sale.stock'], function($query){
                        $dc = Auth::user()->dealer_code;
                        $did = Dealer::where('dealer_code',$dc)->sum('id');
                        $query->where('stock.dealer_id',$did);
                    })
                    ->whereBetween('sale_delivery_date', [$this->start, $this->end])
                    ->orderBy('sale_delivery_date','asc')->get()
                ]);
            }
        }elseif($this->param == 'branch-delivery') {
            if ($dc == 'group') {
                return view('export.branch-delivery',[
                    'data' => BranchDelivery::whereBetween('branch_delivery_date', [$this->start, $this->end])
                    ->orderBy('branch_delivery_date','asc')->get()
                ]);
            } else {
                return view('export.branch-delivery',[
                    'data' => BranchDelivery::with(['out.stock'], function($query){
                        $dc = Auth::user()->dealer_code;
                        $did = Dealer::where('dealer_code',$dc)->sum('id');
                        $query->where('stock.dealer_id',$did);
                    })
                    ->whereBetween('branch_delivery_date', [$this->start, $this->end])
                    ->orderBy('branch_delivery_date','asc')->get()
                ]);
            }
        }elseif($this->param == 'stock-history') {
            if ($dc == 'group') {
                return view('export.stock-history',[
                    'data' => StockHistory::whereBetween('history_date', [$this->start, $this->end])
                    ->orderBy('history_date','asc')->get()
                ]);
            } else {
                return view('export.stock-history',[
                    'data' => StockHistory::where('dealer_code',$dc)
                    ->whereBetween('history_date', [$this->start, $this->end])
                    ->orderBy('history_date','asc')->get()
                ]);
            }
        }elseif($this->param == 'document') {
            if ($dc == 'group') {
                return view('export.document',[
                    'data' => Document::join('sales','documents.sale_id','sales.id')
                    ->whereBetween('sale_date', [$this->start, $this->end])
                    ->orderBy('sale_date','asc')->get()
                ]);
            } else {
                $dc = Auth::user()->dealer_code;
                $did = Dealer::where('dealer_code',$dc)->sum('id');
                return view('export.document',[
                    'data' => Document::join('sales','documents.sale_id','sales.id')
                    ->join('stocks','sales.stock_id','stocks.id')
                    ->join('units','stocks.unit_id','units.id')
                    ->whereBetween('sales.sale_date', [$this->start, $this->end])
                    ->where('stocks.dealer_id',$did)
                    ->orderBy('sales.sale_date','asc')->get()
                ]);
            }
        }elseif($this->param == 'opname'){
            if ($dc == 'group') {
                return view('export.opname',[
                    'data' => Opname::whereBetween('opname_date', [$this->start, $this->end])
                    ->orderBy('opname_date','asc')->get()
                ]);
            } else {
                $dc = Auth::user()->dealer_code;
                $did = Dealer::where('dealer_code',$dc)->sum('id');
                return view('export.opname',[
                    'data' => Opname::join('stocks','opnames.stock_id','stocks.id')
                    ->where('stocks.dealer_id',$did)
                    ->whereBetween('opname_date', [$this->start, $this->end])
                    ->orderBy('opname_date','asc')->get()
                ]);
            }
        }elseif($this->param == 'spk'){
            if ($dc == 'group') {
                return view('export.spk',[
                    'data' => Spk::join('stocks','spks.stock_id','stocks.id')
                    ->join('units','stocks.unit_id','units.id')
                    ->join('colors','units.color_id','colors.id')
                    ->join('users','spks.created_by','users.id')
                    ->join('manpowers','spks.manpower_id','manpowers.id')
                    ->whereBetween('spks.spk_date', [$this->start, $this->end])
                    ->select('*','spks.address as customer_address')
                    ->orderBy('spks.spk_date','asc')->get()
                ]);
            } else {
                $dc = Auth::user()->dealer_code;
                $did = Dealer::where('dealer_code',$dc)->sum('id');
                return view('export.spk',[
                    'data' => Spk::join('stocks','spks.stock_id','stocks.id')
                    ->join('units','stocks.unit_id','units.id')
                    ->join('colors','units.color_id','colors.id')
                    ->join('users','spks.created_by','users.id')
                    ->join('manpowers','spks.manpower_id','manpowers.id')
                    ->where('stocks.dealer_id',$did)
                    ->whereBetween('spks.spk_date', [$this->start, $this->end])
                    ->select('*','spks.address as customer_address')
                    ->orderBy('spks.spk_date','asc')->get()
                ]);
            }
        }elseif($this->param == 'log') {
            return view('export.log',[
                'data' => Log::whereBetween('log_date', [$this->start, $this->end])
                ->orderBy('log_date','asc')->get()
            ]);
        }elseif($this->param == 'stock') {
            if ($dc == 'group') {
                return view('export.stock',[
                    'data' => Stock::join('units','stocks.unit_id','units.id')
                        ->join('dealers','stocks.dealer_id','dealers.id')
                        ->join('colors','units.color_id','colors.id')
                        ->where('stocks.qty','>',0)
                        ->orderBy('units.year_mc')->get()
                ]);
            } else {
                return view('export.stock',[
                    'data' => Stock::join('units','stocks.unit_id','units.id')
                        ->join('dealers','stocks.dealer_id','dealers.id')
                        ->join('colors','units.color_id','colors.id')
                        ->where('stocks.qty','>',0)
                        ->orderBy('units.year_mc')
                        ->where('stocks.dealer_id',$did)->get()
                ]);
            }
        }else{
            return view('export.error');
        }
    }
}
