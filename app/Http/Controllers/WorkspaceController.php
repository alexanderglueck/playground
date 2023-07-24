<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class WorkspaceController extends Controller
{
    public function create(Request $request, string $workspace)
    {
        // TODO Create Model to store wannabe tenants (replaces the temporary cache solution)
        // Retrieve E-Mail from cache
        $email = Cache::get('email.' . $workspace);

        $tenant = $this->getTenant($workspace);

        if ($tenant && $this->userExists($tenant, $email)) {
            // User already completed his sign-up
            flash(__('Your workspace already exists'));

            return redirect(tenant_route($this->subdomain($workspace), 'dashboard'));
        }

        if ( ! $tenant) {
            // User clicked for the first time
            $tenant = Tenant::create(['id' => $workspace]);
            $tenant->domains()->create(['domain' => $this->subdomain($workspace)]);
        }

        return view('workspace.create', [
            'email' => $email,
            'workspace' => $workspace,
            'route' => $request->fullUrl()
        ]);
    }

    public function store(Request $request, string $workspace)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        if ( ! ($tenant = $this->getTenant($workspace))) {
            // Something went wrong, tenant should exist at this point!
            return redirect()->route('welcome');
        }

        // TODO Create Model to store wannabe tenants (replaces the temporary cache solution)
        // Retrieve E-Mail from cache
        $email = Cache::get('email.' . $workspace);

        $tenant->run(function () use ($email, $validated) {
            $user = new User([
                'email' => $email,
                'name' => $validated['name'],
                'password' => Hash::make($validated['password'])
            ]);
            $user->email_verified_at = Carbon::now();
            $user->save();

            // Assign the administrator role (first role)
            $user->roles()->attach(Role::first()->id);

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
