<?php

/*
|--------------------------------------------------------------------------
| Datatable Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(["auth"])->group(function() {
	Route::namespace("Admin")->name("admin.")->prefix("admin")->middleware(["roles:1"])->group(function() {
		Route::name("admission.")->prefix("admission")->group(function() {
			Route::get("/", "AdmissionController@index")->name("index");
		});
	});
});