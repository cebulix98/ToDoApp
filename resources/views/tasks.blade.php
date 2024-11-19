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
                <form action="{{ route('tasks') }}" method="get" class="flex flex-col px-10">
                    <div class="flex justify-between">
                        <div>
                            <x-input-label for="priority" value="Priorytet" />
                            <x-select name="priority">
                                <option></option>
                                <option value="low"
                                    {{ isset($filters['priority']) && $filters['priority'] === 'low' ? 'selected' : '' }}>
                                    {{ __('validation.priority.low') }}</option>
                                <option value="medium"
                                    {{ isset($filters['priority']) && $filters['priority'] === 'medium' ? 'selected' : '' }}>
                                    {{ __('validation.priority.medium') }}</option>
                                <option value="high"
                                    {{ isset($filters['priority']) && $filters['priority'] === 'high' ? 'selected' : '' }}>
                                    {{ __('validation.priority.high') }}</option>
                            </x-select>
                        </div>
                        <div>
                            <x-input-label for="status" value="Status" />
                            <x-select name="status">
                                <option></option>
                                <option value="toDo"
                                    {{ isset($filters['status']) && $filters['status'] === 'toDo' ? 'selected' : '' }}>
                                    {{ __('validation.status.toDo') }}</option>
                                <option value="inProgress"
                                    {{ isset($filters['status']) && $filters['status'] === 'inProgress' ? 'selected' : '' }}>
                                    {{ __('validation.status.inProgress') }}</option>
                                <option value="done"
                                    {{ isset($filters['status']) && $filters['status'] === 'done' ? 'selected' : '' }}>
                                    {{ __('validation.status.done') }}</option>
                            </x-select>
                        </div>
                        <div>
                            <x-input-label for="dateFrom" value="Termin od" />

                            <x-text-input id="dateFrom" class="block mt-1 w-full" type="datetime-local" name="dateFrom"
                                value="{{ isset($filters['dateFrom']) ? $filters['dateFrom'] : '' }}" />
                        </div>
                        <div>
                            <x-input-label for="dateTo" value="Termin do" />

                            <x-text-input id="dateTo" class="block mt-1 w-full" type="datetime-local" name="dateTo"
                                value="{{ isset($filters['dateTo']) ? $filters['dateTo'] : '' }}" />
                        </div>
                    </div>

                    <x-primary-button type="submit" class="my-4 self-end">filtruj</x-primary-button>
                </form>
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
                                    {{ $task->title }}
                                </td>
                                <td class="description">
                                    {{ $task->description }}
                                </td>
                                <td>
                                    {{ __('validation.priority.' . $task->priority) }}
                                </td>
                                <td>
                                    {{ __('validation.status.' . $task->status) }}
                                </td>
                                <td>
                                    {{ $task->deadline }}
                                </td>
                                <td class="actions">
                                    <a href="{{ route('task.edit', $task->id) }}"><x-primary-button class="my-2">Edytuj</x-primary-button></a>
                                    <x-primary-button class="my-2">Udostępnij</x-primary-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
