<p>Click here to reset your password for the Backoffice: </p>

<p><a href="{{ $link = route('admin::reset_password', ['token' => $token]).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a></p>
