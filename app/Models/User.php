<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends \LaraSnap\LaravelAdmin\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function user_role() {
        return $this->hasOne(\App\Models\RoleUser::class);
    }
    public function userProfile(){
        return $this->hasOne('App\Models\UserProfile');
    }
    public function badge(){
        return $this->hasMany('App\Models\Backend\Badges\Badge');
    }
    public function assign_certificate() {
        return $this->hasOne(AssignCertificate::class,'user_id','id');
    }
}
