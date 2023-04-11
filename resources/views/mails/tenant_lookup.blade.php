<x-mail::message>
# Your Teams

Hey, here are the teams you are a part of!

@foreach($tenants as $tenant)
- {{ tenant_route($tenant->domain, 'dashboard') }}
@endforeach

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
