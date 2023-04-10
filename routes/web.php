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

Route::get('/impersonate', function () {
    $redirectUrl = '/';

    // Let's say we want to be redirected to the dashboard
    // after we're logged in as the impersonated user.
    $token = tenancy()->impersonate($tenant, $user->id, $redirectUrl);
});

Route::get('/impersonate/{token}', \App\Http\Controllers\ImpersonationController::class);

