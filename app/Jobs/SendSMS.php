<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $dest;
    protected $msg;

    /**
     * Create a new job instance.
     *
     * @param string $dest
     * @param string $msg
     */
    public function __construct(string $dest, string $msg)
    {
        $this->dest = $dest;
        $this->msg = $msg;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        send_sms($this->dest, $this->msg);
    }
}
