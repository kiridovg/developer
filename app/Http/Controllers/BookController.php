<?php

namespace App\Http\Controllers;

use App\Contracts\Filter\FilterInterface;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Repositories\Interfaces\BookRepositoryInterface as BookRepository;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function show(FilterInterface $request)
    {

        $paginate = 5;
        $categories = Category::all();
        $books = Book::filter($request)->paginate($paginate);

        return view('templates.home', [
            'books' => $books,
            'categories' => $categories,
        ]);
    }

    public function create(UpdateBookRequest $request, BookRepository $bookRepository)
    {
        $bookRepository->create($request);

        return redirect(route('dashboard.bookEditor'));
    }

    public function delete($id, BookRepository $bookRepository)
    {
        $bookRepository->delete($id);

        return redirect(route('dashboard.bookEditor'));
    }


    public function update($id, UpdateBookRequest $request, BookRepository $bookRepository)
    {
        $bookRepository->update($id, $request);

        return redirect(route('dashboard.bookEditor'));
    }

    public function showEditor(FilterInterface $request)
    {

        $paginate = 20;
        $categories = Category::all();
        $books = Book::filter($request)->paginate($paginate);

        return view('templates.bookEditor.bookEditor', [
            'books' => $books,
            'categories' => $categories,
        ]);
    }

    public function showAddBook(FilterInterface $request)
    {

        $paginate = 20;
        $categories = Category::all();
        $authors = Author::all();
        $books = Book::filter($request)->paginate($paginate);

        return view('templates.bookEditor.addBook', [
            'books' => $books,
            'categories' => $categories,
            'authors' => $authors,
        ]);
    }

    public function showEditBook($id, FilterInterface $request)
    {
        $categories = Category::all();
        $authors = Author::all();

        return view('templates.bookEditor.editBook', [
            'id' => $id,
            'categories' => $categories,
            'authors' => $authors,
        ]);
    }


}
