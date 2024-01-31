<?php

use App\Http\Controllers\Admin\ManageDatasetsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContributeDatasetController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\MyDatasetController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('datasets', [DatasetController::class, 'index']);

Route::get('detail', function () {
    return view('detail');
});

Route::get('login', [AuthController::class, 'index'])
    ->name('login')
    ->middleware('guest');
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::post('login/validation', [AuthController::class, 'validation']);

Route::get('register', [RegistrationController::class, 'index'])->middleware('guest');
Route::post('register/user', [RegistrationController::class, 'store']);

Route::get('donation', [ContributeDatasetController::class, 'index'])->middleware('auth');
Route::post('more/info', [ContributeDatasetController::class, 'moreInfo'])->middleware('auth');
Route::post('donation/store', [ContributeDatasetController::class, 'store'])->middleware('auth');
Route::get('my/dataset', [MyDatasetController::class, 'index'])->middleware('auth');
Route::get('my/dataset/{id}', [MyDatasetController::class, 'show'])->middleware('auth');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('admin/manage/datasets', [ManageDatasetsController::class, 'index']);
    Route::get('admin/detail/dataset/{id}', [ManageDatasetsController::class, 'show']);
    Route::put('admin/validate/dataset/{id}', [ManageDatasetsController::class, 'update']);

    Route::get('admin/manage/users', [UserController::class, 'index']);
});

Route::get('forgot', function () {
    return view('forgot');
});

Route::get('donation/paper', function () {
    return view('donation-paper');
});

Route::get('contact/information', function () {
    return view('contact-information');
});
Route::get('about', function () {
    return view('about');
});
