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
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function set_locale($locale = 'en')
    {
        if ($locale == 'en' || $locale == 'id') {
            Session::put('locale', $locale);
            return Redirect::back();
        }
    }

    public function index()
    {
        return view('welcome');
    }

    public function home()
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
            'gender_id' => ['required', 'exists:genders,gender_id'],
            'email' => ['required', 'string', 'regex:/(^[^\s@]+@[^\s@]+\.[^\s@]+$)/', 'max:50', 'unique:accounts,email,' . $user->account_id . ',account_id'],
            'role_id' => ['required', 'exists:roles,role_id'],
            'password' => ['required', 'string', 'regex:/[0-9]/', 'min:8'],
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
            'account_id' => $user->account_id,
            'ebook_id' => $ebook->ebook_id,
            'order_date' => Carbon::now()->toDateString(),
        ]);

        return Redirect::route('show_cart');
    }

    public function show_cart()
    {
        $user = Auth::user();

        $items = Order::where('account_id', $user->account_id)->get();
        return view('cart', ['items' => $items]);
    }

    public function delete_cart(Order $order)
    {
        Order::destroy($order->order_id);
        return Redirect::back();
    }

    public function checkout_cart()
    {
        $user = Auth::user();

        Order::where('account_id', $user->account_id)->delete();
        return view('success');
    }

    public function show_account()
    {
        $accounts = Account::where('delete_flag', '=', false)->get();

        return view('maintenance', ['accounts' => $accounts]);
    }

    public function show_update_role(Account $account)
    {
        $roles = Role::all();
        return view('update_role', ['account' => $account, 'roles' => $roles]);
    }

    public function update_role(Request $request, Account $account)
    {
        $user = $request->user();
        $name = $user->first_name . " " . ($user->middle_name ? $user->middle_name . " " : "") . "$user->last_name";

        $request->validate([
            'role_id' => ['required', 'exists:roles,role_id'],
        ]);

        $account->update([
            'role_id' => $request->role_id,
            'modified_at' => Carbon::now()->toDateString(),
            'modified_by' => $name
        ]);

        return Redirect::route('show_account');
    }

    public function delete_account(Account $account)
    {
        $account->update([
            'delete_flag' => true,
        ]);

        return Redirect::back();
    }
}
