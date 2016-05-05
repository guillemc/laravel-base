<p>{{ trans('admin.email_reset_password_text') }}</p>

<p><a href="{{ $link = route('admin.reset_password', ['token' => $token]).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a></p>
