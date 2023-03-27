<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentProject extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'dp_document_project';
    protected $fillable = [
        'dp_id', 'dt_id', 'p_id' ,'psm_id', 'dp_name',
        'dp_description', 'dp_local_path'
    ];
    protected $primaryKey = 'row_id';


    /**
     * Get the document_type associated with the DocumentProject
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function document_type()
    {
        return $this->hasOne(DocumentType::class, 'dt_id', 'dt_id');
    }
}
