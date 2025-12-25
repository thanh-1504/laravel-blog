<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\UserStatus;
use App\UserType;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'email',
        'password',
        "bio",
        "status",
        "username",
        "picture",
        "type"
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
        'password' => 'hashed',
        "status" => UserStatus::class,
        "type" => UserType::class
    ];

    function getPictureAttribute($value) {
        return $value ? asset("images/users/". $value) : asset("images/users/default-user.jfif");
    }

    function getTypeAttribute($value) {
        return $value;
    }


    function posts() {
        return $this->hasMany(Post::class,"author_id","id");
    }
}
