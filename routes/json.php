<?php

/*
|--------------------------------------------------------------------------
| Json Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::namespace("Landing")->group(function() {
	Route::name("article.")->prefix("article")->group(function() {
		Route::get("/", "ArticleController@index")->name("index");
		Route::get("/latest", "ArticleController@latest")->name("latest");
	});
	Route::name("teacher.")->prefix("teacher")->group(function() {
		Route::get("/latest", "TeacherController@latest")->name("latest");
	});
	Route::name("gallery.")->prefix("gallery")->group(function() {
		Route::get("/latest", "GalleryController@latest")->name("latest");
	});
});

Route::namespace("PublicJson")->group(function() {
	Route::name("school-year.")->prefix("school-year")->group(function() {
		Route::get("/", "SchoolYearController@index")->name("index");
	});
});

Route::middleware(["auth"])->group(function() {
	Route::namespace("Admin")->name("admin.")->prefix("admin")->middleware(["roles:1"])->group(function() {
		Route::name("admission.")->prefix("admission")->group(function() {
			Route::post("/{admission}/approve", "AdmissionController@approve")->name("approve");
			Route::post("/{admission}/unapprove", "AdmissionController@unapprove")->name("unapprove");
		});
		Route::name("income.")->prefix("income")->group(function() {
			Route::get("/summary", "IncomeController@summary")->name("summary");
			Route::get("/summary-monthly", "IncomeController@summaryMonthly")->name("summary-monthly");
		});
		Route::name("expenditure.")->prefix("expenditure")->group(function() {
			Route::get("/summary", "ExpenditureController@summary")->name("summary");
			Route::get("/summary-monthly", "ExpenditureController@summaryMonthly")->name("summary-monthly");
		});
		Route::name("wealth.")->prefix("wealth")->group(function() {
			Route::get("/summary", "WealthController@summary")->name("summary");
			Route::get("/summary-monthly", "WealthController@summaryMonthly")->name("summary-monthly");
		});
	});
});