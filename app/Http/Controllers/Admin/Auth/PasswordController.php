<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Password;

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
        $this->redirectPath = route('admin.profile');
    }

    protected function getEmailSubject()
    {
        return Lang::get('admin.email_reset_password_subject');
    }

    protected function getSendResetLinkEmailSuccessResponse($response)
    {
        return redirect()->back()->with('status', $this->getLocalizedMessage($response));
    }

    protected function getSendResetLinkEmailFailureResponse($response)
    {
        return redirect()->back()->withErrors(['email' => $this->getLocalizedMessage($response)]);
    }

    protected function getResetSuccessResponse($response)
    {
        return redirect($this->redirectPath())->with('status', $this->getLocalizedMessage($response));
    }

    protected function getResetFailureResponse(Request $request, $response)
    {
        return redirect()->back()->withInput($request->only('email'))->withErrors(['email' => $this->getLocalizedMessage($response)]);
    }

    protected function getLocalizedMessage($code)
    {
        switch ($code) {
            case Password::PASSWORD_RESET:
                $message = Lang::get('admin.status_password_reset');
                break;
            case Password::RESET_LINK_SENT:
                $message = Lang::get('admin.status_password_link_sent');
                break;
            case Password::INVALID_USER:
                $message = Lang::get('admin.error_user_not_found');
                break;
            case Password::INVALID_PASSWORD:
                $message = Lang::get('admin.error_invalid_password');
                break;
            case Password::INVALID_TOKEN:
                $message = Lang::get('admin.error_invalid_token');
                break;
            default:
                $message = $code;
        }
        return $message;
    }
}
