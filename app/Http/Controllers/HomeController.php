<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Ebook;
use App\Models\Gender;
use App\Models\Order;
use App\Models\Role;
use Carbon\Carbon;
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
        $ebooks = Ebook::all();
        return view('home', ['ebooks' => $ebooks]);
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

        return view('saved');
    }

    public function show_ebook(Ebook $ebook)
    {
        return view('ebook_detail', ['ebook' => $ebook]);
    }

    public function rent_ebook(Ebook $ebook)
    {
        $user = Auth::user();

        Order::create([
            'account_id' => $user->id,
            'ebook_id' => $ebook->id,
            'order_date' => Carbon::now()->toDateString(),
        ]);

        return Redirect::route('show_cart');
    }

    public function show_cart()
    {
        $user = Auth::user();

        $items = Order::where('account_id', $user->id)->get();
        return view('cart', ['items' => $items]);
    }

    public function delete_cart(Order $order)
    {
        Order::destroy($order->id);
        return Redirect::back();
    }

    public function checkout_cart()
    {
        $user = Auth::user();

        Order::where('account_id', $user->id)->delete();
        return view('success');
    }

    public function show_account()
    {
        $accounts = Account::all();

        return view('maintenance', ['accounts' => $accounts]);
    }

    public function show_update_role(Account $account)
    {
        $roles = Role::all();
        return view('update_role', ['account' => $account, 'roles' => $roles]);
    }

    public function update_role(Request $request, Account $account)
    {
        $request->validate([
            'role_id' => ['required', 'exists:roles,id'],
        ]);

        $account->update([
            'role_id' => $request->role_id,
        ]);

        return Redirect::route('show_account');
    }

    public function delete_account(Account $account)
    {
        Account::destroy($account->id);
        return Redirect::back();
    }
}
