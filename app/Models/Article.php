<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'a_article';
    protected $primaryKey = 'row_id';
    protected $fillable = [
        'a_id',
        'a_title',
        'a_start_date',
        'p_id',
        'sa_id',
        'a_link',
        'a_image',
        'a_document_path',
        'a_created_by',
        'a_updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
        'a_state'
    ];
    public function files()
    {
        return $this->hasMany(File::class, 'a_id', 'a_id');
    }
    public function task()
    {
        return $this->hasOne(Task::class, 't_id', 't_id')->with('files');
    }

    public function article_authors()
    {
        return $this->hasMany(ArticleAuthors::class, 'a_id', 'a_id')->with('authors');
        // return $this->belongsToMany(CismAuthor::class, 'aa_article_authors', 'a_id', 'ca_id');
    }
    /**
     * Get the get_article_by_investigator )d with the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function get_article_by_investigator()
    {
        return $this->hasOne(User::class, 'u_id', 'a_created_by')->with('staff', 'user_external_institution');
    }

    /**
     * Get the category associated with the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(SearchArea::class, 'sa_id', 'sa_id'); 
    }

    /**
     * Get the user associated with the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function articleByProject()
    {
        return $this->hasOne(Project::class, 'p_id', 'p_id');
    }


}
