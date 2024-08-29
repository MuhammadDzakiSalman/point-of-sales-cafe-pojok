<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('order');
});

// Route::get('/kitchen', [KitchenController::class, 'index'])->name('kitchen.index');
// Route::post('/kitchen/update-status', [KitchenController::class, 'updateStatus'])->name('kitchen.updateStatus');
Route::get('/kitchen', [KitchenController::class, 'index'])->name('kitchen.index');
Route::get('/kitchen/get-transactions', [KitchenController::class, 'getTransactions'])->name('kitchen.getTransactions');
Route::post('/kitchen/update-status', [KitchenController::class, 'updateStatus'])->name('kitchen.updateStatus');

Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
Route::patch('/kasir/processTransaction/{transaction}', [KasirController::class, 'processTransaction'])->name('kasir.processTransaction');
Route::patch('/kasir/confirmedTransaction/{transaction}', [KasirController::class, 'confirmedTransaction'])->name('kasir.confirmedTransaction');
Route::get('/kasir/get-transactions', [KasirController::class, 'getTransactions'])->name('kasir.getTransactions');

Route::resource('meja', TableController::class);

Route::resource('admin/menu', MenuController::class);
Route::resource('admin/station', StationController::class);
Route::get('admin/penjualan', [PenjualanController::class, 'index']);
Route::get('admin/penjualan/download', [PenjualanController::class, 'downloadPDF']);
Route::get('/admin/fcfs', [AdminController::class, 'index']);
Route::get('admin/fcfs/download-pdf', [AdminController::class, 'downloadPdf']);

Route::get('/', [TransactionController::class, 'index']);
Route::post('/order', [TransactionController::class, 'store'])->name('order.store');
Route::get('/transaction/{id}/bill', [TransactionController::class, 'generateBill'])->name('transaction.bill');
Route::get('/transaction/{id}/details', [TransactionController::class, 'show'])->name('transaction.details');
Route::get('/get-menus', [TransactionController::class, 'getMenus'])->name('get-menus');
Route::get('/get-tables', [TransactionController::class, 'getTables'])->name('get-tables');