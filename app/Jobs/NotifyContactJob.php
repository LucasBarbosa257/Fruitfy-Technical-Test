<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyContactMail;

class NotifyContactJob implements ShouldQueue
{
    use Queueable;

    protected $contact;
    
    /**
     * Create a new job instance.
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->contact->email)->send(new NotifyContactMail($this->contact));
    }
}
