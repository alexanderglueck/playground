<?php

namespace App\Http\Controllers;

use App\Models\ShareableLink;

class ShareableController extends Controller
{
    public function show(ShareableLink $link)
    {
        return $link->shareable;
    }
}
