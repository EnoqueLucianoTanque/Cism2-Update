<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectExternalState extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pes_project_external_state';
    protected $fillable = [
        'pes_id',
        'p_id',
        'ecs_id',
        'pes_updated_by',
        'pes_created_by',
        'created_at',
        'updated_at',
        'pes_document_path',
    ];
}
