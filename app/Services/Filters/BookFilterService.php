<?php

namespace App\Services\Filters;

use App\Contracts\Filter\QueryFilter;

class BookFilterService extends QueryFilter
{
    public function bookSearch(string $search)
    {
        return $this->builder->where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%');
        });
    }

    public function bookCategory(string $category)
    {
        return $this->builder -> whereHas('categories', function ($query) use ($category) {
            $query->where('categories.name', $category);
        });
    }

    public function bookFilter(string $filter)
    {
        if ($filter == 'name-a-z') {
            return $this->builder->orderBy('name');
        }
        if ($filter == 'name-z-a') {
            return $this->builder->orderBy('name', 'desc');
        }
    }
}
