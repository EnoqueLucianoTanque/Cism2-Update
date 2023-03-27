<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectVideo extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pv_project_video';
    protected $fillable = [
        'pv_id',
        'p_id',
        'pv_title',
        'pv_mime_type',
        'pv_video_path',
        'created_at',
        'updated_at'
    ];
}
