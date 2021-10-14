<?php

use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\Auth\RegisterAdminController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('welcome');
});

Route::name('admin.')->middleware('auth')->group(function () {
	Route::get('/beranda', [DashboardController::class, 'index'])->name('dashboard');
	Route::view('forms', 'forms')->name('forms');
	Route::view('cards', 'cards')->name('cards');
	Route::view('charts', 'charts')->name('charts');
	Route::view('buttons', 'buttons')->name('buttons');
	Route::view('modals', 'modals')->name('modals');
	Route::view('tables', 'tables')->name('tables');
	Route::view('calendar', 'calendar')->name('calendar');
});

Route::name('admin.')->middleware('guest:web')->group(function () {
	Route::get('/daftar', [RegisterAdminController::class, 'create'])->name('register');
	Route::post('/daftar', [RegisterAdminController::class, 'store'])->name('register.store');

	Route::get('/masuk', [LoginAdminController::class, 'create'])->name('login');
	Route::post('/masuk', [LoginAdminController::class, 'store'])->name('login.store');
});
