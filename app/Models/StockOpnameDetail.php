<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StockOpname;
use App\Models\MasterLocation;
use App\Models\UnitOnHand;

class StockOpnameDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Detail milik satu StockOpname.
     */
    public function stockOpname()
    {
        return $this->belongsTo(
            StockOpname::class,
            'stock_opname_id',
            'id'
        );
    }

    /**
     * Detail mengacu ke UnitOnHand.
     */
    public function unitOnHand()
    {
        return $this->belongsTo(
            UnitOnHand::class,
            'unit_on_hand_id',
            'id'
        );
    }

    /**
     * Lokasi menurut sistem.
     */
    public function systemLocation()
    {
        return $this->belongsTo(
            MasterLocation::class,
            'system_location_id',
            'id'
        );
    }

    /**
     * Lokasi fisik saat opname.
     */
    public function physicalLocation()
    {
        return $this->belongsTo(
            MasterLocation::class,
            'physical_location_id',
            'id'
        );
    }
}
