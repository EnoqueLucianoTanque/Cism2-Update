<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectConformity extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pc_project_conformities';
    protected $fillable = [
        'pc_id',
        'p_id',
        'c_id',
        'pc_created_by',
        'pc_updated_by',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the user that owns the ProjectConformity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project_conformities() 
    {
        return $this->belongsToMany(Conformity::class, 'pc_project_conformities', 'c_id', 'p_id');
    }

    /**
     * Get the user associated with the ProjectConformity
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user_created()
    {
        return $this->hasOne(User::class, 'u_id', 'pc_created_by')->with("staff");
    }
}
