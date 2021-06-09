@component('mail::message')

# Dear {{$name}},

This is a kind reminder that you have an @if($event->important) <span class="red">important</span> @endif event to attend to: 
# {{ $event->title }}
{{ $event->description }}

# On {{ $date }}, {{ $time }}

Thank you for using out app,
{{ config('app.name') }}

@endcomponent