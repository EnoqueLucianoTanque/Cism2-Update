<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectQuestion extends Model
{
    use HasFactory;
    protected $table = 'pq_project_questions';
    protected $fillable = [
        'pq_id',
        'pq_description',
        'deleted_at',
        'created_at',
        'updated_at',
        'id'
    ];
}
