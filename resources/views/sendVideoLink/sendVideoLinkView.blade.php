@component('mail::message')
# Welcome {{ Auth::user()->last_name }}!!

@component('mail::button', ['url' => $paidLink])
Click here to watch
@endcomponent
@component('mail::panel')
This is panel
@endcomponent
Thanks <br>
RCHA
@endcomponent