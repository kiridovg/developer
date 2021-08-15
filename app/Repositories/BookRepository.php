<?php

namespace App\Repositories;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class BookRepository implements BookRepositoryInterface
{
    public function all()
    {
        return User::all();
    }

    public function create($bookData)
    {
        $image = $bookData->file('image')->store('uploads', 'public');
        $image_name = $image;
        $book = Book::create([
            'name' => $bookData->title,
            'description' => $bookData->description,
            'image' => $image_name,
        ]);

        $categories = Category::find($bookData->category);
        $authors = Author::find($bookData->author);
        $book->categories()->attach($categories);
        $book->authors()->attach($authors);
    }
    public function update($id, $bookData)
    {
        $book = Book::findOrFail($id);
        if ($bookData->hasFile('image')) {
            Storage::disk('public')->delete($book->image);
            $image = $bookData->file('image')->store('uploads', 'public');
            $image_name = $image;
            $book->update([
                'name'=> $bookData->title,
                'description'=> $bookData->description,
                'image'=> $image_name,
            ]);
        }
        $categories = Category::find($bookData->category);
        $authors = Author::find($bookData->author);
        $book->categories()->sync($categories);
        $book->authors()->sync($authors);
        $book->save();
    }

    public function delete($bookData)
    {
        $book = Book::find($bookData);
        Storage::delete($book->image);
        $book->categories()->detach();
        $book->authors()->detach();
        $book->delete();
    }
}
