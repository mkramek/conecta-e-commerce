<?php

use App\Http\Controllers\MailController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(MailController::class)->group(function () {
    Route::get('/mail/order-created', 'sendOrderCreated');
    Route::get('/mail/order-paid', 'sendOrderPaid');
    Route::get('/mail/order-shipped', 'sendOrderShipped');
    Route::get('/mail/customer-created', 'sendCustomerCreated');
});

Route::get('/products', [ProductsController::class, 'index'])->name('api.products.index');
