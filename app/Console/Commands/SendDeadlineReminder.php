<?php

namespace App\Console\Commands;

use App\Jobs\DailyMail;
use App\Models\task;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendDeadlineReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-deadline-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends mail remainding about tasks that have deadline tomorrow';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = task::where('deadline', '<=', Carbon::tomorrow()->setTime(23, 59, 59))->where('deadline', '>', Carbon::today()->setTime(23, 59, 59))->get();

        foreach($tasks as $task) {
            dispatch(new DailyMail($task));
        }
    }
}
