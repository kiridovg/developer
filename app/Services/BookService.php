<?php

namespace App\Services;

use App\Contracts\Filter\FilterInterface;
use App\Models\Book;

class BookService
{
    private const DEFAULT_PAGINATE = 10;

    public function getAll()
    {
        return Book::all();
    }

    public function getId(int $id)
    {
        return Book::find($id);
    }

    public function getWithPaginate(FilterInterface $request)
    {
        return Book::filter($request)->paginate(self::DEFAULT_PAGINATE);
    }
}
