<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInstitution extends Model
{
    use HasFactory;
    protected $table = 'ui_user_institution';
    protected $fillable = [
        'ui_id',
        'ui_description',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
