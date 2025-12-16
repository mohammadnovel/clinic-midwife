<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class FamilyPlanning extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = ['id'];

    protected $table = 'family_plannings';

    protected $casts = [
        'installation_date' => 'date',
        'next_visit_date' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
