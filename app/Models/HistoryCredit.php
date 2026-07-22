<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Leasing;

class HistoryCredit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi to Leasing
    public function leasing(){
        return $this->belongsTo(Leasing::class);
    }
}
