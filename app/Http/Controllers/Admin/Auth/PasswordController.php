<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends \App\Http\Controllers\Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $guard = 'back';
    protected $broker = 'admins';

    protected $redirectPath;
    protected $linkRequestView = 'admin.auth.forgot_password';
    protected $resetView = 'admin.auth.reset_password';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:back');
        $this->redirectPath = route('admin::profile');
    }
}
