<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LinkProject extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lp_link_projects';
    protected $fillable = [
        'lp_id',
        'p_id',
        'lp_created_by',
        'lp_updated_by',
        'lp_name',
        'lp_magazine_name',
        'lp_details',
        'lp_state',
        'created_at',
        'lp_submitted_at',
        'updated_at',
    ];

    protected $primaryKey = 'lp_id';
}
