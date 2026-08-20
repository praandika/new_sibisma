<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\ActtypeController;
use App\Http\Controllers\AllocationController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ContactListHelperController;
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
use App\Http\Controllers\DeliveryOrderController;
use App\Http\Controllers\KwitansiController;
use App\Http\Controllers\StockHistoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SimpleSaleController;
use App\Http\Controllers\SimpleOutController;
use App\Http\Controllers\SpkController;
use App\Http\Controllers\STUController;
use App\Http\Controllers\IDCardController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\SpecificationController;
use App\Http\Controllers\SpkEntryController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\DpackController;
use App\Models\SpkEntry;

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
Route::middleware(['auth:sanctum', 'verified'])->get('/user/editpass/{id}', [UserController::class, 'editPass'])->name('user.editpass');
Route::middleware(['auth:sanctum', 'verified'])->post('/user/updatepass', [UserController::class, 'updatePass'])->name('user.updatepass');
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

// ID CARD
Route::middleware(['auth:sanctum', 'verified'])->get('/idcard', [IDCardController::class, 'index'])->name('idcard.index');
Route::middleware(['auth:sanctum', 'verified'])->get('/idcard/{dealer}', [IDCardController::class, 'data'])->name('idcard.data');
Route::middleware(['auth:sanctum', 'verified'])->get('/idcard/{id}/show', [IDCardController::class, 'show'])->name('idcard.show');
Route::middleware(['auth:sanctum', 'verified'])->get('/idcard/change/{id}/{status}', [IDCardController::class, 'changeStatusIdCard'])->name('idcard.update-status');
// END ID CARD

