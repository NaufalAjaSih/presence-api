<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date',
        'start_time',
        'end_time',
        'location',
    ];

    public function getFormattedDateAttribute()
    {
        return $this->date->format('Y-m-d');
    }

    public function getFormattedStartTimeAttribute()
    {
        return $this->start_time->format('H:i');
    }

    public function getFormattedEndTimeAttribute()
    {
        return $this->end_time->format('H:i');
    }
}
