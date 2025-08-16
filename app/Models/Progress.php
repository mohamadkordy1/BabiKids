<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id', 'goal_title', 'start_date', 'target_date', 'status', 'notes'
    ];

    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id');
    }
}