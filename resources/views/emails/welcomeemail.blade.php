@component('mail::message')
# Introducció

Hola {{ $user->name }},

@component('mail::button', ['url' => 'https://tasks.test/home'])
Accedeix
@endcomponent

Gràcies,<br>
{{ config('app.name') }}
@endcomponent