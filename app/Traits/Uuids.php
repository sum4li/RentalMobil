<?php

namespace App\Traits;
use Illuminate\Support\Str;

trait Uuids
{
    /**
     * Boot function from laravel.
     */
    protected static function bootUuids()
    {
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}
