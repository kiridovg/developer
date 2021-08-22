<?php

namespace App\Services;

use App\Models\Author;

class AuthorService
{
    public function getAll()
    {
        return Author::all();
    }
}
