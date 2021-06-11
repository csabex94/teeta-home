@component('mail::header', ['url' => public_path() . '/images/logo.png'])

@endcomponent

@component('mail::message')
# Dear {{$name}},

You are receiving this email because we received a signup request for your mail account.
Please confirm your email by clicking the following link:

<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
<a href="{{ $url }}" class="button button-{{ $color ?? 'primary' }}" target="_blank" rel="noopener">Confirm Email</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
    

If you did not request a signup , no further action is required.

Thanks,
{{ config('app.name') }}
@endcomponent