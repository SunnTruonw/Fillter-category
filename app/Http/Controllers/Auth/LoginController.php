<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        // $this->middleware('guest:admin')->except('logout');
    }


    public function login(Request $request)
    {
        if ($request->ajax()) {
            $validator = \Validator::make($request->all(), [
                'username' => 'required',   // required and email format validation
                'password' => 'required', // required and number field validation

            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
                // validation failed return with 422 status

            } else {
                //validations are passed try login using laravel auth attemp
                if (\Auth::attempt($request->only(["username", "password"]))) {
                    return response()->json(["status" => true, "redirect_location" => route("home.index")]);
                } else {
                    return response()->json([["Thông tin không hợp lệ"]], 422);
                }
            }
        }

        // validate the form data
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:6',
        ]);
        // attempt to log the user in
        if (Auth::guard('web')->attempt([
            'username' => $request->username,
            'password' => $request->password,
        ], $request->remember)) {
            //  return redirect()->intended('/admin');
            return redirect()->intended('/');
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('username', 'remember'));
    }

    // public function showAdminLoginForm()
    // {
    //     return view('auth.login', ['url' => 'admin']);
    // }

    // public function adminLogin(Request $request)
    // {
    //     $this->validate($request, [
    //         'email'   => 'required|email',
    //         'password' => 'required|min:6'
    //     ]);

    //     if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
    //         return redirect()->intended('/admin');
    //     }
    //     return back()->withInput($request->only('email', 'remember'));
    // }
}
