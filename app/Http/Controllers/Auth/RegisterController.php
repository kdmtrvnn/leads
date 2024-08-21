<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\RegisterConfirm;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepositoryInterface,
    ) {}

    public function create(): \Inertia\Response
    {
        return Inertia::render('Auth/Register', [
            'title' => 'Register page - ' . config('app.name'),
            'errors' => session('errors') ?? null,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        if ($validator->fails()) {
            return back()->with('errors', $validator->errors());
        }

        $user = $this->userRepositoryInterface->store($request);

        RegisterConfirm::dispatch($user)->onQueue('register_confirm');

        Auth::login($user);

        return redirect()->route('leads.index');
    }
}
