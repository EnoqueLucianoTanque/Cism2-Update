<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'users';

    protected $fillable = [
        'u_id',
        'ui_id',
        'id',
        's_id',
        'r_id',
        'username',
        'email',
        'password',
        'email_verified_at',
        'state'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function staff()
    {
        return $this->hasOne(Staff::class, 's_id', 's_id');
    }
    /**
     * Get the user associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function roles()
    {
        return $this->belongsTo(Roles::class, 'r_id', 'r_id');
    }
    public function hasRole($role){
        return null !== $this->roles()->where('r_id', $role)->first();
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function staff_contacts()
    {
        return $this->belongsTo(StaffContact::class, 'u_id', 'u_id');
    }

    /**
     * Get the user associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user_external_institution()
    {
        return $this->hasOne(UserInstitution::class, 'ui_id', 'ui_id');
    }
}
