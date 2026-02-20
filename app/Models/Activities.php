<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Acttype;
use App\Models\Dealer;

class Activities extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi to User
    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi to User
    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Relasi to Type Activities
    public function acttype(){
        return $this->belongsTo(Acttype::class);
    }

    // Relasi to Dealer
    public function dealer(){
        return $this->belongsTo(Dealer::class);
    }

    // Relasi to Activity Display
    public function activityDisplay(){
        return $this->hasMany(ActivityDisplay::class);
    }

    // Relasi to Activity Salesman
    public function activitySalesman(){
        return $this->hasMany(ActivitySalesman::class);
    }

    // Relasi to Activity SPV
    public function activitySpv(){
        return $this->hasMany(ActivitySpv::class);
    }

    // Relasi to Activity Unit Sales
    public function activityUnitSale(){
        return $this->hasMany(ActivityUnitSale::class);
    }
}
