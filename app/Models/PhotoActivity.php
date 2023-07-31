<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;

class PhotoActivity extends Model
{
    use HasFactory;

    // Relasi to Activity
    public function activity(){
        return $this->belongsTo(Activity::class);
    }
}
