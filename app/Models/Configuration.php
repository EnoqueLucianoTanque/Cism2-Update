<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class Configuration extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'configuration';
    protected $fillable = [
        'name',
        'description',
        'value',
        'type',
    ];

    public static function getConfigurationType($type)
    {
        $value = DB::table('configuration')->where('type', $type)->first();
        // dd($value->value);
        return $value->value;
    }

    
}
