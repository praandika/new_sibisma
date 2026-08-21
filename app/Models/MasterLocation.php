<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StockOpnameDetail;
use App\Models\Dealer;

class MasterLocation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Location mempunyai banyak detail stock opname
     * berdasarkan lokasi sistem.
     */
    public function systemOpnameDetails()
    {
        return $this->hasMany(
            StockOpnameDetail::class,
            'system_location_id',
            'id'
        );
    }

    /**
     * Location mempunyai banyak detail stock opname
     * berdasarkan lokasi fisik.
     */
    public function physicalOpnameDetails()
    {
        return $this->hasMany(
            StockOpnameDetail::class,
            'physical_location_id',
            'id'
        );
    }

    public function dealer()
    {
        return $this->belongsTo(
            Dealer::class,
            'dealer_code',
            'dealer_code'
        );
    }
}
