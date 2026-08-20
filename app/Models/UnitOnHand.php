<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Dealer;
use App\Models\MasterUnit;

class UnitOnHand extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi to Dealer
    public function dealer(){
        return $this->belongsTo(Dealer::class, 'dealer_code', 'dealer_code');
    }

    // Relasi to Dealer for Point Code
    public function point(){
        return $this->belongsTo(Dealer::class, 'point_code', 'dealer_code');
    }

    // Relasi to Master Unit
    public function masterUnit(){
        return $this->belongsTo(MasterUnit::class, 'model_name', 'model_name');
    }
}
