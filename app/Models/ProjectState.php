<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectState extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ps_project_state';
    protected $fillable = [
        'ps_id',
        'p_id',
        's_id',
        'ps_created_by',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the project_state associated with the ProjectState
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project_state()
    {
        return $this->hasOne(State::class, 's_id', 's_id');
    }
}
