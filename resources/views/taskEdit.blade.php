<x-app-layout>
    @vite(['resources/css/task.css'])
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista Zadań
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('task.update', $task->id) }}">
                    @method('patch')
                    @csrf
                    <div>
                        <x-input-label for="title" value="Tytuł" />

                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            value="{{ $task->title }}" required />

                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="deadline" value="Termin" />

                        <x-text-input id="deadline" class="block mt-1 w-full" type="datetime-local" name="deadline"
                            value="{{ $task->deadline }}" required />

                        <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="description" value="Opis" />
                        <x-textarea name="description">{{ $task->description }}</x-textarea><x-input-error
                            :messages="$errors->get('description')" class="mt-2" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="priority" value="Priorytet" />
                        <x-select name="priority" selected="{{ $task->priority }}">
                            <option value="low" {{ $task->priority === 'low' ? 'selected' : '' }}>
                                {{ __('validation.priority.low') }}</option>
                            <option value="medium" {{ $task->priority === 'medium' ? 'selected' : '' }}>
                                {{ __('validation.priority.medium') }}</option>
                            <option value="high" {{ $task->priority === 'high' ? 'selected' : '' }}>
                                {{ __('validation.priority.high') }}</option>
                        </x-select>
                        <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="status" value="Status" />
                        <x-select name="status" selected="{{ $task->status }}">
                            <option value="toDo" {{ $task->status === 'toDo' ? 'selected' : '' }}>
                                {{ __('validation.status.toDo') }}</option>
                            <option value="inProgress" {{ $task->status === 'inProgress' ? 'selected' : '' }}>
                                {{ __('validation.status.inProgress') }}</option>
                            <option value="done" {{ $task->status === 'done' ? 'selected' : '' }}>
                                {{ __('validation.status.done') }}</option>
                        </x-select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                    <x-primary-button type="submit">Zapisz</x-primary-button>
                </form>
                <form method="post" action="{{ route('task.delete', $task->id) }}">
                    @csrf
                    @method('delete')
                    <x-danger-button>Usuń</x-danger-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
