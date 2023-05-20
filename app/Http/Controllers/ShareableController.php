<?php

namespace App\Http\Controllers;

use App\Models\ShareableLink;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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

    public function destroy(ShareableLink $link): RedirectResponse
    {
        $link->delete();

        return redirect()->route('shared.index');
    }
}
