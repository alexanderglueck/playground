<?php

namespace App\Http\Controllers;

use App\Models\ShareableLink;
use Illuminate\Contracts\View\View;

class ShareableController extends Controller
{
    public function index(): View
    {
        return view('shareable_links.index', [
            'shareableLinks' => ShareableLink::with('shareable')->get()
        ]);
    }

    public function show(ShareableLink $link)
    {
        return $link->shareable;
    }
}
