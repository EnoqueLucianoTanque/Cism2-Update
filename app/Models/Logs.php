<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;
    protected $table = 'logs';
    protected $fillable = [
        'status',
        'ip_address',
        'user_id',
        'last_login',
        'created_at',
        'updated_at',
        'email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'u_id');
    }
    
}
