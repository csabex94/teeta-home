@component('mail::header', ['url' => public_path() . '/images/logo.png'])

@endcomponent
@component('mail::message')

# Dear {{$name}},

This is a kind reminder that you have an task to complete: 
# {{ $task->title }}
{{ $task->description }}

# On {{ $date }}, {{ $time }}

Thank you for using out app,
{{ config('app.name') }}

@endcomponent