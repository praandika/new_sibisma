<?php

use App\Http\Controllers\SparepartController;
use App\Http\Controllers\UnitController;
use Illuminate\Http\Request;
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
Route::get('/zhiscat', [UnitController::class, 'sendCategory']);
Route::get('/zhisparts', [SparepartController::class, 'sendParts']);
Route::get('/zhisparts/{cat}', [SparepartController::class, 'sendPartsCat']);
Route::get('/zhispartcat', [SparepartController::class, 'sendPartsCategory']);