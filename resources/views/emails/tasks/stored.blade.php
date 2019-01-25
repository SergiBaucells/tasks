@component('mail::message')
# Tasca guardada

S'ha creat la tasca: {{ $task->name }}

@component('mail::button', ['url' => url('/tasques')])
Veure tasca
@endcomponent

Gracies,<br>
{{ config('app.name') }}
@endcomponent