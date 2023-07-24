<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Mail\CompleteRegistrationMail;
use App\Mail\TenantLookupMail;
use App\Support\TenantUserLookup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

// TODO Cleanup controller
class WelcomeController extends Controller
{
    public function show()
    {
        return view('welcome');
    }

    public function login(Request $request)
    {
        $validated = $request->validateWithBag('login', [
            'email' => ['required', 'email']
        ]);

        $tenants = TenantUserLookup::get($validated['email']);

        if ($tenants->isNotEmpty()) {
            Mail::to($validated['email'])->send(new TenantLookupMail($tenants));
        }

        flash(__('An e-mail has been sent to you!'), 'success');

        return redirect()->route('welcome');
    }

    public function register(Request $request)
    {
        $validated = $request->validateWithBag('register', [
            'workspace' => ['required', 'min:4', 'max:16', 'ascii', 'lowercase', 'unique:tenants,id'],
            'email' => ['required', 'email']
        ]);

        // TODO Create Model to store wannabe tenants (replaces the temporary cache solution)
        // Cache E-Mail for activation link for 30 minutes
        Cache::put('email.' . $validated['workspace'], $validated['email'], 30 * 60);

        Mail::to($validated['email'])->send(new CompleteRegistrationMail($validated['workspace']));

        flash(__('An e-mail has been sent to you!'), 'success');

        return redirect()->route('welcome');
    }
}
