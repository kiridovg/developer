<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param AddUserRequest $request
     * @param UserRepository $userRepository
     * @return RedirectResponse
     *
     */
    public function store(AddUserRequest $request, UserRepository $userRepository): RedirectResponse
    {

        $user = $userRepository->create($request);
        $user->attachRole('user');
        event(new Registered($user));

        Auth::login($user);

        return redirect('/verify-email');
    }
}
