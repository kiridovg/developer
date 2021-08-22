<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
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
        $user = User::where('id', '=', $userData['id'])->first();
        if (isset($user)) {
            $user->name = $userData['login'];
            $user->email = $userData['email'];
            $user->password = Hash::make($userData['password']);
            $user->save();
        }
    }

    public function createGoogleFacebook($userData)
    {
        $user = User::where('email', '=', $userData->email)->first();
        if (!$user) {
            $user = new User();
            $user->name = $userData->name;
            $user->email = $userData->email;
            $user->provider_id = $userData->id;
            $user->avatar = $userData->avatar;
            $user->attachRole('user');
            $user->save();
        }
        return $user;
    }
}
