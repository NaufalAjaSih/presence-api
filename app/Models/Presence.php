<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'check_in',
        'check_out',
        'description',
        'latitude',
        'longitude',
        'attendance_status',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
