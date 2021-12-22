<?php

namespace App\Listeners;

use App\Events\Tamagotchi;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TamagotchiListener
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
     * @param  Tamagotchi  $event
     * @return void
     */
    public function handle(Tamagotchi $event)
    {
        //
    }
}
