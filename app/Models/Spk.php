<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stock;
use App\Models\Leasing;
use App\Models\Manpower;
use App\Models\SaleDelivery;
use App\Models\HistoryCredit;
use App\Models\Sale;

class Spk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi to Stock
    public function stock(){
        return $this->belongsTo(Stock::class);
    }

    // Relasi to Leasing
    public function leasing(){
        return $this->belongsTo(Leasing::class);
    }

    // Relasi to Manpower
    public function manpower(){
        return $this->belongsTo(Manpower::class);
    }

    // Relasi to User
    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi to User
    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Relasi to SPK
    public function saleDelivery(){
        return $this->hasOne(SaleDelivery::class, 'spk_no', 'spk_no');
    }

    // Relasi to History Credit
    public function historyCredit(){
        return $this->hasMany(HistoryCredit::class, 'spk_no', 'spk_no');
    }

    // Relasi to Sale
    public function sale(){
        return $this->hasOne(Sale::class);
    }
}
