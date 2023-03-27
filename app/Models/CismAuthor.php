<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CismAuthor extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ca_cism_authors';
    protected $fillable = [
        'ca_id',
        'ca_name',
        'ca_state',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    
}
