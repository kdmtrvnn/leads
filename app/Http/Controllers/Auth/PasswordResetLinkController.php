<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class PasswordResetLinkController extends Controller
{
    public function create(): \Inertia\Response
    {
        return Inertia::render('Auth/ResetPassword', [
            'title' => 'Reset password - ' . config('app.name'),
            'success' => session('success') ?? null,
            'errors' => session('errors') ?? null,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return back()->with('errors', $validator->errors());
        }

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('errors', (object)['current_password' => 'Сurrent password is incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Пароль успешно изменён.');
    }
}
