@component('mail::message')

# Dear {{$receiver}},

You received a friend invitation from: <b>{{ $sender }}</b> ({{$senderEmail}})

@component('mail::button', ['url' => 'website.com'])
Confirm Friend Request
@endcomponent

Thank you for using out app,
{{ config('app.name') }}

@endcomponent