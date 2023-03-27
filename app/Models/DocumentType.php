<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;
    protected $table = 'dt_document_type';
    protected $fillable = [
        'dt_id',
        'dt_name',
        'dt_description'
    ];
}
