<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class food extends Model
{
    protected $fillable = 
	[
'name', 'calories', 'sugar', 'foodcategory_id','grams'
    ];
    public function foodCategory()
    {
        return $this->belongsTo(foodcategory::class,'foodcategory_id');
    }
}
