<?php

namespace App\Console\Commands;

use App\Mail\SendDeadlineMail;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendAutoDeadlineMails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-auto-deadline-mails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends an Email for Tasks that thier dead lines dates ended';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        $tasks = Task::parent()->with('users')->where('deadline', '<=', $now)->where('status', 'in_progress')->get();
        foreach ($tasks as $task) {
            foreach ($task->users as $user) {
                Mail::to($user->email)->send(new SendDeadlineMail($task, $user));
                
                $task->status = 'completed';
                $task->save();
            }
        }
    }
}
