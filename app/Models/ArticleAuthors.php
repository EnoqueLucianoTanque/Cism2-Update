<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleAuthors extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'aa_article_authors';
    // protected $primary_key = 'aa_id';

    protected $fillable = [
        'row_id',
        'aa_id',
        'a_id',    
        'ca_id',    
        'created_at',    
        'updated_at',    
        'deleted_at',    
    ];
    public $timestamps = false;

    public function authors()
    {
        return $this->belongsTo(CismAuthor::class, 'ca_id', 'ca_id');
    }
    
}
