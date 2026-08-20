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
use App\Models\Manpower;
use App\Models\UnitOnHand;
use App\Models\Warehouse;
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
                $data = Sale::with('spk')
                ->whereBetween('sale_date', [$this->start, $this->end])
                ->orderBy('sale_date','asc')->get();

                return view('export.sale_simple', compact('data'));

            } else {
                $data = Sale::with('spk')
                ->where('dealer_code',$dc)
                ->whereBetween('sale_date', [$this->start, $this->end])
                ->orderBy('sale_date','asc')
                ->get();

                return view('export.sale', compact('data'));
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
        }elseif($this->param == 'delivery-order') {
            if ($dc == 'group') {
                $data = SaleDelivery::with('sale')
                ->whereBetween('do_date', [$this->start, $this->end])
                ->orderBy('do_date','asc')
                ->get();

                return view('export.delivery-order', compact('data'));

            } else {
                $data = SaleDelivery::with('sale')
                ->where('dealer_code',$dc)
                ->whereBetween('do_date', [$this->start, $this->end])
                ->orderBy('do_date','asc')
                ->get();

                return view('export.delivery-order', compact('data'));
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
        }elseif($this->param == 'stock-onhand') {
            if ($dc == 'group') {
                $data = UnitOnHand::with('dealer')
                ->where('status','onhand')
                ->get();

                return view('export.stock', compact('data'));

            } else {
                $data = UnitOnHand::with('dealer')
                ->where('dealer_code', $dc)
                ->where('status','onhand')
                ->get();

                return view('export.stock', compact('data'));
            }
        }elseif($this->param == 'stock-sold') {
            if ($dc == 'group') {
                $data = UnitOnHand::with('dealer')
                ->where('status','sold')
                ->whereBetween('updated_at', [$this->start, $this->end])
                ->get();

                return view('export.stock', compact('data'));

            } else {
                $data = UnitOnHand::with('dealer')
                ->where('dealer_code', $dc)
                ->where('status','sold')
                ->whereBetween('updated_at', [$this->start, $this->end])
                ->get();

                return view('export.stock', compact('data'));
            }
        }elseif($this->param == 'stock-mutation') {
            if ($dc == 'group') {
                $data = UnitOnHand::with('dealer')
                ->where('status','mutation')
                ->whereBetween('updated_at', [$this->start, $this->end])
                ->get();

                return view('export.stock', compact('data'));

            } else {
                $data = UnitOnHand::with('dealer')
                ->where('dealer_code', $dc)
                ->where('status','mutation')
                ->whereBetween('updated_at', [$this->start, $this->end])
                ->get();

                return view('export.stock', compact('data'));
            }
        }elseif($this->param == 'stock-requested') {
            if ($dc == 'group') {
                $data = UnitOnHand::with('dealer')
                ->where('status','mutation')
                ->whereBetween('updated_at', [$this->start, $this->end])
                ->get();

                return view('export.stock', compact('data'));

            } else {
                $data = UnitOnHand::with('dealer')
                ->where('point_code', $dc)
                ->where('status','mutation')
                ->whereBetween('updated_at', [$this->start, $this->end])
                ->get();

                return view('export.stock', compact('data'));
            }
        }elseif($this->param == 'manpower') {
            if ($dc == 'group') {
                return view('export.manpower',[
                    'data' => Manpower::join('dealers','manpowers.dealer_id','dealers.id')
                    ->orderBy('name','asc')
                    ->select('*', 'manpowers.phone as manpower_phone', 'manpowers.address as manpower_address')->get()
                ]);
            } else {
                return view('export.manpower',[
                    'data' => Manpower::join('dealers','manpowers.dealer_id','dealers.id')
                    ->where('dealer_id',$did)
                    ->orderBy('name','asc')
                    ->select('*', 'manpowers.phone as manpower_phone', 'manpowers.address as manpower_address')->get()
                ]);
            }
        }elseif($this->param == 'warehouse') {
            if ($dc == 'group') {
                return view('export.warehouse',[
                    'data' => Warehouse::whereBetween('in_date', [$this->start, $this->end])
                    ->orderBy('in_date','asc')->get()
                ]);
            } else {
                return view('export.warehouse',[
                    'data' => Warehouse::where('dealer_code', $dc)
                    ->whereBetween('in_date', [$this->start, $this->end])
                    ->orderBy('in_date','asc')->get()
                ]);
            }
        }else{
            return view('export.error');
        }
    }
}
