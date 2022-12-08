<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Leasing;
use Carbon\Carbon;

class LeasingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Leasing::insert([
            'leasing_code' => 'CASH',
            'leasing_name' => 'Cash',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Leasing::insert([
            'leasing_code' => 'BAF',
            'leasing_name' => 'Bussan Auto Finance',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Leasing::insert([
            'leasing_code' => 'ADR',
            'leasing_name' => 'Adira Finance',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Leasing::insert([
            'leasing_code' => 'SOF',
            'leasing_name' => 'Summit Oto Finance',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Leasing::insert([
            'leasing_code' => 'MUF',
            'leasing_name' => 'Mandiri Utama Finance',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Leasing::insert([
            'leasing_code' => 'WOM',
            'leasing_name' => 'Wahana Ottomitra Multiartha Finance',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Leasing::insert([
            'leasing_code' => 'BCA',
            'leasing_name' => 'Bank Central Asia Finance',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Leasing::insert([
            'leasing_code' => 'KOPERASI',
            'leasing_name' => 'Koperasi',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Leasing::insert([
            'leasing_code' => 'LPD',
            'leasing_name' => 'Lembaga Pengkreditan Desa',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Leasing::insert([
            'leasing_code' => 'BPR',
            'leasing_name' => 'Bank Pengkreditan Rakyat',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Leasing::insert([
            'leasing_code' => 'INDOMOBIL',
            'leasing_name' => 'Indomobil Finance',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Leasing::insert([
            'leasing_code' => 'PEGADAIAN',
            'leasing_name' => 'Pegadaian',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Leasing::insert([
            'leasing_code' => 'INSTANSI',
            'leasing_name' => 'Instansi',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Leasing::insert([
            'leasing_code' => 'OTHER',
            'leasing_name' => 'Other',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);
    }
}
