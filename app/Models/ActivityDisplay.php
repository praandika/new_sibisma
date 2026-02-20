<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityDisplay extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi to Activities
    public function activities(){
        return $this->hasMany(Activities::class);
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
