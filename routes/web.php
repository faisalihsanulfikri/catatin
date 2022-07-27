<?php

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

Route::redirect('/', '/login');
// Route::redirect('/dashboard', '/home');

Route::namespace("Auth")->name("auth.")->middleware(["guest"])->group(function() {
	Route::get("login", "LoginController@login")->name("login");
	Route::post("login", "LoginController@connect")->name("login.connect");
});

Route::middleware(["auth"])->group(function() {
	Route::namespace("Auth")->name("auth.")->group(function() {
		Route::get("logout", "LoginController@logout")->name("logout");
		Route::get("logout-user-not-active", "LoginController@logoutUserNotActive")->name("logout.user.not.active");
		Route::get("password-change", "ProfileController@password")->name("password-change");
		Route::post("password-change-update", "ProfileController@updatePassword")->name("password-change.update");
	});
	Route::namespace("Role")->name("role.")->prefix("role")->group(function() {
		Route::get("/", "RoleController@redirect")->name("redirect");
	});

	Route::namespace("CKEditor")->name("ckeditor.")->prefix("ckeditor")->group(function() {
		Route::get("/", "CKEditorController@index")->name("index");
		Route::post("/upload", "CKEditorController@upload")->name("upload");
	});

	Route::namespace("Admin")->name("admin.")->prefix("admin")->middleware(["roles:1"])->group(function() {
		Route::name("dashboard.")->prefix("dashboard")->group(function() {
			Route::get("/", "DashboardController@index")->name("index");
		});
		Route::name("admission.")->prefix("admission")->group(function() {
			Route::get("/", "AdmissionController@index")->name("index");
			Route::get("/{admission}", "AdmissionController@edit")->name("edit");
		});
	});
});
