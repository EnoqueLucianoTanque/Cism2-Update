<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'f_file';
    protected $primaryKey = 'row_id';
    protected $fillable = [
        'f_id',
        'f_description',
        'f_name',
        'f_path',
        'f_start_date',
        't_id',
        'a_id',
        'st_id',
        'f_created_by',
        'f_updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
