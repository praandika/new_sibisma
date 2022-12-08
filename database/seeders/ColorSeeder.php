<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;
use Carbon\Carbon;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        Color::insert([
            'color_name' => 'Silver',
            'color_code' => '#d8e2e6',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        // 2
        Color::insert([
            'color_name' => 'Red',
            'color_code' => '#e31010',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        // 3
        Color::insert([
            'color_name' => 'White',
            'color_code' => '#ffffff',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        // 4
        Color::insert([
            'color_name' => 'Blue',
            'color_code' => '#0a0fa8',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        // 5
        Color::insert([
            'color_name' => 'Yellow',
            'color_code' => '#f1f50a',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        // 6
        Color::insert([
            'color_name' => 'Orange',
            'color_code' => '#f5a30a',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        // 7
        Color::insert([
            'color_name' => 'Green',
            'color_code' => '#047a0a',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        // 8
        Color::insert([
            'color_name' => 'Grey',
            'color_code' => '#828282',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        // 9
        Color::insert([
            'color_name' => 'Black',
            'color_code' => '#000000',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        // 10
        Color::insert([
            'color_name' => 'Cyan',
            'color_code' => '#4af3ff',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        // 11
        Color::insert([
            'color_name' => 'Pink',
            'color_code' => '#ff99f8',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        // 12
        Color::insert([
            'color_name' => 'Gold',
            'color_code' => '#8a8100',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        // 13
        Color::insert([
            'color_name' => 'Tosca',
            'color_code' => '#33d4a1',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);
    }
}
