<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function all();
    public function create($userData);
    public function update($userData);
    public function createGoogleFacebook($userData);
}
