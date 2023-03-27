<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipient extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'r_recipients';
    protected $fillable = [
        'r_id',
        'r_name',
        'r_updated_by',
        'r_created_by',
        // 'created_at',
        // 'updated_at',
    ];
}
