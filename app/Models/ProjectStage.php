<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStage extends Model
{
    use HasFactory;
    protected $table = 'ps_project_stage';
    protected $fillable = [
        'ps_name', 'ps_description', 'ps_id'
    ];
}
