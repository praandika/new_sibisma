<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command as CommandStatus;
use App\Models\UnitOnhand;
use App\Helpers\FrameHelper;
use Illuminate\Support\Facades\DB;
use Carbon\CarbonInterval;
use Carbon\Carbon;

class SyncManifest extends BaseSyncCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:manifest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync manifest data from API to local database';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $endpoint = 'https://yimmdpackwebapi.ymcapps.net/dpackweb/api/v1/manifestdata';

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
        $masterPrices = $this->getMasterPrices();

        $insert = [];

        $now = now();

        $start = $now;

        $date = $now->subDays(2);

         // Request API untuk mengambil data manifest dari dealer dan menyimpannya ke database lokal
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
                        'sync:manifest',
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
                    $this->logWarning($dealer->dealer_code, "Tidak ada data manifest untuk tanggal ".$now->format('Y-m-d'));

                    // Save log untuk dealer yang tidak memiliki data manifest
                    $this->saveLog(
                        'sync:manifest',
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

                    $receiveDate = !empty($header['h.receive_date_'])
                    ? Carbon::createFromFormat('Ymd', $header['h.receive_date_'])->format('Y-m-d')
                    : null;
                    
                    foreach ($header['detail-datas'] as $detail) {
                        foreach ($detail['subdetail-datas'] as $sub) {
                            // Get Year MC
                            $frameNo = $sub['s.frame_no_'];
                            $yearMc = FrameHelper::getYearMc($frameNo);

                            // Get Price
                            $modelName = strtoupper(trim($detail['d.model_name_']));

                            $price = $masterPrices[$modelName] ?? 0;

                            $assemblyDate = null;

                            if(!empty($sub['s.assembly_date_'])){

                                $assemblyDate = Carbon::createFromFormat(
                                    'Ymd',
                                    $sub['s.assembly_date_']
                                )->format('Y-m-d');

                            }

                            $row = [
                                'dealer_code' => $dealer->dealer_code,
                                // Header
                                'point_code' => $header['h.point_code_'],
                                'receive_time' => $receiveDate,

                                // Detail
                                'model_name' => $modelName,
                                'faktur_color' => $detail['d.color_'],
                                'price' => $price,

                                // Sub Detail
                                'frame_no' => $sub['s.frame_no_'],
                                'engine_no' => $sub['s.engine_no_'],
                                'assembly_date' => $assemblyDate,
                                'year_mc' => $yearMc,
                                

                                'created_at'=>$now,
                                'updated_at'=>$now
                            ];

                            $insert[] = $row;

                            $dealerTotal++;
                        }
                    }
                }

                $this->logSuccess($dealer->dealer_code, $dealerTotal);

                // Save log untuk dealer yang berhasil melakukan sync manifest
                $this->saveLog(
                    'sync:manifest',
                    $dealer->dealer_code,
                    'SUCCESS',
                    $dealerTotal,
                    'Sync berhasil',
                    $dealerStart,
                    now()
                );

            } catch (\Throwable $e) {
                $this->logError($dealer->dealer_code, "Gagal API: data tanggal ".$date->format('Y-m-d')." - ".$e->getMessage());

                // Save log untuk dealer yang gagal melakukan sync manifest
                $this->saveLog(
                    'sync:manifest',
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

        // Insert or Update data to UnitOnhand table
        if (!empty($insert)) {
            try {

                DB::transaction(function () use ($insert) {

                    UnitOnhand::upsert(
                        $insert,
                        ['frame_no'], // Unique key for upsert
                        
                        [
                            'dealer_code',
                            'point_code',
                            'receive_time',
                            'model_name',
                            'faktur_color',
                            'price',
                            'engine_no',
                            'assembly_date',
                            'year_mc',
                            'updated_at'
                        ]
                    );

                });
                
            } catch (\Throwable $e) {
                $this->info("Gagal menyimpan data ke database: ".$e->getMessage());

                // Save log untuk error tidak berhasil menyimpan data ke database
                $this->saveLog(
                    'sync:manifest',
                    null,
                    'FAILED',
                    0,
                    'Database Error : '.$e->getMessage(),
                    $start,
                    now()
                );
                return CommandStatus::FAILURE;
            }

            $this->info("Sync manifest selesai. Total data : ".count($insert));
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
