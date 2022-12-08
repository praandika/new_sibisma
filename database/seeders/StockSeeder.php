<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stock;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stock::insert([
            'unit_id' => '1',
            'dealer_id' => '2',
            'qty' => 0,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Stock::insert([
            'unit_id' => '2',
            'dealer_id' => '3',
            'qty' => 0,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Stock::insert([
            'unit_id' => '3',
            'dealer_id' => '4',
            'qty' => 0,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Stock::insert([
            'unit_id' => '4',
            'dealer_id' => '5',
            'qty' => 0,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Stock::insert([
            'unit_id' => '5',
            'dealer_id' => '6',
            'qty' => 0,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Stock::insert([
            'unit_id' => '6',
            'dealer_id' => '7',
            'qty' => 0,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Stock::insert([
            'unit_id' => '7',
            'dealer_id' => '8',
            'qty' => 0,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Stock::insert([
            'unit_id' => '9',
            'dealer_id' => '10',
            'qty' => 0,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Stock::insert([
            'unit_id' => '10',
            'dealer_id' => '11',
            'qty' => 0,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }
}
