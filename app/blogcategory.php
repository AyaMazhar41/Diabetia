<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blogcategory extends Model
{
      protected $fillable =
       [
        'name', 'image' 
        ];

         public function blogs()
   {
	return $this->hasMany(blog::Class,'blogcategory_id');
   }
}
