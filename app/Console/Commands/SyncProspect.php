<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command as CommandStatus;
use App\Models\Prospect;
use Illuminate\Support\Facades\DB;
use Carbon\CarbonInterval;
use Carbon\Carbon;

class SyncProspect extends BaseSyncCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:prospect';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync prospect data from API to local database';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $endpoint = 'https://yimmdpackwebapi.ymcapps.net/dpackweb/api/v1/prospectdata';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {
        // Ambil semua data api dalam database dealer_api
        $dealers = $this->getDealers();

        $insert = [];

        $now = now();

        $start = $now->copy();

        $date = $now->subDays(4);

         // Request API untuk mengambil data prospect dari dealer dan menyimpannya ke database lokal
        foreach($dealers as $dealer){

            $dealerStart = now();

            try {
                $response = $this->callApi(
                    $dealer,
                    $this->endpoint,
                    [
                        'targetDate' => $date->format('Ymd')
                    ]
                );

                if(!$response->successful()){
                    $this->logError($dealer->dealer_code, "Gagal request API: ".$date->format('Y-m-d')." - ".$response->body());

                    // Save log untuk dealer yang gagal melakukan request API
                    $this->saveLog(
                        'sync:prospect',
                        $dealer->dealer_code,
                        'FAILED',
                        0,
                        $response->body(),
                        $dealerStart,
                        now()
                    );
                    continue;
                }

                $data = $response->json('data', []);

                if(empty($data)){
                    $this->logWarning($dealer->dealer_code, "Tidak ada data prospect untuk tanggal ".$now->format('Y-m-d'));

                    // Save log untuk dealer yang tidak memiliki data prospect
                    $this->saveLog(
                        'sync:prospect',
                        $dealer->dealer_code,
                        'WARNING',
                        0,
                        'Tidak ada data',
                        $dealerStart,
                        now()
                    );

                    continue;
                }

                $dealerTotal = 0;

                foreach ($data as $header) {
                    $row = [
                        'dealer_code' => $dealer->dealer_code,
                        // Header
                        'point_code' => $header['h.point_code_'],
                        'customer_name' => $header['h.customer_name_'],
                        'ktp_no' => $header['h.ktp_no_'],
                        'prospect_date' => $header['h.prospect_date_'],
                        'data_type' => $header['h.data_type_'],
                        'prospect_type' => $header['h.prospect_type_'],
                        'company_name' => $header['h.company_name_'],
                        'interest_type' => $header['h.interest_motor_type_'],
                        'interest_color' => $header['h.interest_motor_color_'],
                        'gender' => $header['h.gender_'],
                        'occupation' => $header['h.occupation_'],
                        'city' => $header['h.city_'],
                        'district' => $header['h.district_'],
                        'subdistrict' => $header['h.subdistrict_'],
                        'address' => $header['h.address_'],
                        'phone' => $header['h.mobile_phone_'],
                        'salesman' => $header['h.salesman_'],

                        'shipment_address' => $header['h.address_'],
                        'created_at'=>$now,
                        'updated_at'=>$now
                    ];

                    $insert[] = $row;

                    $dealerTotal++;
                }

                $this->logSuccess($dealer->dealer_code, $dealerTotal);

                // Save log untuk dealer yang berhasil melakukan sync prospect
                $this->saveLog(
                    'sync:prospect',
                    $dealer->dealer_code,
                    'SUCCESS',
                    $dealerTotal,
                    'Sync berhasil',
                    $dealerStart,
                    now()
                );

            } catch (\Throwable $e) {
                $this->logError($dealer->dealer_code, "Gagal API: data tanggal ".$date->format('Y-m-d')." - ".$e->getMessage());

                // Save log untuk dealer yang gagal melakukan sync prospect
                $this->saveLog(
                    'sync:prospect',
                    $dealer->dealer_code,
                    'FAILED',
                    0,
                    $e->getMessage(),
                    $dealerStart,
                    now()
                );
                continue;
            }
                
        }

        // Insert or Update data to Prospect table
        if (!empty($insert)) {
            try {

                DB::transaction(function () use ($insert) {

                    Prospect::upsert(
                        $insert,
                        ['dealer_code', 'point_code', 'prospect_date'], // Unique key for upsert
                        
                        [
                            'customer_name',
                            'ktp_no',
                            'data_type',
                            'prospect_type',
                            'company_name',
                            'interest_type',
                            'interest_color',
                            'gender',
                            'occupation',
                            'city',
                            'district',
                            'subdistrict',
                            'address',
                            'phone',
                            'salesman',
                            'shipment_address',
                            'updated_at'
                        ]
                    );

                });
                
            } catch (\Throwable $e) {
                $this->info("Gagal menyimpan data ke database: ".$e->getMessage());

                // Save log untuk error tidak berhasil menyimpan data ke database
                $this->saveLog(
                    'sync:prospect',
                    null,
                    'FAILED',
                    0,
                    'Database Error : '.$e->getMessage(),
                    $start,
                    now()
                );
                return CommandStatus::FAILURE;
            }

            $this->info("Sync prospect selesai. Total data : ".count($insert));
            $duration = CarbonInterval::seconds($start->diffInSeconds(now()))->cascade();

            $this->info(
                "Selesai dalam {$duration->forHumans()}"
            );
        }else{
            $this->info("Tidak ada data yang perlu di-sync.");
        }

        return CommandStatus::SUCCESS;
    }
}
