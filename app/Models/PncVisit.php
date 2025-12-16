<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class PncVisit extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = ['id'];

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
