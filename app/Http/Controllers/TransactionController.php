<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transactions()
    {
        $transactions = auth()->user()->shop->transactions;
        return view('auth.seller.transaction', compact('transactions'));
    }
    public function widthrawRequest(Request $request)
    {
        $request->validate([
            'amount' => 'required',
        ]);
        $shop = Auth()->user()->shop;
        if ($request->amount > setting('site.minmum_widthraw_request') && $shop->total_own > $request->amount) {
            $shop->transactions()->create([
                'amount' => $request->amount,
                'status' => 'Pending',
            ]);
            $shop->update([
                'total_own' => $shop->total_own - $request->amount,
                'total_withdraw' => $shop->total_withdraw + $request->amount
            ]);
            return back()->with('success_msg', 'Your transiction create successfull please wait admin response');
        } else {

            return back()->withErrors('Your request is not valid');
        }
    }
    public function action(Request $request, Transaction $transaction)
    {
        $request->validate([
            'type' => 'required',
        ]);
        $transaction->update([
            'status' => $request->type
        ]);
        return back()->with([
            'message'    =>"This transaction was paid for successfully.",
            'alert-type' => 'success',
        ]);
    }
}
