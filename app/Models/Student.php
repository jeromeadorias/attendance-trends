<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class, 'attendances');
    }
}
