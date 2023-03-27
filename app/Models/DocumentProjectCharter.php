<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentProjectCharter extends Model
{
    use HasFactory;
    protected $table = 'dpc_document_project_charters';
    protected $fillable = [
        'dpc_id',
        'pc_id',
        'dpc_description',
        'dpc_path',
        'created_at',
        'updated_at'
    ];
}
