<?php

namespace App\Providers;

use ConsoleTVs\Charts\Registrar as Charts;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Charts $charts)
    {
        $charts->register([
            \App\Charts\SaleChart::class,
            \App\Charts\SaleByDealerChart::class,
            \App\Charts\TopProductChart::class,
            \App\Charts\TopStockChart::class,
            \App\Charts\PsiChart::class,
        ]);
    }
}
