<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;
    protected $table = 'ac_article_category';
    protected $fillable = [
        'ac_id',
        'ac_description',
        'ac_created_by',
        'ac_updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
