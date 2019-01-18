<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/';

    protected function redirectTo()
    {
        return '/';
    }

    protected $gee;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GeeCaptchaController $gee)
    {
        $this->gee = $gee;
        $this->middleware('guest')->except('logout');
    }

    /**
     * 重写login验证逻辑，增加极验验证
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);

        if (!$this->gee->verify()) {
            throw ValidationException::withMessages([
                'captcha' => '无效的验证码失效!',
            ]);
        }

    }
}
