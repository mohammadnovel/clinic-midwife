<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Referral extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = ['id'];

    protected $casts = [
        'referral_date' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function midwife()
    {
        return $this->belongsTo(Midwife::class, 'referred_by');
    }
}
