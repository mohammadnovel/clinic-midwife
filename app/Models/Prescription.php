<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Prescription extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = ['id'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
