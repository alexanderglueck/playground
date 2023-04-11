<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function show()
    {
        return view('welcome');
    }

    public function login(Request $request)
    {
        $request->validateWithBag('login', [
            'email' => ['required', 'email']
        ]);
        // TODO Implement e-mail / tenant lookup

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
