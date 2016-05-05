<?php

namespace App\Http\Controllers\Admin\Auth;

use App\User;
use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Lang;

class AuthController extends \App\Http\Controllers\Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesUsers, ThrottlesLogins;

    protected $guard = 'back';

    protected $loginView = 'admin.auth.login';

    protected $username = 'email';

    protected $maxLoginAttempts = 10;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectPath;

    protected $redirectAfterLogout;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->redirectPath = route('admin.profile');
        $this->redirectAfterLogout = route('admin.login');
    }

    protected function getFailedLoginMessage()
    {
        return Lang::get('admin.error_login_failed');
    }

    protected function getLockoutErrorMessage($seconds)
    {
        return Lang::get('admin.error_login_throttle', ['seconds' => $seconds]);
    }
}
