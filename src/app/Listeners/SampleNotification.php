<?php

namespace App\Listeners;

use App\Events\Sample;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SampleNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Sample  $event
     * @return void
     */
    public function handle(Sample $event)
    {
        \Log::Debug($event->data);
    }
}
