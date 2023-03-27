<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskComment extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tc_task_comment';
    protected $primaryKey = 'row_id';
    protected $fillable = [
        'tc_id',
        'tc_description',
        'tc_start_date',
        't_id',
        'st_id',
        's_id',
        'tc_created_by',
        'tc_updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
