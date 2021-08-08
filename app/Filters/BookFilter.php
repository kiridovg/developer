<?php

namespace App\Filters;

use App\Models\Book;
use App\Models\Category;

class BookFilter extends QueryFilter
{
    public function search_field(string $search_string)
    {
        return $this->builder->where(function ($query) use ($search_string) {
            $query->where('name', 'LIKE', '%' . $search_string . '%')
                ->orWhere('description', 'LIKE', '%' . $search_string . '%');
        });
    }

    public function category_name(string $category)
    {
        return $this->builder -> whereHas('categories', function ($query) use ($category) {
            $query->where('categories.name', $category);
        });
    }

    public function filter_name(string $filter)
    {
        if ($filter == 'name-a-z') {
            return $this->builder->orderBy('name');
        }
        if ($filter == 'name-z-a') {
            return $this->builder->orderBy('name', 'desc');
        }
    }
}
