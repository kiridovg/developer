<?php

namespace App\Services;

use App\Contracts\Filter\FilterInterface;
use App\Models\User;

class UserService
{
    private const DEFAULT_PAGINATE = 20;

    public function getWithPaginate(FilterInterface $request)
    {
        return User::filter($request)->paginate(self::DEFAULT_PAGINATE);
    }
}
