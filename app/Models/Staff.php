<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization',
        'bio',
        'hired_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }
}
