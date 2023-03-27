<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'r_roles';
    protected $primaryKey = 'row_id';
    protected $fillable = [
        'r_id',
        'r_name',
        'r_description',
        'r_start_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
