@component('mail::message')

# Dear, {{$name}}

This is a kind reminder that you have an task to complete: 
# {{ $task->title }}
{{ $task->description }}

# On {{ $date }}, {{ $time }}

Thank you for using out app,
{{ config('app.name') }}

@endcomponent