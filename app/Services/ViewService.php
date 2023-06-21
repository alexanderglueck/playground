<?php

namespace App\Services;

use App\Models\Tag;
use App\Models\View;
use App\Support\ViewType;
use Illuminate\Support\Collection;

class ViewService
{
    public function getViews(?ViewType $viewType = null): Collection
    {
        if ($viewType) {
            return View::query()->where('view_type', '=', $viewType)->get();
        }

        return View::all();
    }

}
