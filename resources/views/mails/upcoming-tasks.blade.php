@component('mail::message')

# Dear, {{$name}}

Here is a list of tasks that you need to complete in the following <strong>{{ $following }}</strong>:
<ul>
@foreach($tasks as $task)
<li>  

# {{ $task->title }}  
{{ $task->description }}
  
On {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task->spec_date)->toFormattedDateString() }}, {{ ($task->spec_time) ? Carbon\Carbon::createFromFormat('H:i:s', $task->spec_time)->format('g:i A') : 'Daily' }}
</li>
<hr>
@endforeach
</ul>

Thank you for using out app,
{{ config('app.name') }}

@endcomponent