<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasUuid;

class Service extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = [];
}
