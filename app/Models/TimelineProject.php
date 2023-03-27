<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimelineProject extends Model
{
    use HasFactory;
    protected $table = 'tp_timeline_project';
    protected $fillable = [
        'p_id',
        'tp_start_at',
        'tp_end_date',
        'tp_created_by',
        'tp_updated_by',
        'tp_id'
    ];

    /**
     * Get the projectTimeline ad with the TimelineProject
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function projectTimeline()
    {
        return $this->hasOne(Project::class, 'p_id', 'p_id');
    }
}
