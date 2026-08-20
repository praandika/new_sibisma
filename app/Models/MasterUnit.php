<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\UnitOnHand;

class MasterUnit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi to Unit On Hand
    public function stock(){
        return $this->hasMany(UnitOnHand::class, 'model_name', 'model_name');
    }
}
