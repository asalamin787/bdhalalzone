<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentCallbackController extends Controller
{
    public function success(Request $request)
    {
        $charge = Charge::where('uniqid', $request->transId)->first()->success();
        return redirect()->route('thankyou', ['status' => 'success', 'charge' => $charge->uniqid]);
    }

    public function canceled(Request $request)
    {

        $charge =  Charge::where('uniqid', $request->transId)->first()->canceled();
        return redirect()->route('thankyou', ['status' => 'success', 'charge' => $charge->uniqid]);
    }

    public function failed(Request $request)
    {

        $charge =  Charge::where('uniqid', $request->transId)->first()->failed();
        return redirect()->route('thankyou', ['status' => 'success', 'charge' => $charge->uniqid]);
    }

    public function ipn(Request $request)
    {
        Log::info($request->all());
        $charge = Charge::where('uniqid', $request['trnx_info']['trnx_id'])->firstOrFail();
        $charge->update(['payment_details' => $request->all()]);
        Log::success('Charge updated successfully ' . $charge->id);
    }

    public function refund(Request $request)
    {
        dd($request->all());
    }
}
