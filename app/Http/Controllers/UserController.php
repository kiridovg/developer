<?php

namespace App\Http\Controllers;

use App\Contracts\Filter\FilterInterface;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show(FilterInterface $request)
    {
        return view('users', [
            'users' => $this->userService->getWithPaginate($request),
        ]);
    }

    public function store(AddUserRequest $request, UserRepository $userRepository)
    {
        $user = $userRepository->create($request);
        event(new Registered($user));
        return redirect(route('dashboard.users'));
    }

    public function stores(UpdateUserRequest $request, UserRepository $userRepository)
    {
        $userRepository->update($request);
        return redirect(route('dashboard.users'));
    }
}
