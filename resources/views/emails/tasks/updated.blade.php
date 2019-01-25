@component('mail::message')
# Tasca actualitzada

S'ha actualitzat la tasca: {{ $task->name }}

@component('mail::button', ['url' => url('/tasques')])
Veure tasca
@endcomponent

Gracies,<br>
{{ config('app.name') }}
@endcomponent
