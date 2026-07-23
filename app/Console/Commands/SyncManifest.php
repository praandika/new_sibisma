<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DealerApi;
use App\Models\UnitOnhand;
use App\Models\MasterPrice;
use App\Helpers\FrameHelper;
use Carbon\Carbon;

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

            $masterPrices = MasterPrice::pluck('price', 'model_name');

            foreach ($data as $header) {
                foreach ($header['detail-datas'] as $detail) {
                    foreach ($detail['subdetail-datas'] as $sub) {
                        // Get Year MC
                        $frameNo = $sub['s.frame_no_'];
                        $yearMc = FrameHelper::getYearMc($frameNo);

                        // Get Price
                        $modelName = strtoupper(trim($detail['d.model_name_']));

                        $price = $masterPrices[$modelName] ?? 0;

                        $insert[] = [
                            // Header
                            'point_code' => $header['h.point_code_'],
                            'receive_time' => $header['h.receive_date_'],
                            

                            // Detail
                            'model_name' => $detail['d.model_name_'],
                            'faktur_color' => $detail['d.color_'],
                            'price' => $price,

                            // Sub Detail
                            'frame_no' => $sub['s.frame_no_'],
                            'engine_no' => $sub['s.engine_no_'],
                            'assembly_date' => Carbon::createFromFormat('Ymd', $sub['s.assembly_date'])->format('Y-m-d'),
                            'year_mc' => $yearMc,
                            

                            'created_at'=>now(),
                            'updated_at'=>now()
                        ];
                    }
                }
            }
        }
    }
}
