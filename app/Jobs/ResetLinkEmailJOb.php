<?php

namespace App\Jobs;

use App\Mail\PasswordResetMail;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ResetLinkEmailJOb implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */

    protected $email;
    protected $token;

    public function __construct($email,$token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new PasswordResetMail($this->email,$this->token));
    }
}
