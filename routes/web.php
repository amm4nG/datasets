<?php

use App\Http\Controllers\Admin\ManageDatasetsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContributeDatasetController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\MyDatasetController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('download', function () {
//     $paths = '8';

//     $files = Storage::files('public/datasets/' . $paths);
//     // var_dump($files);

//     $zip = new ZipArchive();
//     $zipFileName = 'downloaded.zip';

//     if ($zip->open(storage_path($zipFileName), ZipArchive::CREATE) === true) {
//         // Tambahkan setiap file ke dalam zip
//         foreach ($files as $file) {
//             // Ambil nama file dari path lengkap
//             $fileName = pathinfo($file, PATHINFO_BASENAME);
//             // echo $fileName;
//             // Tambahkan file ke dalam zip dengan nama yang sama
//             $zip->addFile(storage_path('app/' . $file), $fileName);
//         }
//         // Tutup zip setelah semua file ditambahkan
//         $zip->close();

//         return response()
//             ->download(storage_path($zipFileName))
//             ->deleteFileAfterSend(true);
//     } else {
//         // Jika terjadi kesalahan saat membuat zip
//         return response()->json(['error' => 'Gagal membuat file zip'], 500);
//     }
// });

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
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('admin/manage/datasets', [ManageDatasetsController::class, 'index']);
    Route::get('admin/detail/dataset/{id}', [ManageDatasetsController::class, 'show']);
    Route::put('admin/validate/dataset/{id}', [ManageDatasetsController::class, 'valid']);
    Route::put('admin/invalid/dataset/{id}', [ManageDatasetsController::class, 'invalid']);

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
