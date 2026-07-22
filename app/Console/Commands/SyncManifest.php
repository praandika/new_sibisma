<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DealerApi;
use App\Models\UnitOnhand;

class SyncManifest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:manifest';

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
        $dealerApi = DealerApi::where('status',1)->get();

        foreach($dealerApi as $api){

            $response = Http::timeout(60)
                ->acceptJson()
                ->withQueryParameters([
                    'dealerCd' => $api->dealer_code,
                    'accessToken' => $api->token
                ])
            ->post(
                'https://yimmdpackwebapi.ymcapps.net/dpackweb/api/v1/manifestdata',
                [
                    'targetDate' => now()->format('Ymd')
                ]
            );

            if(!$response->successful()){
                $this->error($dealerApi->dealer_code." gagal");
                continue;
            }

            $data = $response->json()['data'];

            $insert = [];

            foreach ($data as $header) {
                foreach ($header['detail-datas'] as $detail) {
                    foreach ($detail['subdetail-datas'] as $sub) {

                        $insert[] = [

                            // Dealer
                            'point_code' => $header['h.site_id_'],
                            // LANJUT DISINI, CEK DATA API DI POSTMAN DULU
                            // Header
                            'site_id' => $header['h.site_id'],
                            'truck_no' => $header['h.truck_no'],
                            'expedition' => $header['h.expedition'],
                            'point_code' => $header['h.point_code'],
                            'slip_no' => $header['h.slip_no'],
                            'supplier_code' => $header['h.supplier_code'],
                            'receive_date' => $header['h.receive_date'],

                            // Detail
                            'sj_no' => $detail['d.sj_no'],
                            'sj_date' => $detail['d.sj_date'],
                            'model_code' => $detail['d.model_code'],
                            'model_name' => $detail['d.model_name'],
                            'color' => $detail['d.color'],
                            'receipt_qty' => $detail['d.receipt_qty'],

                            // Sub Detail
                            'do_no' => $sub['s.do_no'],
                            'do_date' => $sub['s.do_date'],
                            'frame_no' => $sub['s.frame_no'],
                            'engine_no' => $sub['s.engineine_no'] ?? null, // cek lagi nama key API
                            'frame_key' => $sub['s.frame_key'],
                            'faktur_no' => $sub['s.faktur_no'],
                            'nik_no' => $sub['s.nik_no'],
                            'assembly_date' => $sub['s.assembly_date'],

                            'created_at'=>now(),
                            'updated_at'=>now()
                        ];
                    }
                }
            }
        }
    }
}
