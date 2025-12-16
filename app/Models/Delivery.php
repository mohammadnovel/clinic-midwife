<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Delivery extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = ['id'];

    protected $casts = [
        'delivery_time' => 'datetime',
    ];

    public function pregnancy()
    {
        return $this->belongsTo(Pregnancy::class);
    }

    public function baby()
    {
        return $this->hasOne(Baby::class);
    }
}