// COLOR
Route::middleware(['auth:sanctum', 'verified'])->resource('color', ColorController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/color/delete/{id}', [ColorController::class, 'delete'])->name('color.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/color/deleteall', [ColorController::class, 'deleteall'])->name('color.deleteall');
// END COLOR

// UNIT
Route::middleware(['auth:sanctum', 'verified'])->resource('unit', UnitController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/unit/delete/{id}', [UnitController::class, 'delete'])->name('unit.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/unit/deleteall', [UnitController::class, 'deleteall'])->name('unit.deleteall');
Route::middleware(['auth:sanctum', 'verified'])->get('/unitaddall', [UnitController::class, 'addalltostock'])->name('unit.add-all');
Route::middleware(['auth:sanctum', 'verified'])->post('/unitaddall/store', [UnitController::class, 'addalltostockStore'])->name('unit.add-all-unit-store');
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
Route::middleware(['auth:sanctum', 'verified'])->get('/sale-view', [SimpleSaleController::class, 'index'])->name('sale.simple-index');
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

Route::middleware(['auth:sanctum', 'verified'])->get('/report/{param}', [ReportController::class, 'reportPrint'])->name('report.print');

Route::middleware(['auth:sanctum', 'verified'])->get('/reportsearch/{reportid?}', [SearchController::class, 'reportSearch'])->name('report.search-id');

Route::middleware(['auth:sanctum', 'verified'])->get('/do-kwitansi-leasing/{date?}', [ReportController::class, 'doKwitansiLeasing'])->name('do-kwitansi.leasing');

Route::middleware(['auth:sanctum', 'verified'])->get('/allocation/report/{start?}/{end?}', [ReportController::class, 'reportMultipleSheet'])->name('report.allocation');

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

// STU
Route::middleware(['auth:sanctum', 'verified'])->resource('stu', STUController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/stu/delete/{id}', [STUController::class, 'delete'])->name('stu.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/stu/deleteall', [STUController::class, 'deleteall'])->name('stu.deleteall');
Route::middleware(['auth:sanctum', 'verified'])->get('/stu-real-ach', [STUController::class, 'achievement'])->name('info.stu-real-ach');
// END STU

// SPK
Route::middleware(['auth:sanctum', 'verified'])->resource('spk', SpkController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/spk/get/{id?}', [SpkController::class, 'get'])->name('spk.get');
Route::middleware(['auth:sanctum', 'verified'])->get('/spk/delete/{id}', [SpkController::class, 'delete'])->name('spk.delete');
Route::middleware(['auth:sanctum', 'verified'])->get('/spk-history/{date?}', [SpkController::class, 'history'])->name('spk.history');

Route::middleware(['auth:sanctum', 'verified'])->get('/spk-salesman', [SpkController::class, 'spkSalesman'])->name('spk.salesman');
Route::middleware(['auth:sanctum', 'verified'])->get('/spk-historysalesman/{date?}', [SpkController::class, 'historySalesman'])->name('spk.historysalesman');

// Filter SPK
Route::middleware(['auth:sanctum', 'verified'])->get('/spk-filter/{param?}', [SpkController::class, 'filter'])->name('spk.filter');
// END SPK

// DO
Route::middleware(['auth:sanctum', 'verified'])->get('/delivery-order/get/{id}', [DeliveryOrderController::class, 'get'])->name('delivery-order.get');
Route::middleware(['auth:sanctum', 'verified'])->get('/delivery-order-history/{date?}', [DeliveryOrderController::class, 'history'])->name('delivery-order.history');
// END DO

// KWITANSI
Route::middleware(['auth:sanctum', 'verified'])->resource('kwitansi', KwitansiController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/kwitansi/get/{id}', [KwitansiController::class, 'get'])->name('kwitansi.get');
Route::middleware(['auth:sanctum', 'verified'])->get('/kwitansi-history/{date?}', [KwitansiController::class, 'history'])->name('kwitansi.history');
// END KWITANSI

// PRINT PDF
Route::get('print-pdf-tr', function () {
    return view('export.pdf-tr');
})->name('printtrpdf');

Route::get('print-pdf-tp', function () {
    return view('export.pdf-tp');
})->name('printtppdf');

Route::middleware(['auth:sanctum', 'verified'])->get('spk-print/{spk_no}', [SpkController::class, 'printPDF'])->name('spk.print');
Route::middleware(['auth:sanctum', 'verified'])->get('spk-download/{spk_no}', [SpkController::class, 'downloadPDF'])->name('spk.download');
Route::middleware(['auth:sanctum', 'verified'])->get('spk-ktp-print/{spk_no}', [SpkController::class, 'ktpPDF'])->name('spk.ktp-print');

Route::middleware(['auth:sanctum', 'verified'])->get('do-print/{spk_no}', [DeliveryOrderController::class, 'printPDF'])->name('do.print');
Route::middleware(['auth:sanctum', 'verified'])->get('do-download/{spk_no}', [DeliveryOrderController::class, 'downloadPDF'])->name('do.download');

Route::middleware(['auth:sanctum', 'verified'])->get('kwitansi-print/{id}', [KwitansiController::class, 'printPDF'])->name('kwitansi.print');
Route::middleware(['auth:sanctum', 'verified'])->get('kwitansi-download/{id}', [KwitansiController::class, 'downloadPDF'])->name('kwitansi.download');

Route::middleware(['auth:sanctum', 'verified'])->get('kwitansi-dp-nodiscount-print/{id}', [LeasingController::class, 'printKwitansiDpPDF'])->name('kwitansi-dp-nodiscount.print');
Route::middleware(['auth:sanctum', 'verified'])->get('kwitansi-pelunasan-print/{id}', [LeasingController::class, 'printKwitansiPelunasan'])->name('kwitansi-pelunasan.print');
// END PRINT PDF

// SPAREPART
Route::middleware(['auth:sanctum', 'verified'])->resource('sparepart', SparepartController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/sparepart/delete/{id}', [SparepartController::class, 'delete'])->name('sparepart.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/sparepart/deleteall', [SparepartController::class, 'deleteall'])->name('sparepart.deleteall');
// END SPAREPART

// SPECIFICATION
Route::middleware(['auth:sanctum', 'verified'])->resource('specification', SpecificationController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/specification/delete/{id}', [SpecificationController::class, 'delete'])->name('specification.delete');
// END SPECIFICATION

// JOB VACANCY
Route::middleware(['auth:sanctum', 'verified'])->resource('jobvacancy', JobVacancyController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/jobvacancy/delete/{id}', [JobVacancyController::class, 'delete'])->name('jobvacancy.delete');
// END JOB VACANCY

// ABOUT US
Route::middleware(['auth:sanctum', 'verified'])->resource('about', AboutController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/about/delete/{id}', [AboutController::class, 'delete'])->name('about.delete');
// END ABOUT US

// BANNER
Route::middleware(['auth:sanctum', 'verified'])->resource('banner', BannerController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/banner/delete/{id}', [BannerController::class, 'delete'])->name('banner.delete');
Route::middleware(['auth:sanctum', 'verified'])->get('/banner/change/{id}/{status}', [BannerController::class, 'changeStatusBanner'])->name('banner.update-status');
// END BANNER

// ALLOCATION
Route::middleware(['auth:sanctum', 'verified'])->resource('allocation', AllocationController::class);
Route::middleware(['auth:sanctum', 'verified'])->post('/allocation/import', [AllocationController::class, 'importExcel'])->name('allocation.import');
Route::middleware(['auth:sanctum', 'verified'])->get('/allocation/{date}/{dealer}', [AllocationController::class, 'detail'])->name('allocation.detail');
Route::middleware(['auth:sanctum', 'verified'])->get('/allocation/delete/{id}/{date}/{dealer}', [AllocationController::class, 'delete'])->name('allocation.delete');
Route::middleware(['auth:sanctum', 'verified'])->get('/allocation-search/{param?}', [AllocationController::class, 'search'])->name('allocation.search');
Route::middleware(['auth:sanctum', 'verified'])->get('/allocation-out', [AllocationController::class, 'out'])->name('allocation.out');
Route::middleware(['auth:sanctum', 'verified'])->post('/allocation/out', [AllocationController::class, 'storeOut'])->name('allocation.storeout');
Route::middleware(['auth:sanctum', 'verified'])->get('/allocation-out/{status}/{id}', [AllocationController::class, 'deleteStoreOut'])->name('allocation.deletestoreout');
Route::middleware(['auth:sanctum', 'verified'])->get('/allocation-report/{param?}', [AllocationController::class, 'report'])->name('allocation.report');
// END ALLOCATION

// ALLOCATION MODE
Route::middleware(['auth:sanctum', 'verified'])->post('update-allocation-mode/{id}/{mode}', [UserController::class, 'updateAllocationMode']);
// END ALLOCATION MODE

// CRM
Route::middleware(['auth:sanctum', 'verified'])->resource('contactlist', ContactListHelperController::class);
Route::middleware(['auth:sanctum', 'verified'])->post('/contactlist/import', [ContactListHelperController::class, 'importExcel'])->name('contactlist.import');
Route::middleware(['auth:sanctum', 'verified'])->get('/contactlist-search/{param?}', [ContactListHelperController::class, 'search'])->name('contactlist.search');
Route::middleware(['auth:sanctum', 'verified'])->get('/contactlist-report/{param?}', [ContactListHelperController::class, 'report'])->name('contactlist.report');
// END CRM

// WAREHOUSE
Route::middleware(['auth:sanctum', 'verified'])->resource('warehouse', WarehouseController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/warehouse/entry/{code}/{model}/{color}/{year}', [WarehouseController::class, 'entry'])->name('warehouse.entry');
Route::middleware(['auth:sanctum', 'verified'])->get('/warehouse/detail/{code}', [WarehouseController::class, 'detail'])->name('warehouse.detail');
Route::middleware(['auth:sanctum', 'verified'])->post('/warehouse/move/{id}', [WarehouseController::class, 'move'])->name('warehouse.move');
Route::middleware(['auth:sanctum', 'verified'])->get('/warehouse/sell/{id}', [WarehouseController::class, 'sell'])->name('warehouse.sell');
Route::middleware(['auth:sanctum', 'verified'])->get('/warehouse/generate/{dealer}', [WarehouseController::class, 'generate'])->name('warehouse.generate');
Route::middleware(['auth:sanctum', 'verified'])->post('/warehouse/generating', [WarehouseController::class, 'generating'])->name('warehouse.generating');

Route::middleware(['auth:sanctum', 'verified'])->get('/warehousename', [WarehouseController::class, 'name'])->name('warehousename.index');
Route::middleware(['auth:sanctum', 'verified'])->post('/warehousename/store', [WarehouseController::class, 'wStore'])->name('warehousename.store');
Route::middleware(['auth:sanctum', 'verified'])->get('/warehousename/edit/{id}', [WarehouseController::class, 'wEdit'])->name('warehousename.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/warehousename/update/{id}', [WarehouseController::class, 'wUpdate'])->name('warehousename.update');
Route::middleware(['auth:sanctum', 'verified'])->post('/warehousename/delete/{id}', [WarehouseController::class, 'wDelete'])->name('warehousename.delete');
// END WAREHOUSE

// PROMOTION - ACTIVITIES & PROPOSAL
Route::middleware(['auth:sanctum', 'verified'])->resource('promotion', PromotionController::class);

Route::middleware(['auth:sanctum', 'verified'])->resource('activities', ActivitiesController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/activities/delete/{id}', [ActivitiesController::class, 'delete'])->name('activities.delete');
Route::middleware(['auth:sanctum', 'verified'])->get('/activities/detail-add/{id}', [ActivitiesController::class, 'detailAdd'])->name('activities.detail-add');
Route::middleware(['auth:sanctum', 'verified'])->post('/activities/detail-store/{id}', [ActivitiesController::class, 'detailStore'])->name('activities.detail-store');

Route::middleware(['auth:sanctum', 'verified'])->resource('proposal', ProposalController::class); 
// END PROMOTION

// ACT TYPE
Route::middleware(['auth:sanctum', 'verified'])->resource('acttype', ActtypeController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/acttype/delete/{id}', [ActtypeController::class, 'delete'])->name('acttype.delete');
// END ACT TYPE

//=============================
// NEW SIBISMA ROUTES VERSION 4
//=============================

// STOCK ON-HAND MENU
Route::middleware(['auth:sanctum', 'verified'])->get('/stock-onhand', [StockController::class, 'showStockOnhand'])->name('stock.onhand');

// STOCK MUTATION MENU
Route::middleware(['auth:sanctum', 'verified'])->get('/stock-mutation', [StockController::class, 'showStockMutation'])->name('stock.mutation');

// STOCK REQUESTED MENU
Route::middleware(['auth:sanctum', 'verified'])->get('/stock-requested', [StockController::class, 'showStockRequested'])->name('stock.requested');

// STOCK SOLD MENU
Route::middleware(['auth:sanctum', 'verified'])->get('/stock-sold', [StockController::class, 'showStockSold'])->name('stock.sold');

// CHANGE STOCK ON REQUEST STOCK - GO TO EDIT FORM
Route::middleware(['auth:sanctum', 'verified'])->get('/spk/change-stock/{spkno}/{dealer_code}/{model}/{color}', [SpkController::class, 'changeStock'])->name('spk.change-stock');

// REJECT REQUEST STOCK - PROSES UPDATE STATUS SPK & POINT CODE
Route::middleware(['auth:sanctum', 'verified'])->get('/spk/reject/{spk_no}/{dealer_code}', [SpkController::class, 'rejectStock'])->name('spk.reject-stock');

// PROSES UPDATE REQUEST STOCK
Route::middleware(['auth:sanctum', 'verified'])->post('/spk/process-change-stock/{spk_no}/{dealer_code}', [SpkController::class, 'processChangeStock'])->name('spk.process-change-stock');

// PROSES STORE AND UPDATE PROSES JUAL DATA SPK
Route::middleware(['auth:sanctum', 'verified'])->post('/spk/process-sale/{spk_no}', [SaleController::class, 'processSale'])->name('spk.process-sale');

// GO TO SALE SHOW --> SALE DETAIL --> CREATE DO
Route::middleware(['auth:sanctum', 'verified'])->get('/sale/show/{spk_no}', [SaleController::class, 'saleShow'])->name('sale.sale-show');

// PROSES STORE AND UPDATE PROSES DELIVERY ORDER
Route::middleware(['auth:sanctum', 'verified'])->post('/do/process-do/{spk_no}', [SaleDeliveryController::class, 'processDo'])->name('do.process-do');

// HISTORY CREDIT SPK
Route::middleware(['auth:sanctum', 'verified'])->get('/spk/historycredit/{spk_no}', [SpkController::class, 'historyCredit'])->name('spk.historycredit');

// PROSES UPDATE STATUS CREDIT ON HISTORY CREDIT SPK
Route::middleware(['auth:sanctum', 'verified'])->post('/spk/credit-status/{spk_no}', [SpkController::class, 'updateCreditStatus'])->name('spk.credit-status-update');

// PROSES UBAH LEASING ON HISTORY CREDIT SPK
Route::middleware(['auth:sanctum', 'verified'])->post('/spk/change-leasing/{spk_no}', [SpkController::class, 'changeLeasing'])->name('spk.change-leasing');

// HALAMAN DATA DELIVERY ORDER
Route::middleware(['auth:sanctum', 'verified'])->resource('delivery-order', DeliveryOrderController::class);

// HALAMAN DATA SALE
Route::middleware(['auth:sanctum', 'verified'])->resource('sale', SaleController::class);


// ===============================//
// ************ AJAX ************ //
// ===============================//

// MODAL PROSPECT AJAX
Route::middleware(['auth:sanctum', 'verified'])->get('/prospect-search', [SpkController::class, 'prospectSearch'])->name('spk.prospect-search');

// CEK STOCK AJAX
Route::middleware(['auth:sanctum', 'verified'])->get('/spk-checkstock', [SpkController::class, 'checkStock'])->name('spk.checkstock');

// REQUEST STOCK AJAX
Route::middleware(['auth:sanctum', 'verified'])->get('/spk-requeststock', [SpkController::class, 'requestStock'])->name('spk.requeststock');


// DPACK CONNECTION AJAX
Route::middleware(['auth:sanctum', 'verified'])->get('/dpack', [DpackController::class, 'index'])->name('dpack.index');
Route::middleware(['auth:sanctum', 'verified'])->get('/sync-log', [DpackController::class, 'log'])->name('dpack.log');

// MANUAL SYNC PROSPECT DPACK AJAX
Route::middleware(['auth:sanctum', 'verified'])->post('/manual-sync/prospect', [DpackController::class, 'manualSyncProspect'])->name('dpack.manual-prospect');

// MANUAL SYNC STOCK MANIFEST DPACK AJAX
Route::middleware(['auth:sanctum', 'verified'])->post('/manual-sync/manifest', [DpackController::class, 'manualSyncManifest'])->name('dpack.manual-manifest');

// CEK PRICE AJAX
Route::middleware(['auth:sanctum', 'verified'])->get('/spk-checkprice', [SpkController::class, 'checkPrice'])->name('spk.checkprice');

// SPK DATA AJAX
Route::middleware(['auth:sanctum', 'verified'])->get('/spk-data', [SpkController::class, 'spkData'])->name('spk.data');

// DATA STOCK AJAX
Route::middleware(['auth:sanctum', 'verified'])->get('/spk-datastock', [SpkController::class, 'dataStock'])->name('spk.datastock');

// DATA STOCK REQUEST AJAX - ON CHANGE STOCK WHEN APPROVE REQUEST STOCK
Route::middleware(['auth:sanctum', 'verified'])->get('/spk-datastockrequest', [SpkController::class, 'dataStockRequest'])->name('spk.datastockrequest');

// LIST REQUEST STOCK AJAX - ON DASHBOARD
Route::middleware(['auth:sanctum', 'verified'])->get('/list-request-stock', [DashboardController::class, 'listRequestStock'])->name('listrequeststock');

// LIST MUTATION STOCK AJAX - ON DASHBOARD
Route::middleware(['auth:sanctum', 'verified'])->get('/mutation-request-stock', [DashboardController::class, 'mutationRequestStock'])->name('mutationrequeststock');

// DATA STOCK ONHAND AJAX
Route::middleware(['auth:sanctum', 'verified'])->get('/stock-onhand-ajax', [StockController::class, 'dataStockOnHand'])->name('stock.onhand-ajax');

// DATA STOCK MUTATION AJAX
Route::middleware(['auth:sanctum', 'verified'])->get('/stock-mutation-ajax', [StockController::class, 'dataStockMutation'])->name('stock.mutation-ajax');

// DATA STOCK REQUESTED AJAX
Route::middleware(['auth:sanctum', 'verified'])->get('/stock-requested-ajax', [StockController::class, 'dataStockRequested'])->name('stock.requested-ajax');

// DATA STOCK SOLD AJAX
Route::middleware(['auth:sanctum', 'verified'])->get('/stock-sold-ajax', [StockController::class, 'dataStockSold'])->name('stock.sold-ajax');

// DATA DELIVERY ORDER AJAX
Route::middleware(['auth:sanctum', 'verified'])->get('/do-data-ajax', [DeliveryOrderController::class, 'doData'])->name('do.data-ajax');

// DATA SALE AJAX
Route::middleware(['auth:sanctum', 'verified'])->get('/sale-data-ajax', [SaleController::class, 'saleData'])->name('sale.data-ajax');