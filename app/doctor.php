<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doctor extends Model
{
     protected $fillable = [
        'name', 'email','image','experience','short_description','long_description' ];
      public function user()
   {
    return $this->hasMany(User::Class,'doctor_id');
   }
   public function reviews()
    {
        return $this->hasMany(Review::class,'doctor_id');
    }
    public function chats()
    {
        return $this->hasMany(chat::class,'doctor_id');
    }
}
