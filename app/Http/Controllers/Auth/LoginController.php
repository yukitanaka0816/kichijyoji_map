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

     //ログイン後のリダイレクト先を変更
    // protected $redirectTo = '/shop_items';
    protected function redirectTo()
    {
        if(Auth::user()->email == 'admin@admin.jp') {
            return '/admin/inquiries';
        } else {
            return '/shop_items';
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    //ログアウト後の動作をカスタマイズ
    protected function loggedOut(Request $request)
    {
        return redirect(route('login'));
    }
}
