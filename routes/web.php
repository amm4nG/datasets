<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('datasets', function () {
    return view('datasets');
});

Route::get('detail', function () {
    return view('detail');
});



















Route::get('admin/dashboard', function () {
return view('admin.dashboard');
});

Route::get('admin/manage/datasets', function () {
return view('admin.manage-datasets');
});

Route::get('admin/manage/users', function () {
return view('admin.manage-users');
});

Route::get('admin/detail/dataset', function () {
return view('admin.detail-dataset');
});