<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberRole extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'mr_member_role';
    protected $primaryKey = 'row_id';
    protected $fillable = [
        'mr_id',
        'mr_start_date',
        'wgm_id',
        'wgr_id',
        'mr_created_by',
        'mr_updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Get all of the comments for the MemberRole
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function member_role()
    {
        return $this->hasMany(WorkGroupRole::class, 'wgr_id', 'wgr_id');
    }
}
