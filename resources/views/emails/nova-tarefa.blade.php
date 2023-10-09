<x-mail::message>
# {{$tarefa}}

Data limite de conclusão: {{$data_limite_conclusao}}

<x-mail::button :url="$url">
Clique aqui apra ver  a tarefa
</x-mail::button>

att,<br>
{{ config('app.name') }}
</x-mail::message>
