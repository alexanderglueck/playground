<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class StaticPageController extends Controller
{
    public function privacyPolicy()
    {
        return view('page.show', [
            'title' => '',
            'content' => file_get_contents(resource_path('static/privacy_policy.md'))
        ]);
    }

    public function termsOfService()
    {
        return view('page.show', [
            'title' => '',
            'content' => file_get_contents(resource_path('static/terms_of_service.md'))
        ]);
    }
}
