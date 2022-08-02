<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProductCustomerController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;

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

Route::get('/', [LandingPageController::class, 'index']);
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/product-customer', [ProductCustomerController::class, 'index']);
Route::get('/product-customer/detail/{id}', [ProductCustomerController::class, 'detail']);
Route::post('/product-customer/generateToken', [ProductCustomerController::class, 'generateToken']);
Route::post('/product-customer/searchToken', [ProductCustomerController::class, 'searchToken']);
Route::post('/product-customer/orderProduct', [ProductCustomerController::class, 'orderProduct']);
Route::post('/product-customer/logout', [ProductCustomerController::class, 'logout']);


// Admin
Route::get('/dashboard', [AdminController::class, 'index'])->middleware('auth');

// kategori
Route::get('/kategori/dataAjax', [KategoriController::class, 'dataAjax']);
Route::resource('/dashboard/kategori', KategoriController::class)->middleware('auth');

// Data marketing
Route::get('/marketing/dataAjax', [MarketingController::class, 'dataAjax']);
Route::resource('/dashboard/marketing', MarketingController::class)->middleware('auth');

// Data product
Route::get('/product/dataAjax', [ProductController::class, 'dataAjax']);
Route::resource('/dashboard/product', ProductController::class)->middleware('auth');
