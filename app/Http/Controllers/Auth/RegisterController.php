<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Account;
use App\Models\Gender;
use App\Models\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $genders = Gender::all();
        $roles = Role::all();
        return view('auth.register', ['genders' => $genders, 'roles' => $roles]);
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
            'first_name' => ['required', 'string', 'alpha_num', 'max:25'],
            'middle_name' => ['nullable', 'string', 'alpha_num', 'max:25'],
            'last_name' => ['required', 'string', 'alpha_num', 'max:25'],
            'gender_id' => ['required', 'exists:genders,id'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:accounts'],
            'role_id' => ['required', 'exists:roles,id'],
            'password' => ['required', 'string', 'alpha_num', 'min:8', 'confirmed'],
            'display_picture' => ['required', 'image'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Account
     */
    protected function create(array $data)
    {
        $display_picture = request()->file('display_picture');
        $display_picture_link = time() . '_' . $display_picture->getClientOriginalName();
        $display_picture->storeAs('public', $display_picture_link);

        return Account::create([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'gender_id' => $data['gender_id'],
            'email' => $data['email'],
            'role_id' => $data['role_id'],
            'display_picture_link' => $display_picture_link,
            'password' => Hash::make($data['password']),
        ]);
    }
}
