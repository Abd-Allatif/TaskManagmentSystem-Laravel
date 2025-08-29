<?php

namespace App\Jobs;

use App\Mail\VerificationMail;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class VerificationEmailSendJob implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $user;
    protected $url;
    /**
     * Create a new job instance.
     */
    public function __construct($user, $url)
    {
        $this->user = $user;
        $this->url = $url;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Mail::to($this->user->email)->send(new VerificationMail($this->user, $this->url));

        Log::info('Job running for user: ' . $this->user->email);

        try {
            Mail::to($this->user->email)->send(new VerificationMail($this->user, $this->url));
            Log::info('Email sent successfully for user: ' . $this->user->email);
        } catch (Exception $e) {
            Log::error('Email send failed: ' . $e->getMessage());
        }
    }
}
