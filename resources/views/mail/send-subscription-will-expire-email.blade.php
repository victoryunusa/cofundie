@component('mail::message')
Hi, {{ $user->name }}

<h3>Your <b>{{ $project->title }}</b> project next installment last date on {{ formatted_date($installment->next_installment) }}</h3>

# Installment amount is {{ currency_format($installment->amount) }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
