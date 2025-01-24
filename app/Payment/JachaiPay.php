<?php

namespace App\Payment;

use App\Models\Charge;
use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\Http;

class JachaiPay
{
    const BASE_URL = "https://dgpay.ekshop.gov.bd/api/";
    const HEADERS = [
        'merRegId' => 'merchantmHXbiT',
        'regPasKey' => 'yaXUSvmUjX3l',
        'shortName' => 'ukrbdmqey',
    ];
    public Charge $charge;

    public function __construct(Charge $charge)
    {
        $this->charge = $charge;
    }


    public static function init(Charge $charge)
    {
        return new self($charge);
    }

    public function createPaymentBody()
    {
        return [
            'cust_info' => [
                'cust_name' => $this->charge->chargeable->fullName,
                'cust_mobile' => $this->charge->chargeable->phone,
                'cust_email' => $this->charge->chargeable->email,
                'cust_mail_addr' => $this->charge->chargeable->address,
            ],
            'txn_info' => [
                'txn_id_no' => uniqid(),
                'txn_amount' => $this->charge->chargeable->total,
            ],
            'order_info' => [
                'merchant_ord_id_no' => $this->charge->id,
                'merchant_ord_det' => json_encode($this->charge->chargeable)
            ],
            'callback_uri' => [
                's_uri' => route('callback.payment.success'),
                'c_uri' => route('callback.payment.canceled'),
                'f_uri' => route('callback.payment.failed'),
                'ipn_uri' => route('callback.payment.ipn'),
            ]

        ];
    }
    public function createPaymentLink()
    {
        $response = Http::acceptJson()->withHeaders($this::HEADERS)->post($this::BASE_URL . 'payment-init', $this->createPaymentBody())->json();

        if ($response['code'] == 200) {
            return (object) [
                'id' => $response['transactionID'],
                'url' => $response['payment_url'],
            ];
        } else {
            throw new Exception('Payment request failed');
        }
    }

    public function getPaymentDetails()
    {
        $response = Http::acceptJson()->withHeaders($this::HEADERS)->get($this::BASE_URL . 'check/transaction/status', ['txnId' => $this->charge->uniqid])->json();
        if ($response['code'] == 200) {
            return (object) [
                'id' => $response->data->transaction_id,
                'data' => $response->data,
            ];
        } else {
            throw new Exception('Payment request failed');
        }
    }
}
