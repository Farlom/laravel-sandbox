<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ShouldOrderByPrimaryKey
{
    protected static function bootShouldOrderByPrimaryKey()
    {
        static::addGlobalScope('order', function (Builder $builder) {
           $builder->orderBy((new static())->getKeyName(), 'asc');
        });
    }
}
