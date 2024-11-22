<?php

namespace App\Jobs;

use App\Mail\TaskDeadlineReminder;
use App\Models\task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class DailyMail implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    private task $task;

    /**
     * Create a new job instance.
     */
    public function __construct(task $task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->task->useraa->email)->send(new TaskDeadlineReminder($this->task));
    }
}
