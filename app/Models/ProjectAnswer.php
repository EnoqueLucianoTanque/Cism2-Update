<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAnswer extends Model
{
    use HasFactory;
    protected $table = 'pa_project_answers';
    protected $fillable = [
        'pa_id',
        'pa_answer',
        'pq_id',
        'p_id',
        'deleted_at'
    ];
}
