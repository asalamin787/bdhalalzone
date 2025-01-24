<?php

namespace App\Listeners;

use App\Events\ChargeStatusHasBeenUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateChargeable
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
     * @param  \App\Events\ChargeStatusHasBeenUpdated  $event
     * @return void
     */
    public function handle(ChargeStatusHasBeenUpdated $event)
    {
        $order = $event->charge->chargeable;
        $order->status = 1;
        $order->save();
    }
}
