<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\DealerApi;
use App\Models\MasterUnit;
use App\Models\SyncLog;

abstract class BaseSyncCommand extends Command
{
    /**
     * Ambil semua dealer aktif
     */
    protected function getDealers()
    {
        return DealerApi::where('status', 1)->get();
    }

    /**
     * Ambil master harga
     */
    protected function getMasterPrices()
    {
        return MasterUnit::pluck('price', 'model_name')->all();
    }

    /**
     * Request API Yamaha
     */
    protected function callApi($dealer, $endpoint, array $body = [])
    {
        $url = $endpoint . '?' . http_build_query([
            'dealerCd' => $dealer->dealer_code,
            'accessToken' => $dealer->access_token,
        ]);

        return Http::retry(3,1000)
            ->timeout(60)
            ->acceptJson()
            ->post($url, $body);
    }

    /**
     * Log sukses
     */
    protected function logSuccess($dealerCode, $total)
    {
        $this->info("[{$dealerCode}] {$total} data");
    }

    /**
     * Log warning
     */
    protected function logWarning($dealerCode, $message)
    {
        $this->warn("[{$dealerCode}] {$message}");
    }

    /**
     * Log error
     */
    protected function logError($dealerCode, $message)
    {
        $this->error("[{$dealerCode}] {$message}");
    }

    /**
     * Log Record
     */
    protected function saveLog(
        $command,
        $dealerCode,
        $status,
        $totalData = 0,
        $message = null,
        $startedAt = null,
        $finishedAt = null
    )
    
    {
        SyncLog::create([
            'command' => $command,
            'dealer_code' => $dealerCode,
            'status' => $status,
            'total_data' => $totalData,
            'message' => $message,
            'started_at' => $startedAt,
            'finished_at' => $finishedAt,
        ]);
    }
}