<?php

namespace App\Contracts\Filter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter implements FilterInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Builder $builder
     */

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->fields() as $field => $value) {
            if (method_exists($this, $field)) {
                call_user_func_array([$this, $field], (array)$value);
            }
        }
    }

    /**
     * @return array
     */
    public function fields(): array
    {
        return array_filter(
            array_map('trim', $this->request->all())
        );
    }

}
