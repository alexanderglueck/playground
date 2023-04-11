<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Mail\TenantLookupMail;
use App\Support\TenantUserLookup;
use Illuminate\Http\Request;
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

        return redirect()->route('welcome')->with('message', __('An e-mail has been sent to you!'));
    }

    public function register(Request $request)
    {
        // TODO Send mail to verify email ownership
        $request->validateWithBag('register', [
            'email' => ['required', 'email']
        ]);

        return redirect()->route('welcome')->with('message', __('An e-mail has been sent to you!'));
    }
}
