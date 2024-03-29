<?php

use App\Http\Controllers\Public\WelcomeController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\WorkspaceController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

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

Route::get('/', [WelcomeController::class, 'show'])->name('welcome');

Route::middleware(ProtectAgainstSpam::class)->group(function () {
    Route::post('/login', [WelcomeController::class, 'login'])->name('lookup');

    Route::post('/register', [WelcomeController::class, 'register'])->name('tenants.email');
});

Route::middleware('signed')->group(function () {
    Route::get('/workspace/create/{workspace}', [WorkspaceController::class, 'create'])->name('workspace.create');
    Route::post('/workspace/create/{workspace}', [WorkspaceController::class, 'store']);
});

Route::get('/privacy-policy', [StaticPageController::class, 'privacyPolicy'])->name('page.privacy_policy');
Route::get('/terms-of-service', [StaticPageController::class, 'termsOfService'])->name('page.terms_of_service');
