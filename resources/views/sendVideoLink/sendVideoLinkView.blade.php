@component('mail::message')
# Welcome {{ Auth::user()->last_name }}!!
@component('mail::panel')
@component('mail::button', ['url'=>'https://google.com'])
Button Text
@endcomponent

This is panel
@endcomponent
Thanks <br>
RCHA
@endcomponent