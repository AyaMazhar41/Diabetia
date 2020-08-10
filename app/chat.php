<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chat extends Model
{
     protected $fillable =
       [
        'message', 'user_id' ,'doctor_id'
        ];
        public function doctor()
    {
        return $this->belongsTo(doctor::class,'doctor_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
