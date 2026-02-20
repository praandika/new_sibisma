<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stock;
use App\Models\User;
use App\Models\Manpower;
use App\Models\Entry;
use App\Models\Out;
use App\Models\StockHistory;

class Dealer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi to Stock
    public function stock(){
        return $this->hasMany(Stock::class);
    }

    // Relasi to Entry
    public function entry(){
        return $this->hasMany(Entry::class);
    }

    // Relasi to Out
    public function out(){
        return $this->hasMany(Out::class);
    }

    // Relasi to Stok History
    public function history(){
        return $this->hasMany(StockHistory::class, 'dealer_code', 'dealer_code');
    }

    // Relasi to Activities
    public function activities(){
        return $this->hasMany(Activities::class);
    }

    // Relasi to User
    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi to Manpower
    public function manpower(){
        return $this->hasOne(Manpower::class);
    }

    // Relasi to User
    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }
}
