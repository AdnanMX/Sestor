<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsC;
use App\Http\Controllers\UsersR;
use App\Http\Controllers\LoginC;
use App\Http\Controllers\LogC;
use App\Http\Controllers\TransactionsC;

// Dashboard
Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('users/pdf', [UsersR::class, 'pdf'])->name('users.pdf')->middleware('userAkses:admin,owner');

//Produk
Route::get('products', [ProductsC::class, 'index'])->name('products.index')->middleware('userAkses:admin,owner');
Route::get('products/create', [ProductsC::class, 'create'])->name('products.create')->middleware('userAkses:admin');
Route::post('products/create', [ProductsC::class, 'store'])->name('products.store')->middleware('userAkses:admin');
Route::get('products/edit/{id}', [ProductsC::class, 'edit'])->name('products.edit')->middleware('userAkses:admin');
Route::put('products/update/{id}', [ProductsC::class, 'update'])->name('products.update')->middleware('userAkses:admin');
Route::delete('products/destroy/{id}', [ProductsC::class, 'destroy'])->name('products.destroy')->middleware('userAkses:admin');
Route::get('products/pdf', [ProductsC::class, 'pdf'])->name('products.pdf')->middleware('userAkses:admin,owner');
// Route::resource('products', ProductsC::class)->middleware('userAkses:admin,owner,kasir');

//Transaksi
Route::get('transactions', [TransactionsC::class, 'index'])->name('transactions.index')->middleware('userAkses:admin,kasir,owner');
Route::get('transactions/create', [TransactionsC::class, 'create'])->name('transactions.create')->middleware('userAkses:kasir');
Route::post('transactions/create', [TransactionsC::class, 'store'])->name('transactions.store')->middleware('userAkses:kasir');
Route::get('transactions/edit/{id}', [TransactionsC::class, 'edit'])->name('transactions.edit')->middleware('userAkses:admin');
Route::put('transactions/update/{id}', [TransactionsC::class, 'update'])->name('transactions.update')->middleware('userAkses:admin');
Route::delete('transactions/destroy/{id}', [TransactionsC::class, 'destroy'])->name('transactions.destroy')->middleware('userAkses:admin');
Route::get('transactions/pdfFilter', [TransactionsC::class, 'pdfFilter'])->name('transactions.pdfFilter')->middleware('userAkses:owner');
Route::get('transactions/cetak/{id}', [TransactionsC::class, 'cetak'])->name('transactions.cetak')->middleware('userAkses:kasir');
Route::get('transactions/detail/{id}', [TransactionsC::class, 'detail'])->name('transactions.detail')->middleware('userAkses:admin,kasir,owner');

//User
Route::resource('users', UsersR::class)->middleware('userAkses:admin');
Route::get('users/changepassword/{id}', [UsersR::class, 'changepassword'])->name('users.changepassword')->middleware('userAkses:admin');
Route::put('users/change/{id}', [UsersR::class, 'change'])->name('users.change')->middleware('userAkses:admin');
Route::delete('users/destroy/{id}', [UsersR::class, 'destroy'])->name('users.destroy')->middleware('userAkses:admin');

//Log
Route::resource('log', LogC::class)->middleware('userAkses:owner');

//Login
Route::get('logout', [LoginC::class, 'logout'])->name('logout');
Route::post('login', [LoginC::class, 'login_action'])->name('login.action');
Route::get('login', [LoginC::class, 'login'])->name('login');
