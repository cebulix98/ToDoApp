<x-mail::message>
Termin twojego zadania kończy się jutro <br>
Tytuł: {{$task->title}} <br>
Opis: {{$task->description}} <br>
Termin: {{$task->deadline}} <br>
Priorytet: {{$task->priority}} <br>
Status: {{$task->status}} <br>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
