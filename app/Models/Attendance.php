<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
protected $table = 'attendance';
    protected $fillable = [
        'child_id', 'date', 'status', 'check_in_time', 'check_out_time'
    ];

    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id');
    }
}