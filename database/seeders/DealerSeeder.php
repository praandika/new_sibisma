<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dealer;
use Carbon\Carbon;

class DealerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dealer::insert([
            'dealer_code' => 'YIMM',
            'dealer_name' => 'Yamaha Indonesia Motor MFG',
            'address' => 'Jl. Dr. KRT Radjiman Widyodiningrat No.KM. 23, RW.4, Rw. Terate, Kota Jakarta Timur',
            'phone' => '(021) 4612222',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Dealer::insert([
            'dealer_code' => 'AA0101',
            'dealer_name' => 'Bisma Sentral',
            'address' => 'Jl. Teuku Umar No.142, Denpasar',
            'phone' => '0361 232528',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Dealer::insert([
            'dealer_code' => 'AA0102',
            'dealer_name' => 'Bisma Cokro',
            'address' => 'Jl. Cokroaminoto No.78, Pemecutan Kaja, Denpasar',
            'phone' => '0361 434775',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Dealer::insert([
            'dealer_code' => 'AA0104',
            'dealer_name' => 'Bisma Hasanuddin',
            'address' => 'Jl. Hasanuddin No.74, Pemecutan, Denpasar',
            'phone' => '0361 422660',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Dealer::insert([
            'dealer_code' => 'AA0104-01',
            'dealer_name' => 'Bisma Dalung',
            'address' => 'Jl. Raya Padang Luwih No.17, Dalung, Badung',
            'phone' => '0813 3863 5112',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Dealer::insert([
            'dealer_code' => 'AA0104F',
            'dealer_name' => 'Flagship Shop',
            'address' => 'Jl. Diponegoro No.57, Denpasar',
            'phone' => '0361 238800',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Dealer::insert([
            'dealer_code' => 'AA0105',
            'dealer_name' => 'Bisma Tri Tunggal Sejahtera',
            'address' => 'JL. Jend Gatot Subroto Tengah No. 21-X, Denpasar',
            'phone' => '0361 410535',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Dealer::insert([
            'dealer_code' => 'AA0106',
            'dealer_name' => 'Bisma Imam Bonjol',
            'address' => 'Jl. Imam Bonjol No.551C, Pemecutan Klod, Denpasar',
            'phone' => '0361 499389',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Dealer::insert([
            'dealer_code' => 'AA0107',
            'dealer_name' => 'Bisma Mandiri',
            'address' => 'Jl. Teuku Umar Barat No. 100X Malboro, Denpasar',
            'phone' => '0361 490690',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Dealer::insert([
            'dealer_code' => 'AA0108',
            'dealer_name' => 'Bisma WR Supratman',
            'address' => 'Jl. WR Supratman No.76, Sumerta, Denpasar',
            'phone' => '0361 243056',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);

        Dealer::insert([
            'dealer_code' => 'AA0109',
            'dealer_name' => 'Bisma Sunset Road',
            'address' => 'Jl. Sunset Road No.162, Legian, Kuta, Kabupaten Badung',
            'phone' => '0361 758140',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now('GMT+8'),
        ]);
    }
}
