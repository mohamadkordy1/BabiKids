<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'child_id', 'created_by','created_at'
    ];

    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

