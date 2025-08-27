<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Child extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'children'; // Keep plural table name

    protected $fillable = [
        'name',
        'date_of_birth',
        'gender',
        'parent_id'
    ];

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function progress()
    {
        return $this->hasMany(Progress::class, 'child_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'child_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'child_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'child_id');
    }
}