<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;

class VerifyEmailController extends Controller
{
    public function verify($id, $verifyToken)
    {
        if (!$user = User::where([['id', $id], ['verify_token', $verifyToken]])->first()) {
            return redirect()->route('email.verify_error');
        }

        $user->verify_token = null;
        $user->email_verified_at = Carbon::now();
        $user->save();

        return redirect()->route('email.verify_success');
    }

    public function verifySuccess()
    {
        return view('emails.verify_success');
    }

    public function verifyError()
    {
        return view('emails.verify_error');
    }
}
