<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CismPartners extends Model
{
    use HasFactory;
    protected $table = 'cism_partners';
    protected $fillable = [
        'icon',
        'description',
        'link',
        'state',
    ];
}
