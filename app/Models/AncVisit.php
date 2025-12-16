<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class AncVisit extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = ['id'];

    public function pregnancy()
    {
        return $this->belongsTo(Pregnancy::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
