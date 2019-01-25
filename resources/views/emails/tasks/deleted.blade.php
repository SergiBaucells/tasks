@component('mail::message')
# Tasca eliminada

S'ha esborrat la tasca: {{ $task->name }}

@component('mail::button', ['url' => url('/tasques')])
Veure tasques
@endcomponent

Gracies,<br>
{{ config('app.name') }}
@endcomponent
