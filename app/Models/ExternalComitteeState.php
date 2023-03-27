<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalComitteeState extends Model
{
    use HasFactory;
    protected $table = 'ecs_external_committee_states';
    protected $fillable = [
        'ecs_id',
        'ecs_name',
    ];
}
