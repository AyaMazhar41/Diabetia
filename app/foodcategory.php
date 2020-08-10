<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class foodcategory extends Model
{
    protected $fillable =
       [
        'name', 'image' 
        ];

    public function foods()
   {
	return $this->hasMany(food::Class,'foodcategory_id');
   }
}
