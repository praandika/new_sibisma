<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'first_name' => 'I Wayan Andika',
            'last_name' => 'Pranayoga',
            'name' => 'I Wayan Andika Pranayoga',
            'dealer_code' => 'group',
            'email' => 'praandikayoga@gmail.com',
            'username' => 'andika',
            'email_verified_at' => Carbon::now('GMT+8'),
            'password' => bcrypt('andika*#'),
            'access' => 'master',
            'created_at' => Carbon::now('GMT+8'),
        ]);

        User::insert([
            'first_name' => 'Bisma Sentral',
            'last_name' => 'Yamaha',
            'name' => 'Bisma Sentral Yamaha',
            'dealer_code' => 'AA0101',
            'email' => 'aa0101yc@gmail.com',
            'username' => 'sentral',
            'email_verified_at' => Carbon::now('GMT+8'),
            'password' => bcrypt('bismaaa0101'),
            'access' => 'admin',
            'created_at' => Carbon::now('GMT+8'),
        ]);

        User::insert([
            'first_name' => 'Bisma Cokro',
            'last_name' => 'Yamaha',
            'name' => 'Bisma Cokro Yamaha',
            'dealer_code' => 'AA0102',
            'email' => 'bmm.bismacokro78@gmail.com',
            'username' => 'cokro',
            'email_verified_at' => Carbon::now('GMT+8'),
            'password' => bcrypt('bismaaa0102'),
            'access' => 'admin',
            'created_at' => Carbon::now('GMT+8'),
        ]);

        User::insert([
            'first_name' => 'Bisma Hasanuddin',
            'last_name' => 'Yamaha',
            'name' => 'Bisma Hasanuddin Yamaha',
            'dealer_code' => 'AA0104',
            'email' => 'bismahsn.aa0104@gmail.com',
            'username' => 'udbisma',
            'email_verified_at' => Carbon::now('GMT+8'),
            'password' => bcrypt('bismaaa0104'),
            'access' => 'admin',
            'created_at' => Carbon::now('GMT+8'),
        ]);

        User::insert([
            'first_name' => 'Bisma Tri Tunggal Sejahtera',
            'last_name' => 'Yamaha',
            'name' => 'Bisma Tri Tunggal Sejahtera Yamaha',
            'dealer_code' => 'AA0105',
            'email' => 'aa0105tts@gmail.com',
            'username' => 'gatsu',
            'email_verified_at' => Carbon::now('GMT+8'),
            'password' => bcrypt('bismaaa0105'),
            'access' => 'admin',
            'created_at' => Carbon::now('GMT+8'),
        ]);

        User::insert([
            'first_name' => 'Bisma Imbo',
            'last_name' => 'Yamaha',
            'name' => 'Bisma Imbo Yamaha',
            'dealer_code' => 'AA0106',
            'email' => 'aa0106bismaimbo@gmail.com',
            'username' => 'imbo',
            'email_verified_at' => Carbon::now('GMT+8'),
            'password' => bcrypt('bismaaa0106'),
            'access' => 'admin',
            'created_at' => Carbon::now('GMT+8'),
        ]);

        User::insert([
            'first_name' => 'Bisma Mandiri',
            'last_name' => 'Yamaha',
            'name' => 'Bisma Mandiri Yamaha',
            'dealer_code' => 'AA0107',
            'email' => 'bismamandiri.aa0107@gmail.com',
            'username' => 'mandiri',
            'email_verified_at' => Carbon::now('GMT+8'),
            'password' => bcrypt('bismaaa0107'),
            'access' => 'admin',
            'created_at' => Carbon::now('GMT+8'),
        ]);

        User::insert([
            'first_name' => 'Bisma Supratman',
            'last_name' => 'Yamaha',
            'name' => 'Bisma Supratman Yamaha',
            'dealer_code' => 'AA0108',
            'email' => 'bismasupratman@gmail.com',
            'username' => 'supratman',
            'email_verified_at' => Carbon::now('GMT+8'),
            'password' => bcrypt('bismaaa0108'),
            'access' => 'admin',
            'created_at' => Carbon::now('GMT+8'),
        ]);

        User::insert([
            'first_name' => 'Bisma Sunset Road',
            'last_name' => 'Yamaha',
            'name' => 'Bisma Sunset Road Yamaha',
            'dealer_code' => 'AA0109',
            'email' => 'aa0109bismasr@gmail.com',
            'username' => 'sunset',
            'email_verified_at' => Carbon::now('GMT+8'),
            'password' => bcrypt('bismaaa0109'),
            'access' => 'admin',
            'created_at' => Carbon::now('GMT+8'),
        ]);

        User::insert([
            'first_name' => 'Flagship Shop',
            'last_name' => 'Yamaha',
            'name' => 'Flagship Shop Yamaha',
            'dealer_code' => 'AA0104F',
            'email' => 'bismamotor57@gmail.com',
            'username' => 'fss',
            'email_verified_at' => Carbon::now('GMT+8'),
            'password' => bcrypt('bismaaa0104f'),
            'access' => 'admin',
            'created_at' => Carbon::now('GMT+8'),
        ]);

        User::insert([
            'first_name' => 'Bisma Dalung',
            'last_name' => 'Yamaha',
            'name' => 'Bisma Dalung Yamaha',
            'dealer_code' => 'AA0104-01',
            'email' => 'bismadalung@gmail.com',
            'username' => 'dalung',
            'email_verified_at' => Carbon::now('GMT+8'),
            'password' => bcrypt('bismaaa01041'),
            'access' => 'admin',
            'created_at' => Carbon::now('GMT+8'),
        ]);
    }
}
