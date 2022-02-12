<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function show_profile()
    {
        $user  = Auth::user();
        $genders = Gender::all();
        $roles = Role::all();
        return view('profile', ['user' => $user, 'genders' => $genders, 'roles' => $roles]);
    }

    public function update_profile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'first_name' => ['required', 'string', 'alpha_num', 'max:25'],
            'middle_name' => ['nullable', 'string', 'alpha_num', 'max:25'],
            'last_name' => ['required', 'string', 'alpha_num', 'max:25'],
            'gender_id' => ['required', 'exists:genders,id'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:accounts,email,' . $user->id],
            'role_id' => ['required', 'exists:roles,id'],
            'password' => ['required', 'string', 'alpha_num', 'min:8'],
            'display_picture' => ['required', 'image'],
        ]);

        $display_picture = $request->file('display_picture');
        $display_picture_link = time() . '_' . $display_picture->getClientOriginalName();
        $display_picture->storeAs('public', $display_picture_link);

        $user->update([
            'first_name' => $request['first_name'],
            'middle_name' => $request['middle_name'],
            'last_name' => $request['last_name'],
            'gender_id' => $request['gender_id'],
            'email' => $request['email'],
            'role_id' => $request['role_id'],
            'display_picture_link' => $display_picture_link,
            'password' => Hash::make($request['password']),
        ]);

        return Redirect::back();
    }
}
