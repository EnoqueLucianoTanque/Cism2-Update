<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Funder extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'f_name',
        'created_at',
        'updated_at',
        'f_created_by',
        'f_state',
        'f_updated_by'
    ];

    protected $table = 'f_funders';
}
