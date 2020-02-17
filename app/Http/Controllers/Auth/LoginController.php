<?php

namespace App\Http\Controllers\Auth;

use App\Activity;
use App\Helpers\_Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Pin;
use App\Providers\RouteServiceProvider;
use App\User;
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
        if(! $this->checkIfAdmin($request->email)){
            // Check user's pin
            if( $pin = Pin::wherePin($request->pin)->first() ){
                $pin->delete();
            }else{
                $this->addLogPinError($request->email);
                return back()->withErrors(['Пин код устарел. Обратитесь к администратору за получением нового ПИН-а']);
            }
        }

        $cred = $request->only('email', 'password');
        if( Auth::attempt($cred) ){
            $this->activity(Auth::user());
            $this->addLog(Auth::id());
            return redirect($this->redirectTo);
        }

        $this->passwordErrorLog($request->email);

        return back()->withErrors('Please, Check Email or Password');

    }

    public function checkIfAdmin($email)
    {
        $temp_user = User::whereEmail($email)->firstOrFail();
        if($temp_user->role == 'admin')
            return true;
        return false;
    }

    public function addLog($user_id)
    {
        $log = _Helper::addLog($user_id, 'Вход пользователя в систему');
    }

    public function addLogPinError($email)
    {
        if( $user = User::whereEmail($email)->first() )
            $log = _Helper::addLog($user->id, 'Ошибка пин кода', 'Ошибка');

        return true;
    }

    public function passwordErrorLog($email)
    {
        if( $user = User::whereEmail($email)->first() ){
            $log = _Helper::addLog($user->id, 'Неправильный пароль', 'Ошибка');
        }else{
            $log = _Helper::addLogWithoutUserId('Неправильный пароль для ' . $email);
        }

        return true;
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
