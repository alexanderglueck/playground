<?php

use App\Http\Controllers\Public\WelcomeController;
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

Route::middleware('signed')->group(function() {
    Route::get('/workspace/create/{workspace}/{email}', [WorkspaceController::class, 'create'])->name('workspace.create');
    Route::post('/workspace/create/{workspace}/{email}', [WorkspaceController::class, 'store']);
});
