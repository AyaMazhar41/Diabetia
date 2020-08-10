<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
     protected $fillable = 
	[
'title', 'description',  'blogcategory_id'
    ];
    public function blogCategory()
    {
        return $this->belongsTo(blogCategory::class,'blogcategory_id');
    }
}
