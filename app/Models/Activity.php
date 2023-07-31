<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PhotoActivity;

class Activity extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi to PhotoActivity
    public function photoActivity(){
        return $this->hasMany(PhotoActivity::class);
    }
}
