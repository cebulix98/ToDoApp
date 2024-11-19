<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{

    public function create(): View
    {
        return view('taskNew');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['string', 'required', 'max:255'],
            'description' => ['string'],
            'deadline' => ['date', 'required'],
            'priority' => ['required', Rule::in(['low', 'medium', 'high'])],
            'status' => ['required', Rule::in(['toDo', 'inProgress', 'done'])]
        ]);

        $task = task::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'priority' => $request->priority,
            'status' =>  $request->status,
            'user' => $request->user()->id
        ]);

        return redirect(route('tasks'));
    }

    public function edit(int $id): View
    {
        return view('taskEdit', [
            'task' => task::find($id)
        ]);
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'title' => ['string', 'required', 'max:255'],
            'description' => ['string'],
            'deadline' => ['date', 'required'],
            'priority' => ['required', Rule::in(['low', 'medium', 'high'])],
            'status' => ['required', Rule::in(['toDo', 'inProgress', 'done'])]
        ]);

        task::updateOrCreate(
            ['id' => $id],
            [
                'title' => $request->title,
                'description' => $request->description,
                'deadline' => $request->deadline,
                'priority' => $request->priority,
                'status' => $request->status
            ]
        );

        return redirect(route('tasks'));
    }

    public function list(Request $request): View
    {
        return view('tasks', ['tasks' => task::where('user', $request->user()->id)->get()]);
    }

    public function delete(Request $request, int $id) 
    {
        $task = task::find($id);

        if(!$task->user === $request->user()->id) {
            return redirect(route('tasks'));
        }

        $task->delete();

        return redirect(route('tasks'));
    }
}
