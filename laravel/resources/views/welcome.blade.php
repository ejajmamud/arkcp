@component('mail::message')
# Hello {{ $name }}!

Your career test is ready. Please click the button below to begin:

@component('mail::button', ['url' => $examlink])
Start Career Test
@endcomponent

Test Details:
- Email: {{ $email }}
- Student ID: {{ $student_id }}

This link will expire in 24 hours.

Thanks,<br>
{{ config('app.name') }}
@endcomponent