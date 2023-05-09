<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class WorkspaceAvailabilityController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'workspace' => ['required', 'min:4', 'max:16', 'ascii', 'lowercase']
        ]);

        return [
            'available' => Tenant::query()
                ->where('id', '=', $validated['workspace'])
                ->doesntExist()
        ];
    }
}
