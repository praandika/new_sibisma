<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stock;
use App\Models\User;
use App\Models\Dealer;

class Entry extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi to Stock
    public function stock(){
        return $this->belongsTo(Stock::class);
    }

    // Relasi to Dealer
    public function dealer(){
        return $this->belongsTo(Dealer::class);
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
