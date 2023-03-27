<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsortiumMemberProject extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'cmp_consortium_member_project';
    protected $fillable = [
        'cmp_id',
        'cmp_name',
        'p_id',
        'cmr_id',
        'cmp_created_by',
        'cmp_updated_by',
        'created_at',
        'updated_at'
    ];

    /**
     * Get all of the consortiumMemberProject fnsortiumMemberProject
     *
     * @return \Illuminate\Databquent\Relations\HasMany
     */
    public function consortiumMemberProject()
    {
        return $this->hasMany(ConsortiumMemberRole::class, 'cmr_id', 'cmr_id');
    }
}
