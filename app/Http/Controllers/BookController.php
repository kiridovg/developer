<?php

namespace App\Http\Controllers;

use App\Contracts\Filter\FilterInterface;
use App\Http\Requests\UpdateBookRequest;
use App\Repositories\Interfaces\BookRepositoryInterface as BookRepository;
use App\Services\AuthorService;
use App\Services\BookService;
use App\Services\CategoryService;

class BookController extends Controller
{
    private CategoryService $categoryService;
    private BookService $bookService;
    private AuthorService $authorService;

    public function __construct(
        CategoryService $categoryService,
        BookService $bookService,
        AuthorService $authorService
    ) {
        $this->categoryService = $categoryService;
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    public function show(FilterInterface $request)
    {
        return view('templates.home', [
            'books' => $this->bookService->getWithPaginate($request),
            'categories' => $this->categoryService->getAll(),
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
        return view('templates.bookEditor.bookEditor', [
            'books' => $this->bookService->getWithPaginate($request),
            'categories' => $this->categoryService->getAll(),
        ]);
    }

    public function showAddBook(FilterInterface $request)
    {
        return view('templates.bookEditor.addBook', [
            'books' => $this->bookService->getWithPaginate($request),
            'categories' => $this->categoryService->getAll(),
            'authors' => $this->authorService->getAll(),
        ]);
    }

    public function showEditBook($id)
    {
        return view('templates.bookEditor.editBook', [
            'id' => $id,
            'categories' => $this->categoryService->getAll(),
            'authors' => $this->authorService->getAll(),
        ]);
    }
}
