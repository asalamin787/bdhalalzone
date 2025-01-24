<?php

namespace App\Payment;

use App\Models\Charge;

class Payment
{

    public $charge;
    public function __construct(Charge $charge)
    {
        $this->charge = $charge;
    }

    public static function create(Charge $charge)
    {
        return (new self($charge))->getPaymentLink();
    }

    public function getPaymentLink()
    {
        switch ($this->charge->method) {
            case 'dgpay':
                return JachaiPay::init($this->charge)->createPaymentLink();
            case 'cod':
                return $this;
            default:
                return JachaiPay::init($this->charge)->createPaymentLink();
        }
    }
    public function getPaymentDetails()
    {
        switch ($this->charge->method) {
            case 'dgpay':
                return JachaiPay::init($this->charge)->getPaymentDetails();
            case 'cod':
                return $this;
            default:
                return JachaiPay::init($this->charge)->getPaymentDetails();
        }
    }
}
