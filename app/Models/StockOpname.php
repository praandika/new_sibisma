<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StockOpnameDetail;

class StockOpname extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Satu opname memiliki banyak detail unit.
     */
    public function details()
    {
        return $this->hasMany(
            StockOpnameDetail::class,
            'stock_opname_id',
            'id'
        );
    }
}
