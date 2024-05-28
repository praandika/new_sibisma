<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\SpecificationController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/zhismodel', [UnitController::class, 'sendModel']);
Route::get('/zhismodel/{cat}', [UnitController::class, 'sendModelCat']);
Route::get('/zhismodeldetail/{model}', [UnitController::class, 'sendModelDetail']);
Route::get('/zhiscat', [UnitController::class, 'sendCategory']);
Route::post('/zhissearch', [UnitController::class, 'sendSearch']);
Route::get('/zhisparts', [SparepartController::class, 'sendParts']);
Route::get('/zhisparts/{cat}', [SparepartController::class, 'sendPartsCat']);
Route::get('/zhispartcat', [SparepartController::class, 'sendPartsCategory']);
Route::post('/zhissearchspart', [SparepartController::class, 'sendSearchSpart']);
Route::get('/zhiscolor/{model}', [UnitController::class, 'sendColor']);
Route::get('/zhisimage/{model}', [UnitController::class, 'sendImage']);
Route::get('/zhisspecmesin/{model}', [SpecificationController::class, 'sendSpecMesin']);
Route::get('/zhisspecrangka/{model}', [SpecificationController::class, 'sendSpecRangka']);
Route::get('/zhisspecdimensi/{model}', [SpecificationController::class, 'sendSpecDimensi']);
Route::get('/zhisspeckelistrikan/{model}', [SpecificationController::class, 'sendSpecKelistrikan']);
Route::get('/zhiscontact', [DealerController::class, 'sendDealer']);
Route::get('/zhisjob', [JobVacancyController::class, 'sendJob']);
Route::get('/zhisjob/{cat}', [JobVacancyController::class, 'sendJobCat']);
Route::post('/zhissearchjob', [JobVacancyController::class, 'sendSearchJob']);
Route::get('/zhisabout', [AboutController::class, 'sendAbout']);
Route::get('/zhisbanner', [BannerController::class, 'sendBanner']);
Route::get('/zhisavailable/{model}', [StockController::class, 'sendAvailable']);
Route::get('/zhisavailablecolor/{model}', [StockController::class, 'sendAvailableColor']);