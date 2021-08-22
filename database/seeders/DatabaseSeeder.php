<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\AuthorBook;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Book::factory(30)->create();
        Author::factory(10)->create();
        Category::factory(5)->create();
        AuthorBook::factory(50)->create();
        BookCategory::factory(50)->create();
        $this->call(LaratrustSeeder::class);

    }
}
