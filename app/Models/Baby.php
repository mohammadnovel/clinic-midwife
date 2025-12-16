<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Baby extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = ['id'];

    protected $casts = [
        'birth_time' => 'datetime', // or string H:i
    ];

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id'); // Mother
    }
}
