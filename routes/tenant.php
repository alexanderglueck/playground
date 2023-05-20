<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ImpersonationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceOptionController;
use App\Http\Controllers\InvoicePdfController;
use App\Http\Controllers\NotebookController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShareableController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/


Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
        Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');

        Route::get('/invoices/options', [InvoiceOptionController::class, 'index'])->name('invoice_options.index');
        Route::get('/invoices/options/create', [InvoiceOptionController::class, 'create'])->name('invoice_options.create');
        Route::get('/invoices/options/{invoiceOption}', [InvoiceOptionController::class, 'show'])->name('invoice_options.show');

        Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
        Route::get('/invoices/create', [InvoiceController::class, 'store'])->name('invoices.create');
        Route::get('/invoices/credit/{invoice}', [InvoiceController::class, 'credit'])->name('invoices.credit');
        Route::get('/invoices/{invoice}/pdf/download', [InvoicePdfController::class, 'store'])->name('invoices.pdf.download');
        Route::get('/invoices/{invoice}/pdf/inline', [InvoicePdfController::class, 'show'])->name('invoices.pdf.inline');
        Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');

        Route::get('/calendar', CalendarController::class)->name('calendar.show');
        Route::get('/events/calendar', [EventController::class, 'index']);
        Route::get('/events/store', [EventController::class, 'store']);
        Route::get('/events/{event_instance}', [EventController::class, 'show'])->name('events.show');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/sharing-center', [ShareableController::class, 'index'])->name('shared.index');

        Route::resource('notebooks', NotebookController::class);
        Route::resource('notes', NoteController::class);
        Route::resource('tags', TagController::class);

        Route::delete('/shared/{link}', [ShareableController::class, 'destroy'])->name('shared.destroy');

        // TODO Add is-admin middleware or impersonation permission
        Route::get('/impersonate', [ImpersonationController::class, 'show']);
        Route::get('/impersonate/{token}', [ImpersonationController::class, 'store']);
    });

    Route::middleware('auth')->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');

        Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');
        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');
        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
        Route::put('password', [PasswordController::class, 'update'])->name('password.update');
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });

    Route::middleware('guest')->group(function () {
        Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('register', [RegisteredUserController::class, 'store']);
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store']);
        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
        Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
    });

    Route::middleware('shared')->group(function () {
        Route::get('/shared/{shareable_link}', [ShareableController::class, 'show'])->name('shared.show');
    });


});

Route::middleware([
    'api',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->prefix('api')->group(function () {
    Route::put('/events/{event_instance}', [EventController::class, 'update']);
    Route::get('/events/{event_instance}', [EventController::class, 'update']);
});
