<?php

namespace App\Services\Filters;

use App\Contracts\Filter\QueryFilter;

class UserFilterService extends QueryFilter
{
    public function userSearch(string $search)
    {
        return $this->builder->where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        });
    }

    public function userCategory(string $category)
    {
        return $this->builder->where(function ($query) use ($category) {
            $query->where('email', 'LIKE', '%' . $category . '%');
        });
    }

    public function UserFilter(string $filter)
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
