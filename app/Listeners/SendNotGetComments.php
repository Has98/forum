<?php

namespace App\Listeners;

use App\Events\GetComments;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotGetComments
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
     * @param  \App\Events\GetComments  $event
     * @return void
     */
    public function handle(GetComments $event)
    {
        //
    }
}
