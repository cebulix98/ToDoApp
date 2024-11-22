<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function view(User $user, Task $task): bool
    {
        return $user->id === $task->user;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->user;
    }

    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->user;
    }

    public function share(User $user, Task $task): bool
    {
        return $user->id === $task->user;
    }
}