<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;
use App\Models\User;
use App\Models\Spk;

class Leasing extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi to Sales
    public function sale(){
        return $this->hasMany(Sale::class);
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
    public function spk(){
        return $this->hasMany(Spk::class);
    }
}
