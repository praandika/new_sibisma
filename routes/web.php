<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\ManpowerController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\LeasingController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\OutController;
use App\Http\Controllers\OpnameController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaleDeliveryController;
use App\Http\Controllers\BranchDeliveryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StockHistoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SimpleSaleController;
use App\Http\Controllers\SimpleOutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// USER
Route::middleware(['auth:sanctum', 'verified'])->resource('user', UserController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/user/deleteall', [UserController::class, 'deleteall'])->name('user.deleteall');
// END USER

// DEALER
Route::middleware(['auth:sanctum', 'verified'])->resource('dealer', DealerController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/dealer/delete/{id}', [DealerController::class, 'delete'])->name('dealer.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/dealer/deleteall', [DealerController::class, 'deleteall'])->name('dealer.deleteall');
// END DEALER

// MANPOWER
Route::middleware(['auth:sanctum', 'verified'])->resource('manpower', ManpowerController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/manpower/delete/{id}', [ManpowerController::class, 'delete'])->name('manpower.delete');
// END MANPOWER

// COLOR
Route::middleware(['auth:sanctum', 'verified'])->resource('color', ColorController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/color/delete/{id}', [ColorController::class, 'delete'])->name('color.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/color/deleteall', [ColorController::class, 'deleteall'])->name('color.deleteall');
// END COLOR

// UNIT
Route::middleware(['auth:sanctum', 'verified'])->resource('unit', UnitController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/unit/delete/{id}', [UnitController::class, 'delete'])->name('unit.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/unit/deleteall', [UnitController::class, 'deleteall'])->name('unit.deleteall');
// END UNIT

// LEASING
Route::middleware(['auth:sanctum', 'verified'])->resource('leasing', LeasingController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/leasing/delete/{id}', [LeasingController::class, 'delete'])->name('leasing.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/leasing/deleteall', [LeasingController::class, 'deleteall'])->name('leasing.deleteall');
// END LEASING

// STOCK
Route::middleware(['auth:sanctum', 'verified'])->resource('stock', StockController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/stock/delete/{id}', [StockController::class, 'delete'])->name('stock.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/stock/deleteall', [StockController::class, 'deleteall'])->name('stock.deleteall');
// END STOCK

// SALE
Route::middleware(['auth:sanctum', 'verified'])->resource('sale', SaleController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/sale/delete/{id}', [SaleController::class, 'delete'])->name('sale.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/sale/deleteall', [SaleController::class, 'deleteall'])->name('sale.deleteall');
Route::middleware(['auth:sanctum', 'verified'])->get('/sale-history/{date?}', [SaleController::class, 'history'])->name('sale.history');
Route::middleware(['auth:sanctum', 'verified'])->get('/sale-ach/{param}', [SaleController::class, 'achievment'])->name('info.sale-ach');
Route::middleware(['auth:sanctum', 'verified'])->post('/sale-simple', [SimpleSaleController::class, 'store'])->name('sale.simple-store');
// END SALE

// ENTRY
Route::middleware(['auth:sanctum', 'verified'])->resource('entry', EntryController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/entry/delete/{id}', [EntryController::class, 'delete'])->name('entry.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/entry/deleteall', [EntryController::class, 'deleteall'])->name('entry.deleteall');
Route::middleware(['auth:sanctum', 'verified'])->get('/entry-history/{date?}', [EntryController::class, 'history'])->name('entry.history');
Route::middleware(['auth:sanctum', 'verified'])->get('/entry-ach/{param}', [EntryController::class, 'achievment'])->name('info.entry-ach');
// END ENTRY

// OUT
Route::middleware(['auth:sanctum', 'verified'])->resource('out', OutController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/out/delete/{id}', [OutController::class, 'delete'])->name('out.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/out/deleteall', [OutController::class, 'deleteall'])->name('out.deleteall');
Route::middleware(['auth:sanctum', 'verified'])->get('/out-history/{date?}', [OutController::class, 'history'])->name('out.history');
Route::middleware(['auth:sanctum', 'verified'])->get('/out-ach/{param}', [OutController::class, 'achievment'])->name('info.out-ach');
Route::middleware(['auth:sanctum', 'verified'])->post('/out-simple', [SimpleOutController::class, 'store'])->name('out.simple-store');
// END OUT

// HISTORY
Route::middleware(['auth:sanctum', 'verified'])->get('stock-ratio', [StockController::class, 'ratio'])->name('info.stock-ratio');
// END HISTORY

// OPNAME
Route::middleware(['auth:sanctum', 'verified'])->resource('opname', OpnameController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/opname-history/{date?}', [OpnameController::class, 'history'])->name('opname.history');
// END OPNAME

// REPORT
Route::middleware(['auth:sanctum', 'verified'])->get('/report/stock-history/{date?}', [ReportController::class, 'stockHistory'])->name('report.stock-history');
Route::middleware(['auth:sanctum', 'verified'])->get('/report/send-report/{date?}', [ReportController::class, 'sendReport'])->name('report.send-report');
Route::middleware(['auth:sanctum', 'verified'])->get('/report/adjust/', [ReportController::class, 'adjustReport'])->name('report.adjust');
Route::middleware(['auth:sanctum', 'verified'])->post('/report-adjust', [ReportController::class, 'adjustReportStore'])->name('report.adjust-store');
Route::middleware(['auth:sanctum', 'verified'])->get('/report-unit', [ReportController::class, 'unitReport'])->name('report.unit');
// ROUTE SEND REPORT IF DEALER CODE != GROUP
Route::middleware(['auth:sanctum', 'verified'])->get('/report/{dealer}/{date}', [ReportController::class, 'sendReportGroup'])->name('report.send-group');
// END
Route::middleware(['auth:sanctum', 'verified'])->get('/report/change/{id}/{status}', [ReportController::class, 'changeStatusStockHistory'])->name('report.update-status');
Route::middleware(['auth:sanctum', 'verified'])->get('/report/{param}/{start?}/{end?}', [ReportController::class, 'reportPrint'])->name('report.print');
Route::middleware(['auth:sanctum', 'verified'])->get('/report/search/{reportid?}', [ReportController::class, 'reportSearch'])->name('report.search-id');
// END REPORT

// STOCK HISTORY
Route::middleware(['auth:sanctum', 'verified'])->resource('stock-history', StockHistoryController::class);
// END

// LOG
Route::middleware(['auth:sanctum', 'verified'])->get('/log/{date?}', [LogController::class, 'log'])->name('log');
Route::middleware(['auth:sanctum', 'verified'])->post('/log/deleteall', [LogController::class, 'deleteall'])->name('log.deleteall');
// END LOG

// DOKUMEN
Route::middleware(['auth:sanctum', 'verified'])->resource('document', DokumenController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/document-history/{date?}', [DokumenController::class, 'history'])->name('document.history');
// END DOKUMEN

// SALE DELIVERY
Route::middleware(['auth:sanctum', 'verified'])->resource('sale-delivery', SaleDeliveryController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/sale-delivery/delete/{id}', [SaleDeliveryController::class, 'delete'])->name('sale-delivery.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/sale-delivery/deleteall', [SaleDeliveryController::class, 'deleteall'])->name('sale-delivery.deleteall');
Route::middleware(['auth:sanctum', 'verified'])->get('/sale-delivery-history/{date?}', [SaleDeliveryController::class, 'history'])->name('sale-delivery.history');
// END SALE DELIVERY

// BRANCH DELIVERY
Route::middleware(['auth:sanctum', 'verified'])->resource('branch-delivery', BranchDeliveryController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/branch-delivery/delete/{id}', [BranchDeliveryController::class, 'delete'])->name('branch-delivery.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/branch-delivery/deleteall', [BranchDeliveryController::class, 'deleteall'])->name('branch-delivery.deleteall');
Route::middleware(['auth:sanctum', 'verified'])->get('/branch-delivery-history/{date?}', [BranchDeliveryController::class, 'history'])->name('branch-delivery.history');
// END BRANCH DELIVERY

// USER
Route::middleware(['auth:sanctum', 'verified'])->resource('user', UserController::class);
Route::middleware(['auth:sanctum', 'verified'])->post('/user/deleteall', [UserController::class, 'deleteall'])->name('user.deleteall');
Route::middleware(['auth:sanctum', 'verified'])->get('/user/change/{id}/{status}', [UserController::class, 'changeStatus'])->name('user.update-status');
// END USER

// SEARCH
Route::middleware(['auth:sanctum', 'verified'])->get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/search/{image}', [SearchController::class, 'searchImage'])->name('search.image');
// END SEARCH

// CRUD MODE
Route::middleware(['auth:sanctum', 'verified'])->post('update-crud/{id}/{crud}', [UserController::class, 'updateCrud']);
// END CRUD MODE

// SIMULASI KREDIT
Route::get('/simulasi-kredit', [DashboardController::class, 'simulasi'])->name('simulasi');
// END SIMULASI KREDIT

// PRINT PDF
Route::get('print-pdf-tr', function () {
    return view('export.pdf-tr');
})->name('printtrpdf');

Route::get('print-pdf-tp', function () {
    return view('export.pdf-tp');
})->name('printtppdf');
// END PRINT PDF