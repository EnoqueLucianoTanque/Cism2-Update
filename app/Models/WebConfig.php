<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebConfig extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome',
        'wc_description',
        'wt_id',
        'wc_id',
    ];

    protected $table = 'wc_web_config';
}
