<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\Order;
use App\Models\Retailer;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    protected function registered(Request $request, $user)
    {
        if (session()->has('guest_order_id')) {
            $order = Order::find(session('guest_order_id'));
            if ($order && is_null($order->user_id)) {
                $order->update(['user_id' => $user->id]);
                foreach ($order->childs as $child) {
                    $child->update(['user_id' => $user->id]);
                }
                session()->forget('guest_order_id');
            }
        }
    }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    public function redirectTo()
    {

        switch (auth()->user()->role_id) {
            case 1:
                return RouteServiceProvider::ADMIN;
                break;
            case 2:
                return RouteServiceProvider::USER;
                break;

            case 3:

                if (auth()->user()->email == null && auth()->user()->phone == !null) {
                    return '/vendor-register-2nd-step';
                } else {

                    return '/verify-email';
                }
                break;
            case 4:
                return RouteServiceProvider::MARCHENTIGER;
                break;

            default:
                return RouteServiceProvider::HOME;
                break;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    // protected function validator(array $data)
    // {

    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'max:255'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'role' => ['required'],
    //     ]);
    // }
    public function register(Request $request)
    {
        // dd($request->all()); 
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'phone' => [
                'sometimes',
                'string',
                'max:255',
                'regex:/^(?:\+88|88)?(01[3-9]\d{8})$/', // Regex for Bangladeshi phone numbers
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required'],
            'referral' => 'nullable'
        ]);

        $username = $request->email;
        $email = null;
        $phone = $request->phone;
        $message = null;
        $email_verified = null;
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $email = $username;
            $message = "Email";
        } elseif (preg_match('/^\+?\d+$/', $username)) {
            $phone = $username;
            $email_verified = now();
            $message = "Phone";
        } else {
            return back()->with('error', "Your input is neither an email address or a phone number");
        }

        if (User::where('username', $username)->exists()) {
            return back()->with('error', "Your $message is already taken");
        }

        if ($request->role == 'vendor') {
            $role_id = 3;
        } else if ($request->role == 'marchentiger') {
            $role_id = 4;
        } else {
            $role_id = 2;
        }
        $referral = Retailer::where('unique_id', $request->referral)->first();
        // dd($request->referral);
        $array = [
            'name' => $request->name,
            'referral' => $referral->id ?? null,
            'email' => $email,
            'phone' => $phone,
            'username' => $username,
            'password' => Hash::make($request->password),
            'role_id' => $role_id,
            // 'email_verified_at' => now(),

        ];
        $user = User::create($array);
        $verify_token = Str::random(20);

        if ($role_id == 3 && $message == "Email") {
            // Mail::to(setting('site.email'))->send(new NotifyEmail($user));
            Mail::to($user->email)->send(new VerifyEmail($user, $verify_token));
        }

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function create(array $data)
    // {
    //     $username = $data['email'];
    //     $email=null;
    //     $phone=null;
    //     $message=null;
    //     if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    //        $email=$data['email'];
    //        $message="Email";
    //     } elseif (preg_match('/^\+?\d+$/',$data['email'])) {
    //         $phone=$data['email'];
    //         $message="Phone";
    //     } else {
    //         return back()->withErrors("Your $message is already taken");

    //     }

    //     if(User::where('username', $username)->exists()){
    //         return $username;
    //     }

    //     if($data['role']=='vendor'){
    //         $role_id=3;
    //     }else{
    //         $role_id=2;
    //     }


    //     $array=[
    //         'name' => $data['name'],
    //         'email' => $email,
    //         'phone' => $phone,
    //         'username' => $username,
    //         'password' => Hash::make($data['password']),
    //         'role_id' => $role_id,

    //     ];
    //     $user= User::create($array);
    //     $verify_token=Str::random(20);

    //     if($data['role']=='vendor'){
    //         // Mail::to(setting('site.email'))->send(new NotifyEmail($user));
    //         Mail::to($user->email)->send(new VerifyEmail($user,$verify_token));
    //     }

    //     return $user;
    // }
    public function vendorCreate()
    {

        return view('auth.seller.register');
    }
    public function marchentiger()
    {
        return view('auth.marchentiger.register');
    }
}
