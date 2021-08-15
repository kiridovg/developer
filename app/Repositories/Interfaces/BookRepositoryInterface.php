<?php

namespace App\Repositories\Interfaces;

use App\Models\Book;

interface BookRepositoryInterface
{
    public function all();
    public function create($userData);
}
