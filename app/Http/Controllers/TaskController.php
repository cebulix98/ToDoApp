<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Services\TaskService;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    use AuthorizesRequests;

    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function create(): View
    {
        return view(view: 'taskNew');
    }

    public function store(TaskRequest $request): RedirectResponse
    {
        $this->taskService->createTask(data: $request->validated(), userId: $request->user()->id);

        return redirect()->route(route: 'tasks');
    }

    public function edit(int $id): View
    {
        $task = $this->taskService->getTask(id: $id);

        $this->authorize(ability: 'view', arguments: $task);

        return view(view: 'taskEdit', data: ['task' => $task]);
    }

    public function update(TaskRequest $request, int $id): RedirectResponse
    {
        $task = $this->taskService->getTask(id: $id);

        $this->authorize(ability: 'update', arguments: $task);

        $this->taskService->updateTask(task: $task, data: $request->validated());

        return redirect()->route(route: 'tasks');
    }

    public function list(Request $request): View
    {
        $tasks = $this->taskService->getFilteredTasks(userId: $request->user()->id, filters: $request->query());

        return view(view: 'tasks', data: [
            'tasks' => $tasks,
            'filters' => $request->query(),
        ]);
    }

    public function delete(int $id): RedirectResponse
    {
        $task = $this->taskService->getTask(id: $id);

        $this->authorize(ability: 'delete', arguments: $task);

        $task->delete();

        return redirect()->route(route: 'tasks');
    }

    public function share(Request $request, int $id): RedirectResponse
    {
        $task = $this->taskService->getTask(id: $id);

        $this->authorize(ability: 'delete', arguments: $task);

        $token = $this->taskService->shareTask(task: $task, userId: $request->user()->id);

        return redirect()->route(route: 'task.shared', parameters: ['token' => $token]);
    }

    public function shared(Request $request, string $token): RedirectResponse|View
    {
        $task = $this->taskService->getSharedTask(token: $token);

        if (!$task) {
            return $request->user()
                ? redirect()->route(route: 'tasks')
                : redirect()->route(route: 'welcome');
        }

        return view(view: 'taskShare', data: ['task' => $task]);
    }
}
