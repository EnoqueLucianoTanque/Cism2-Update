<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchArea extends Model
{
    use HasFactory;
    protected $table = 'sa_search_area';

    protected $fillable = [
        'sa_name',
        'sa_created_by',
        'sa_updated_by',
        'deleted_at',
        'created_at',
        'sa_id'
    ];


}
