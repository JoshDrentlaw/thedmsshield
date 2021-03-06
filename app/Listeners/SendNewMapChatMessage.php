<?php

namespace App\Listeners;

use App\Events\NewMapChatMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNewMapChatMessage implements ShouldQueue
{
    /**
     * The name of the queue on which to place the broadcasting job.
     *
     * @var string
     */
    public $queue = 'mapMessages';

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
     * @param  NewMapChatMessage  $event
     * @return void
     */
    public function handle(NewMapChatMessage $event)
    {
        // var_dump($event);
    }
}