<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SaleDelivery;
use App\Models\BranchDelivery;
use App\Models\Dealer;
use App\Models\Spk;

class Manpower extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi to Sale Deliveries
    public function saleDeliveryMain(){
        return $this->hasMany(SaleDelivery::class, 'main_driver');
    }

    public function saleDeliveryBackup(){
        return $this->hasMany(SaleDelivery::class, 'backup_driver');
    }

    // Relasi to Branch Deliveries

    public function branchDeliveryMain(){
        return $this->hasMany(BranchDelivery::class, 'main_driver');
    }

    public function branchDeliveryBackup(){
        return $this->hasMany(BranchDelivery::class, 'backup_driver');
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

    // Relasi to SPK
    public function spk(){
        return $this->hasMany(Spk::class);
    }
}
