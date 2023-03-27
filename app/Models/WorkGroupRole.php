<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkGroupRole extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'wgr_work_group_role';

    protected $fillable = [
        'wgr_id',
        'wgr_name',
        'wgr_description',
        'wgr_start_date',
        'wgr_created_by',
        'wgr_updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
