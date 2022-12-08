<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Dealer;

class StockHistory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi to Dealer
    public function dealer(){
        return $this->belongsTo(Dealer::class, 'dealer_code', 'dealer_code');
    }

    // Relasi to User
    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi to User
    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }
}
