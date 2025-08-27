<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'child_id',
        'report_date',
        'report_type',
        'content',
        'created_by'
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