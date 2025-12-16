<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait GeneratesCode
{
    public static function bootGeneratesCode()
    {
        static::creating(function ($model) {
            $column = $model->codeColumn ?? 'code';
            $prefix = $model->codePrefix ?? 'TRX-';

            if (empty($model->{$column})) {
                $latest = static::latest('id')->first();
                $number = $latest ? intval(substr($latest->{$column}, strlen($prefix))) + 1 : 1;
                $model->{$column} = $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
