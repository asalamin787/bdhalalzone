<?php

namespace App\Models\Traits;

use App\Models\Charge;
use App\Payment\Payment;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait Chargeable
{

    public function charge(): MorphOne
    {
        return $this->morphOne(Charge::class, 'chargeable');
    }

    public function initializePayment($method = 'dgpay')
    {

        $charge = $this->charge()->create([
            'uniqid' => uniqid(),
            'method' => $method,
            'amount' => $this->total
        ]);

        $payment = Payment::create($charge);



        if ($charge->method != 'cod') {
            $charge->update([
                'uniqid' => $payment->id,
                'url' => $payment->url,
            ]);
        }

        return $charge;
    }
}
