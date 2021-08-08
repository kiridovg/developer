<?php

namespace App\Filters;

use App\Models\Book;
use App\Models\Category;

class UserFilter extends QueryFilter
{
    public function search_field(string $search_string)
    {
        return $this->builder->where(function ($query) use ($search_string) {
            $query->where('name', 'LIKE', '%' . $search_string . '%');
        });
    }

    public function category_name(string $category)
    {
        return $this->builder->where(function ($query) use ($category) {
            $query->where('email', 'LIKE', '%' . $category . '%');
        });
    }

    public function filter_name(string $filter)
    {
        if ($filter == 'id') {
            return $this->builder->orderBy('id');
        }
        if ($filter == 'id-desc') {
            return $this->builder->orderBy('id', 'desc');
        }
        if ($filter == 'name-a-z') {
            return $this->builder->orderBy('name');
        }
        if ($filter == 'name-z-a') {
            return $this->builder->orderBy('name', 'desc');
        }
        if ($filter == 'email') {
            return $this->builder->orderBy('email');
        }
        if ($filter == 'email-desc') {
            return $this->builder->orderBy('email', 'desc');
        }
    }
}
