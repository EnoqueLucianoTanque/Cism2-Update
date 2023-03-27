<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailProject extends Model
{
    use HasFactory;
    protected $table = 'ep_email_project';
    protected $fillable = [
        'ep_id',
        'p_id',
        'ep_email_user'
    ];
}
