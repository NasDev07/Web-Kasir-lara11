<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Beranda;
use App\Livewire\User;
use App\Livewire\Laporan;
use App\Livewire\Produk;
use App\Livewire\Transaksi;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', Beranda::class)->name('home');
    Route::get('/user', User::class)->name('user');
    Route::get('/laporan', Laporan::class)->name('laporan');
    Route::get('/produk', Produk::class)->name('produk');
    Route::get('/transaksi', Transaksi::class)->name('transaksi');
});
