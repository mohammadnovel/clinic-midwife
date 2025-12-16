<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Appointment extends Model
{
    use HasUuid;

    protected $guarded = [];

    protected $casts = [
        'appointment_date' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function midwife()
    {
        return $this->belongsTo(Midwife::class);
    }
}
