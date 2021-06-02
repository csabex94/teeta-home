@component('mail::message')

# Dear, {{$name}}

Here is a list of events that you need to complete in the following <strong>{{ $following }}</strong>:
<ul>
@foreach($events as $event)
<li>  

# {{ $event->title }}  
{{ $event->description }}
  
On {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->spec_date)->toFormattedDateString() }}, {{ ($event->spec_time) ? Carbon\Carbon::createFromFormat('H:i:s', $event->spec_time)->format('g:i A') : 'Daily' }}
</li>
<hr>
@endforeach
</ul>

@component('mail::button', ['url' => 'localhost:8000'])
Check on our website
@endcomponent

Thank you for using out app,
{{ config('app.name') }}

@endcomponent