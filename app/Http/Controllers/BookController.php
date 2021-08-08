<?php

namespace App\Http\Controllers;

use App\Filters\BookFilter;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function show(BookFilter $request, Request $requests)
    {

        $paginate = 5;
        $categories = Category::all();
        $books = Book::filter($request)->paginate($paginate);

        return view('templates.home', [
            'books' => $books,
            'categories' => $categories,
        ]);
    }
}
