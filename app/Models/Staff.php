<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 's_staff';

    protected $fillable = [
        's_id',
        's_name',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Get the cism_staff ad with the Staff
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cism_staff()
    {
        return $this->hasOne(User::class, 's_id', 's_id')->with('user_external_institution');
    }

    /**
     * Get the staff_user associated with the Staff
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function staff_user()
    {
        return $this->hasOne(User::class, 's_id', 's_id');
    }
}
