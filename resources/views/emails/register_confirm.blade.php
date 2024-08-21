<p>Thank you for joining {{ env('APP_NAME') }}!</p>
<a href="{{ route('email.verify', ['id' => $user->id, 'verify_token' => $user->verify_token]) }}">
    Подтвердить почту
</a>
