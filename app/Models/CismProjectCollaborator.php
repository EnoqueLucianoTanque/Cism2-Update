<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CismProjectCollaborator extends Model
{
    use HasFactory;
    protected $table = 'cpc_cism_project_collaborator';
    protected $fillable= [
        'p_id',
        'cpc_id',
        'cpc_cism_collaborator_id',
        'cpc_created_by',
        'cpc_updated_by',
        'deleted_at',
        'created_at'
    ];

    /**
     * The project_user_collaborator that belong to the CismProjectCollaborator
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cism_collaborator()
    {
        return $this->belongsTo(User::class, 'cpc_cism_collaborator_id', 'u_id')->with('staff');
    }

}
