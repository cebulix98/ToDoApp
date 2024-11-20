<?php

namespace App\Http\Controllers;

use App\Models\SharedTask;
use App\Models\task;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

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
            'description' => ['string', 'nullable'],
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

        $query = task::where('user', $request->user()->id);

        if($request->query('priority')) {
            $query->where('priority', $request->query('priority'));
        }
        if($request->query('status')) {
            $query->where('status', $request->query('status'));
        }
        if($request->query('dateFrom')) {
            $query->where('deadline', '>=', $request->query('dateFrom'));
        }
        if($request->query('dateTo')) {
            $query->where('deadline', '<=',$request->query('dateTo'));
        }

        $query->with(['shareToken' => function($query) {
            $query->where('validTo', '>', Carbon::now());
        }]);

        return view('tasks', [
            'tasks' => $query->get(),
            'filters' => $request->query()
    ]);
    }

    public function delete(Request $request, int $id)
    {
        $task = task::find($id);

        if (!$task->user === $request->user()->id) {
            return redirect(route('tasks'));
        }

        $task->delete();

        return redirect(route('tasks'));
    }

    public function share(Request $request, int $id)
    {
        $task = task::find($id);

        if (!$task->user === $request->user()->id) {
            return redirect(route('tasks'));
        }

        $token = SharedTask::create([
            'task' => $task->id,
            'token' => Str::random(),
            'validTo' => Carbon::today()->addDays(7)
        ]);

        return redirect(route('task.shared', ['token' => $token->token]));
    }

    public function shared(Request $request, string $token)
    {
        $sharedTask = SharedTask::where('token', $token)->where('validTo', '>', Carbon::today())->first();

        if ($sharedTask === null) {
            if($request->user()) {
                return redirect(route('tasks'));
            }
            return redirect(route('welcome'));
        }

        $task = task::find($sharedTask->task);

        return view('taskShare', [
            'task' => $task
        ]);
    }
}
