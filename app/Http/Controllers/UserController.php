<?php

namespace App\Http\Controllers;

use App\Contracts\Filter\FilterInterface;
use App\Contracts\Filter\QueryFilter;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

class UserController extends Controller
{
    public function show(FilterInterface $request)
    {
        $paginate = 5;
        $users = User::filter($request)->paginate($paginate);
        return view('users', [
            'users' => $users
        ]);
    }

    public function store(AddUserRequest $request, UserRepository $userRepository)
    {
        $user = $userRepository->create($request);
        event(new Registered($user));

        return redirect('/users');
    }

    public function stores(UpdateUserRequest $request, UserRepository $userRepository)
    {
        $userRepository->update($request);
        return back();
    }
}
