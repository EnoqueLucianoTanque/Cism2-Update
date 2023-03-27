<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conformity extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'c_conformity';
    protected $fillable = [
        'c_id',
        'c_description',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $primaryKey = 'c_id';
}
