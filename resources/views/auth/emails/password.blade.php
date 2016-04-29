<p>Click here to reset your password: </p>

<p><a href="{{ $link = route('reset_password', ['token' => $token]).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a></p>
