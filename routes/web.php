<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MunicipalityProfileController;
use App\Http\Controllers\MunicipalityOfferController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\CompanyServiceController;
use App\Http\Controllers\CompanyOfferController;
use App\Http\Controllers\StaticPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// 利用規約・プライバシーポリシー（公開ページ）
Route::get('/terms', [StaticPageController::class, 'terms'])->name('terms');
Route::get('/privacy', [StaticPageController::class, 'privacy'])->name('privacy');

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

    // 企業サービス公開ページ（全ユーザー閲覧可能）
    Route::get('/services', [CompanyServiceController::class, 'publicIndex'])->name('services.public.index');
    Route::get('/services/{id}', [CompanyServiceController::class, 'show'])->name('services.show');

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

    // 企業プロフィール・サービス機能
    Route::prefix('companies')->name('companies.')->group(function () {
        // マイページ（プロフィール編集）
        Route::get('/profile', [CompanyProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [CompanyProfileController::class, 'update'])->name('profile.update');

        // サービス投稿管理
        Route::get('/services', [CompanyServiceController::class, 'index'])->name('services.index');
        Route::get('/services/create', [CompanyServiceController::class, 'create'])->name('services.create');
        Route::post('/services', [CompanyServiceController::class, 'store'])->name('services.store');
        Route::get('/services/{id}/edit', [CompanyServiceController::class, 'edit'])->name('services.edit');
        Route::put('/services/{id}', [CompanyServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{id}', [CompanyServiceController::class, 'destroy'])->name('services.destroy');

        // オファー機能
        Route::post('/offers', [CompanyOfferController::class, 'store'])->name('offers.store');
        Route::get('/offers/sent', [CompanyOfferController::class, 'sent'])->name('offers.sent');
        Route::get('/offers/received', [CompanyOfferController::class, 'received'])->name('offers.received');
    });
});

require __DIR__.'/auth.php';
