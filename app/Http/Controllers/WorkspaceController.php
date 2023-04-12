<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class WorkspaceController extends Controller
{
    public function create(Request $request, string $workspace, string $email)
    {
        if ($tenant = $this->getTenant($workspace)) {
            if ($this->userExists($tenant, $email)) {
                flash(__('Your  workspace already exists'));

                return redirect(tenant_route($this->subdomain($workspace), 'dashboard'));
            }

            return view('workspace.create', [
                'email' => $email,
                'route' => $request->fullUrl()
            ]);
        }

        $tenant = Tenant::create(['id' => $workspace]);
        $tenant->domains()->create(['domain' => $this->subdomain($workspace)]);

        return view('workspace.create', [
            'email' => $email,
            'route' => $request->fullUrl()
        ]);
    }

    public function store(Request $request, string $workspace, string $email)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        if ( ! ($tenant = $this->getTenant($workspace))) {
            // Something went wrong, tenant should exist at this point!
            return redirect()->route('welcome');
        }

        $tenant->run(function () use ($email, $validated) {
            $user = new User([
                'email' => $email,
                'name' => $validated['name'],
                'password' => Hash::make($validated['password'])
            ]);
            $user->email_verified_at = Carbon::now();
            $user->save();

            event(new Registered($user));
        });

        flash(__('All done! Sign-in to get started'));

        return redirect(tenant_route($this->subdomain($workspace), 'dashboard'));
    }

    private function getTenant(string $workspace): ?Tenant
    {
        return Tenant::query()
            ->where('id', '=', $workspace)
            ->first();
    }

    private function userExists(Tenant $tenant, string $email): bool
    {
        return $tenant->run(function () use ($email) {
            return User::query()->where('email', '=', $email)->exists();
        });
    }

    private function subdomain(string $workspace): string
    {
        return $workspace . '.' . config('tenancy.central_domain');
    }
}
