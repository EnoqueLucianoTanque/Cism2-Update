<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubTask extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'st_sub_task';
    protected $primaryKey = 'row_id';
    protected $fillable = [
        'st_id',
        'st_name',
        'st_description',
        'st_start_date',
        't_id',
        'st_state',
        'st_start_date',
        'st_final_date',
        'st_due_date',
        'st_created_by',
        'st_updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function members()
    {
        return $this->hasMany(TaskMember::class, 'st_id', 'st_id')->with('staff');
    }
}
