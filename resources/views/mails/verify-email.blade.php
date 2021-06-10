@component('mail::message')
# Dear {{$name}},

You are receiving this email because we received a signup request for your mail account.
Please confirm your email by clicking the following link:

@component('mail::button', ['url' => {{ $url }}])
Confirm Email
@endcomponent

If you did not request a signup , no further action is required.

Thanks,
{{ config('app.name') }}
@endcomponent