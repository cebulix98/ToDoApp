<x-app-layout>
    @vite(['resources/css/tasks.css'])
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista Zadań
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="tasks-list">
                    <thead>
                        <tr>
                            <th>Tytuł</th>
                            <th>Opis</th>
                            <th>Priorytet</th>
                            <th>Status</th>
                            <th>Termin</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <td class="min-w-32">
                                {{$task->title}}
                            </td>
                            <td class="description">
                                {{$task->description}}
                            </td>
                            <td>
                            {{__('validation.priority.'.$task->priority)}}
                            </td>
                            <td>
                                {{__('validation.status.'.$task->status)}}
                            </td>
                            <td>
                                {{$task->deadline}}
                            </td>
                            <td class="actions">
                                <a href="{{route('task.edit', $task->id)}}"><button>Edytuj</button></a>
                                <button>Udostępnij</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>