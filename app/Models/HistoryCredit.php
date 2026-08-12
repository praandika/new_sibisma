<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Spk;
use App\Models\User;

class HistoryCredit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi to SPK
    public function spk(){
        return $this->belongsTo(Spk::class, 'spk_no', 'spk_no');
    }

    // Relasi to User
    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }
}
