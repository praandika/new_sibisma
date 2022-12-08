<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Sale;
use App\Models\Manpower;

class SaleDelivery extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi to Sales
    public function sale(){
        return $this->belongsTo(Sale::class);
    }

    // Relasi to User
    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi to User
    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Relasi to Manpower
    public function mainDriver(){
        return $this->belongsTo(Manpower::class, 'main_driver');
    }

    // Relasi to Manpower
    public function backupDriver(){
        return $this->belongsTo(Manpower::class, 'backup_driver');
    }
}
