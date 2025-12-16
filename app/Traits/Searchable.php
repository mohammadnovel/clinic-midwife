<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    public function scopeSearch(Builder $query, string $term = null)
    {
        if (!$term) {
            return $query;
        }

        $fields = $this->searchable ?? [];

        $query->where(function ($q) use ($term, $fields) {
            foreach ($fields as $field) {
                $q->orWhere($field, 'like', "%{$term}%");
            }
        });

        return $query;
    }
}
