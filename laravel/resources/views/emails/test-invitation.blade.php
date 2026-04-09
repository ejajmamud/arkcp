@component('mail::message')
# Test Invitation

Dear {{ $student->first_name }},

Your payment has been processed successfully. Click the button below to start your test:

@component('mail::button', ['url' => $testUrl])
Start Test Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
