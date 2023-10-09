@component('mail::message')
# Welcome {{ Auth::user()->last_name }}!!

{{-- @component('mail::button', ['url' => $paidLink]) --}}
@component('mail::button', ['url' => url("/processPaidLink/{$paidLink}")])
Click here to watch
@endcomponent
@component('mail::panel')
This is panel
@endcomponent
Thanks <br>
RCHA
@endcomponent