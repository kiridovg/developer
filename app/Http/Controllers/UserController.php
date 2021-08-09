<?php

namespace App\Http\Controllers;

use App\Filters\UserFilter;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function show(UserFilter $request, Request $requests)
    {

        $paginate = 5;
        $books = User::filter($request)->get();

        return view('users', [
            'books' => $books
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:8',
            'email' => 'required|string|email|max:255|min:8|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect('/users');
    }

    public function stores(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required',
            'login' => 'required|min:4|string|max:255',
            'email' => 'required|email|string|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::findOrFail($request['id']);
        $user->name = $request['login'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->save();
        return back();
    }
}

