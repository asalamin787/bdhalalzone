<?php

namespace App\Http\Controllers\Marchentiger;

use App\Http\Controllers\Controller;
use App\Models\Retailer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PageController extends Controller
{
    public function homeOne()
    {
        return view('coming_soon');
    }
    public function dashboard()
    {

        return view('auth.marchentiger.dashboard');
    }
    public function createOrUpdate(Request $request)
    {
        $data = $request->validate([
            'email' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'division' => 'nullable|string|max:255',
            'zilla' => 'nullable|string|max:255',
            'upzilla' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'post_code' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'percentage_cost' => 'nullable|numeric',
            'total_own' => 'nullable|numeric',
            'total_withdraw' => 'nullable|numeric',
            'status' => 'nullable|integer',
            'name' => 'nullable',
        ]);

        $user = auth()->user();
        $retailer = $user->retailer;

        if ($request->hasFile('logo')) {
            if ($retailer->logo) {
                Storage::disk('public')->delete($retailer->logo);
            }

            $logoPath = $request->file('logo')->store('logos', 'public');

            $retailer->logo = $logoPath;
        }
        if ($request->hasFile('banner')) {
            if ($retailer->banner) {
                Storage::disk('public')->delete($retailer->banner);
            }
            $bannerPath = $request->file('banner')->store('banners', 'public');
            $retailer->banner = $bannerPath;
        }
        if ($retailer) {
            $user->retailer->update($data);
        } else {
            $data['unique_id'] = Str::random(10);
            $data['percentage_cost'] = setting('site.marchentiger_share');
            $data['name'] = auth()->user()->name;
            $user->retailer()->create($data);
        }

        return redirect()->back()->with('success_msg', 'Retailer information saved successfully.');
    }
    public function changePassword()
    {
        return view('auth.marchentiger.changePassword');
    }
    public function update_password(Request $request)
    {

        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return back()->with('success_msg', 'Password changed successfully');
    }
    public function transactions()
    {

        $transactions = auth()->user()->retailer->transactions;
        return view('auth.marchentiger.transaction', compact('transactions'));
    }
    public function widthrawRequest(Request $request)
    {
        $request->validate([
            'amount' => 'required',
        ]);
        $retailer = Auth()->user()->retailer;
        if ($request->amount > setting('site.minmum_widthraw_request') && $retailer->total_own > $request->amount) {
            $retailer->transactions()->create([
                'amount' => $request->amount,
                'status' => 'Pending',
            ]);
            $retailer->update([
                'total_own' => $retailer->total_own - $request->amount,
                'total_withdraw' => $retailer->total_withdraw + $request->amount
            ]);
            return back()->with('success_msg', 'Your transiction create successfull please wait admin response');
        } else {

            return back()->withErrors('Your request is not valid');
        }
    }
}
