@component('mail::message')

@component('mail::table')
|NAME|EMAIL|PHONE|
|:----|:-----|:-----|
|{{ $mail->name }}|{{ $mail->email }}|
@endcomponent
<h1>Message</h1>
<p>{{ $mail->message }}</p>

@endcomponent
