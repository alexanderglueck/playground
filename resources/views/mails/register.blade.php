<x-mail::message>
# Complete Registration

You are almost done! Click on the following link to complete your registration.

<x-mail::button :url="$url">
Complete Registration
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
