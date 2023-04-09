<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceOptionController;
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

Auth::loginUsingId(1);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacts', [ContactController::class, 'index']);
Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');

Route::get('/invoices/options', [InvoiceOptionController::class, 'index'])->name('invoice_options.index');
Route::get('/invoices/options/create', [InvoiceOptionController::class, 'create'])->name('invoice_options.create');
Route::get('/invoices/options/{invoiceOption}', [InvoiceOptionController::class, 'show'])->name('invoice_options.show');

Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
Route::get('/invoices/create', [InvoiceController::class, 'store'])->name('invoices.create');
Route::get('/invoices/credit/{invoice}', [InvoiceController::class, 'credit'])->name('invoices.credit');
Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
