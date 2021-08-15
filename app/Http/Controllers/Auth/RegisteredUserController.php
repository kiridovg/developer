<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(AddUserRequest $request, UserRepository $userRepository)
    {

        $user = $userRepository->create($request);
        $user->attachRole('user');
        event(new Registered($user));

        Auth::login($user);

        return redirect('/verify-email');
    }
}
