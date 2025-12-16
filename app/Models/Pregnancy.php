<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Pregnancy extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = ['id'];

    protected $casts = [
        'hpht' => 'date',
        'hpl' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function ancVisits()
    {
        return $this->hasMany(AncVisit::class);
    }

    public function deliveries()
    {
        return $this->hasOne(Delivery::class);
    }
}
