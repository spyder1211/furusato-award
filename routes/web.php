<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MunicipalityProfileController;
use App\Http\Controllers\MunicipalityOfferController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// 承認待ちページ
Route::get('/pending-approval', function () {
    return view('auth.pending-approval');
})->middleware('auth')->name('pending-approval');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'approved'])->name('dashboard');

Route::middleware(['auth', 'approved'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 首長マッチング機能
    Route::prefix('municipalities')->name('municipalities.')->group(function () {
        // プロフィール一覧・詳細
        Route::get('/', [MunicipalityProfileController::class, 'index'])->name('index');
        Route::get('/{id}', [MunicipalityProfileController::class, 'show'])->name('show');

        // マイページ（プロフィール編集）
        Route::get('/my/profile', [MunicipalityProfileController::class, 'edit'])->name('edit');
        Route::put('/my/profile', [MunicipalityProfileController::class, 'update'])->name('update');

        // オファー機能
        Route::post('/offers', [MunicipalityOfferController::class, 'store'])->name('offers.store');
        Route::get('/offers/sent', [MunicipalityOfferController::class, 'sent'])->name('offers.sent');
        Route::get('/offers/received', [MunicipalityOfferController::class, 'received'])->name('offers.received');
    });
});

require __DIR__.'/auth.php';
