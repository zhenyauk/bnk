<?php

namespace App\Http\Controllers\Auth;

use App\Activity;
use App\Helpers\_Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    }

    public function login(LoginRequest $request)
    {
        $cred = $request->only('email', 'password');
        if( Auth::attempt($cred) ){
            $this->activity(Auth::user());
            $this->addLog(Auth::id());
            return redirect($this->redirectTo);
        }


        return back()->withErrors('Please, Check Email or Password');

    }

    public function addLog($user_id)
    {
        $log = _Helper::addLog($user_id, 'Вход пользователя в систему');
    }

    // Activities
    public function activity($user)
    {
        $act = new Activity();
        $act->user_id = $user->id;
        $act->ip = $_SERVER['SERVER_ADDR'];
        $act->save();
        return;
    }

    // Logout
    public function logout()
    {
        _Helper::addLog(Auth::id(), 'Выход из системы');
        Auth::logout();
        return redirect('/');
    }
}
