<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;
use App\Traits\Searchable;

class Patient extends Model
{
    use HasFactory, HasUuid, Searchable;

    protected $guarded = [];

    protected $searchable = ['name', 'nik', 'phone', 'bpjs_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pregnancies()
    {
        return $this->hasMany(Pregnancy::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
