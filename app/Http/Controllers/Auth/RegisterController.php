<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Admin;
// use App\Http\Requests\Frontend\ValidateRegister;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
        // $this->middleware('guest:admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'password' => 'required|min:8|same:confirm-password',
            'confirm-password' => 'required|min:8',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'active' => 1,
        ]);
    }

    // public function register(Request $request)
    // {
    //     $data = $request->all();

    //     $validator =  Validator::make($request->all(), [
    //         'username' => ['required', 'string', 'max:255', 'unique:users'],
    //         'name' => ['required', 'string', 'max:255'],
    //         'phone' => ['required'],
    //         'email' => ['nullable', 'string', 'email', 'max:255'],
    //         'password' => 'required|min:8|same:confirm-password',
    //         'confirm-password' => 'required|min:8|same:password',
    //     ]);

    //     // // create the validations
    //     // if ($validator->fails()) {
    //     //     return response()->json($validator->errors(), 422);
    //     // } else {
    //     User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'phone' => $data['phone'],
    //         'username' => $data['username'],
    //         'password' => Hash::make($data['password']),
    //         'active' => 1,
    //     ]);

    //     return redirect()->route('home.index');
    //     // }
    // }



    // show register for admin
    // public function showAdminRegisterForm()
    // {
    //     return view('auth.register', ['url' => 'admin']);
    // }

    // protected function createAdmin(Request $request)
    // {
    //     $this->validator($request->all())->validate();
    //     $admin = Admin::create([
    //         'name' => $request['name'],
    //         'email' => $request['email'],
    //         'password' => Hash::make($request['password']),
    //         'active'=>1,
    //     ]);
    //     return redirect()->intended('login/admin');
    // }

}
