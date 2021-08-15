<?php

namespace App\Contracts\Filter;

use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    public function apply(Builder $builder);

    /**
     * @return array
     */
    public function fields(): array;
}
