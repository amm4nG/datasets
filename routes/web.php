<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManageDatasetsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContributeDatasetController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\LoginGithubController;
use App\Http\Controllers\LoginGoogleController;
use App\Http\Controllers\MyDatasetController;
use App\Http\Controllers\RegistrationController;
use App\Models\Dataset;
use App\Models\Download;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $datasets = Dataset::where('status', 'valid')->get();
    $countDownloads = [];
    foreach ($datasets as $dataset) {
        $downloads = Download::where('id_dataset', $dataset->id)->get();
        foreach ($downloads as $download) {
            $countDownloads[] = $dataset->id;
        }
    }

    // $count = max(array_count_values($countDownloads));

    $dataset = Dataset::where('status', 'valid')
        ->latest()
        ->first();

    $newDataset = true;
    if (empty($dataset)) {
        $newDataset = false;
    }

    // Check if $countDownloads is not empty before using max
    if (!empty($countDownloads)) {
        $count = max(array_count_values($countDownloads));

        // Menghitung berapa kali setiap nilai muncul dalam array
        $counts = array_count_values($countDownloads);

        // Menentukan nilai yang paling banyak muncul
        $maxCount = max($counts);

        // Mendapatkan nilai yang paling banyak muncul
        $mostCommonValue = array_search($maxCount, $counts);

        $popularDataset = Dataset::findOrFail($mostCommonValue);
    } else {
        // Handle the case when $countDownloads is empty
        $count = 0;
        $popularDataset = null;
    }

    return view('welcome', compact(['dataset', 'countDownloads', 'popularDataset', 'newDataset']));
});

// login with google
Route::get('/auth/google/redirect', [LoginGoogleController::class, 'googleRedirect']);
Route::get('/auth/google/callback', [LoginGoogleController::class, 'googleCallback']);

// login with github
Route::get('/auth/github/redirect', [LoginGithubController::class, 'githubRedirect']);
Route::get('/auth/github/callback', [LoginGithubController::class, 'githubCallback']);

// download dataset
Route::get('download/{id}', [DownloadController::class, 'download'])->middleware('auth');

Route::get('datasets', [DatasetController::class, 'index']);

Route::get('detail/dataset/{id}', [DatasetController::class, 'show']);

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
Route::delete('delete/my/dataset/{id}', [MyDatasetController::class, 'destroy'])->middleware('auth');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index']);
    Route::get('admin/manage/datasets', [ManageDatasetsController::class, 'index']);
    Route::get('admin/detail/dataset/{id}', [ManageDatasetsController::class, 'show']);
    Route::put('admin/validate/dataset/{id}', [ManageDatasetsController::class, 'valid']);
    Route::post('admin/invalid/dataset/{id}', [ManageDatasetsController::class, 'invalid']);

    Route::get('admin/manage/users', [UserController::class, 'index']);
    Route::delete('admin/delete/user/{id}', [UserController::class, 'destroy']);
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
