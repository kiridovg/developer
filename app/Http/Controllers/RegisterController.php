<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(AddUserRequest $request, UserRepository $userRepository): RedirectResponse
    {
        $user = $userRepository->create($request);
        $user->attachRole('user');
        event(new Registered($user));

        Auth::login($user);

        return redirect('/verify-email');
    }
}
