<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'amount',
        'payment_date',
        'payment_method',
        'status'
    ];

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
}