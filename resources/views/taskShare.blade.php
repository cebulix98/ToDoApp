<x-guest-layout>
    <h2>{{$task->title}}</h2>
    <p><b>Termin:</b> {{$task->deadline}}</p>
    <p>{{$task->description}}</p>
    <p>Priorytet: {{ __('validation.priority.' . $task->priority) }}</p>
    <p>Status: {{ __('validation.status.' . $task->status) }}</p>
</x-guest-layout>
