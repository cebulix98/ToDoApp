<?php

namespace App\Services;

use App\Models\SharedTask;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TaskService
{
    public function createTask(array $data, int $userId): Task
    {
        return Task::create(array_merge($data, ['user' => $userId]));
    }

    public function getTask(int $id): Task
    {
        return Task::findOrFail($id);
    }

    public function updateTask(Task $task, array $data): Task
    {
        $task->update($data);

        return $task;
    }

    public function getFilteredTasks(int $userId, array $filters): iterable
    {
        $query = Task::where('user', $userId);

        if (!empty($filters['priority'])) {
            $query->where('priority', $filters['priority']);
        }
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['dateFrom'])) {
            $query->where('deadline', '>=', $filters['dateFrom']);
        }
        if (!empty($filters['dateTo'])) {
            $query->where('deadline', '<=', $filters['dateTo']);
        }

        return $query->with(['shareToken' => function ($query) {
            $query->where('validTo', '>', Carbon::now());
        }])->get();
    }

    public function deleteTask(Task $task, int $userId): void
    {
        $task->delete();
    }

    public function shareTask(Task $task, int $userId): string
    {
        $sharedTask = SharedTask::create([
            'task' => $task->id,
            'token' => Str::random(),
            'validTo' => Carbon::today()->addDays(7),
        ]);

        return $sharedTask->token;
    }

    public function getSharedTask(string $token): ?Task
    {
        $sharedTask = SharedTask::where('token', $token)
            ->where('validTo', '>', Carbon::today())
            ->first();

        return $sharedTask ? Task::find($sharedTask->task) : null;
    }
}
