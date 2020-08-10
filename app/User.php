<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','phone','password','image','gender','age','weight','length','blood_pressure','is_active','type_diabetes','type_treatment','role','api_token','doctor_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     public function posts()
   {
    return $this->hasMany(post::Class,'user_id');
   }
    public function comments()
   {
    return $this->hasMany(comment::Class,'user_id');
   }
    public function doctors()
    {
        return $this->belongsTo(doctor::class,'doctor_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class,'user_id');
    }
     public function chats()
    {
        return $this->hasMany(chat::class,'user_id');
    }
}
