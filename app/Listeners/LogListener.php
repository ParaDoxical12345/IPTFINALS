<?php

namespace App\Listeners;

use App\Events\UserLog;
use App\Models\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserLog $event): void
    {
        Log::create([
            'log_entry' => $event->log_entry,
            'user_id' => auth()->user()->id
        ]);
    }
}
