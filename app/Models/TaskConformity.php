<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskConformity extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tc_task_conformities';
    protected $fillable = [
        'tc_id',
        't_id',
        'c_id',
        'tc_created_by',
        'tc_updated_by',
        'created_at',
        'updated_at',
    ];

    protected $primaryKey = 'tc_id';

//     /**
//      * The task_conformities that belong to the TaskConformity
//      *
//      * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
//      */
//     public function task_conformities()
//     {
//         return $this->belongsToMany(Role::class, 'role_user_table', 'user_id', 'role_id');
//     }
}
