<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'teacher_id',
        'activities_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activities_id');
    }

    public function children()
    {
        return $this->belongsToMany(Child::class, 'child_class');
    }
}
