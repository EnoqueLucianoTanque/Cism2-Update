<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Config extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'c_config';
    protected $primaryKey = 'row_id';
    protected $fillable = [
        'c_id',
        'c_name',
        'c_value',
        'c_type',
        'c_description',
        'c_start_date',
        'c_created_by',
        'c_updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    

}
