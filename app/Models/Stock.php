<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dealer;
use App\Models\Unit;
use App\Models\Entry;
use App\Models\Opname;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi to Dealer
    public function dealer(){
        return $this->belongsTo(Dealer::class);
    }

    // Relasi to Unit
    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    // Relasi to Entry Stock
    public function entry(){
        return $this->hasMany(Entry::class);
    }

    // Relasi to Opname
    public function opname(){
        return $this->hasMany(Opname::class);
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
