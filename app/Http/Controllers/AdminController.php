<?php

namespace App\Http\Controllers;

use App\Models\Earning;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function orderDetails(Order $order)
    {
        return view('auth.admin.order.details', compact('order'));
    }
    public function earnings()
    {

        $earnings = Earning::orderBy('created_at', 'desc')->get();

        $earningsGrouped = [];


        foreach ($earnings as $earning) {
            $date = Carbon::parse($earning->created_at)->format('d M, d');
            $shop = $earning->shop->id;

            if (!isset($earningsGrouped[$date])) {
                $earningsGrouped[$date] = [];
            }

            if (!isset($earningsGrouped[$date][$shop])) {
                $earningsGrouped[$date][$shop] = [];
            }
            $earningsGrouped[$date][$shop][] = $earning;
        }
        // dd($earningsGrouped);



        return view('auth.admin.earnings', compact('earningsGrouped'));
    }
    public function userPdf(Request $request)
    {
        $page = request()->get('page', 1);
        $perPage = 15; // Set the number of items per page
        $users = User::when(request()->has('key'), function ($q) {
            if (request()->key == 'role_id') {
                $q->whereHas('role', function ($query) {
                    if (request()->filter == 'equals') {
                        return $query->where('display_name', request()->s);
                    } else {
                        return $query->where('display_name', 'like', '%' . request()->s . '%');
                    }
                });
            } 
        })
            ->latest()
            ->get();
            // return view('auth.admin.user_pdf', compact('users'));
        $pdf = Pdf::loadView('auth.admin.user_pdf', compact('users'))->setPaper('a4', 'landscape');
      
        return $pdf->download();

    }
}
