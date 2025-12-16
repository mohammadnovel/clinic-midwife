<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class PracticeSchedule extends Model
{
    use HasUuid;

    protected $guarded = [];

    protected $casts = [
        'start_time' => 'string', // or time
        'end_time' => 'string',
    ];

    public function midwife()
    {
        return $this->belongsTo(Midwife::class);
    }
}
