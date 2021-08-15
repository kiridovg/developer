<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::all();
    }

    public function create($userData)
    {
        return  User::create([
            'name' => $userData->name,
            'email' => $userData->email,
            'password' => Hash::make($userData->password),
        ]);
    }
    public function update($userData)
    {
        $user = User::findOrFail($userData['id']);
        $user->name = $userData['login'];
        $user->email = $userData['email'];
        $user->password = Hash::make($userData['password']);
        $user->save();
    }
}
