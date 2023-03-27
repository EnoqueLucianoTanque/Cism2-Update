<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskMember extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tm_task_member';
    protected $primaryKey = 'row_id';
    protected $fillable = [
        'tm_id',
        'tm_start_date',
        't_id',
        's_id',
        'st_id',
        'tm_created_by',
        'tm_updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function staff()
    {
        return $this->hasMany(Staff::class, 's_id', 's_id');
    }
}
