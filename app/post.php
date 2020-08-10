<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    protected $fillable =
       [
        'description', 'user_id' 
        ];

      public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function comments()
   {
	return $this->hasMany(comment::Class,'post_id');
   }
}
