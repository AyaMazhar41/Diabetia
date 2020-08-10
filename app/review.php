<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
     protected $fillable = ['rate','doctor_id','user_id'];

public function doctor()
    {
        return $this->belongsTo(doctor::class,'doctor_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}