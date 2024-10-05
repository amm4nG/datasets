<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManageDatasetsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContributeDatasetController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\DonationPaperController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginGithubController;
use App\Http\Controllers\LoginGoogleController;
use App\Http\Controllers\MyDatasetController;
use App\Http\Controllers\RegistrationController;
use App\Models\Dataset;
use App\Models\Download;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

    $dataset = Dataset::where('status', 'valid')->latest()->first();

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

Route::get('/email/verify', function () {
    return view('verify-email');
})
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->intended('/');
})
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

// login with google
Route::get('/auth/google/redirect', [LoginGoogleController::class, 'googleRedirect']);
Route::get('/auth/google/callback', [LoginGoogleController::class, 'googleCallback']);

// login with github
Route::get('/auth/github/redirect', [LoginGithubController::class, 'githubRedirect']);
Route::get('/auth/github/callback', [LoginGithubController::class, 'githubCallback']);

// download dataset
Route::get('download/{id}', [DownloadController::class, 'download'])->middleware(['auth', 'verified']);

Route::get('datasets', [DatasetController::class, 'index']);

Route::get('detail/dataset/{id}', [DatasetController::class, 'show']);

Route::get('login', [AuthController::class, 'index'])
    ->name('login')
    ->middleware('guest');
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::post('login/validation', [AuthController::class, 'validation']);

Route::get('register', [RegistrationController::class, 'index'])->middleware('guest');
Route::post('register/user', [RegistrationController::class, 'store']);

Route::get('donation', [ContributeDatasetController::class, 'index'])->middleware(['auth', 'verified']);
Route::post('more/info', [ContributeDatasetController::class, 'moreInfo'])->middleware(['auth', 'verified']);
Route::post('donation/store', [ContributeDatasetController::class, 'store'])->middleware(['auth', 'verified']);
Route::get('my/dataset', [MyDatasetController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('my/dataset/edit/{id}', [MyDatasetController::class, 'edit'])->middleware(['auth', 'verified']);
Route::post('more/info/my/dataset', [MyDatasetController::class, 'moreInfo'])->middleware(['auth', 'verified']);
Route::put('my/dataset/update/{id}', [MyDatasetController::class, 'update'])->middleware(['auth', 'verified']);
Route::get('my/dataset/{id}', [MyDatasetController::class, 'show'])->middleware(['auth', 'verified']);
Route::delete('delete/my/dataset/{id}', [MyDatasetController::class, 'destroy'])->middleware(['auth', 'verified']);
Route::post('donation/paper', [DonationPaperController::class, 'store'])->middleware(['auth', 'verified']);

Route::group(['middleware' => ['auth', 'verified', 'role:admin']], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index']);
    Route::get('admin/manage/datasets', [ManageDatasetsController::class, 'index']);
    Route::get('admin/detail/dataset/{id}', [ManageDatasetsController::class, 'show']);
    Route::delete('admin/delete/dataset/{id}', [ManageDatasetsController::class, 'destroy']);

    Route::put('admin/validate/dataset/{id}', [ManageDatasetsController::class, 'valid']);
    Route::post('admin/invalid/dataset/{id}', [ManageDatasetsController::class, 'invalid']);

    Route::get('admin/manage/users', [UserController::class, 'index']);
    Route::delete('admin/delete/user/{id}', [UserController::class, 'destroy']);
});

Route::get('forgot/password', function () {
    return view('auth.forgot-password');
})->middleware('guest');

Route::post('send/code/verification', [ForgotPasswordController::class, 'sendCodeVerification']);
Route::post('verify', [ForgotPasswordController::class, 'verify']);
Route::post('reset/password', [ForgotPasswordController::class, 'resetPassword']);

Route::get('contact/information', function () {
    return view('contact-information');
});
Route::get('about', function () {
    return view('about');
});

Route::post('search/dataset', function (Request $request) {
    $datasets = Dataset::where('name', 'like', '%' . $request->name . '%')->where('status', 'valid')->get();
    return response()->json($datasets);
});

// Route::post('post', function(Request $request){

//     // lakukan operasi untuk menyimpan data suhu

//     // kemudian kembalika dalam bentuk json
//     return response()->json([
//         'message' => 'Successfully',
//         'suhu' => $request->suhu
//     ]);
// });