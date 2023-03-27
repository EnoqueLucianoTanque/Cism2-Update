<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkGroupProject extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'wgp_work_group_project';
    protected $primaryKey = 'row_id';
    protected $fillable = [
        'wgp_id',
        'wgp_name',
        'wgp_description',
        'wgp_start_date',
        'p_id',
        'wgp_created_by',
        'wgp_updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function work_group_member()
    {
        return $this->hasMany(WorkGroupMember::class, 'wgp_id', 'wgp_id')->with('member_roles','staff');
    }
}
