<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffContact extends Model
{
    use HasFactory;
    protected $table = 'sc_staff_contact';

    protected $fillable = [
        'sc_id',
        'sc_created_by',
        'sc_contact',
        'u_id',
        'sc_updated_by',

    ];
}
