<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkGroupMember extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'wgm_work_group_member';
    protected $primaryKey = 'row_id';
    protected $fillable = [
        'wgm_id',
        'wgm_name',
        'wgm_description',
        'wgm_start_date',
        's_id',
        'wgp_id',
        'wgr_id',
        'wgm_created_by',
        'wgm_updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function staff()
    {
        return $this->hasOne(Staff::class, 's_id', 's_id');
    }
//    public function work_group_role()
//    {
//        return $this->hasOne(WorkGroupRole::class, 'wgr_id', 'wgr_id');
//    }
    public function member_roles()
    {
        return $this->hasMany(MemberRole::class, 'wgm_id', 'wgm_id')->with('member_role');
    }
}
