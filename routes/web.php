<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('welcome');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
	Route::view('dashboard', 'dashboard')->name('dashboard');
	Route::view('forms', 'forms')->name('forms');
	Route::view('cards', 'cards')->name('cards');
	Route::view('charts', 'charts')->name('charts');
	Route::view('buttons', 'buttons')->name('buttons');
	Route::view('modals', 'modals')->name('modals');
	Route::view('tables', 'tables')->name('tables');
	Route::view('calendar', 'calendar')->name('calendar');
});
