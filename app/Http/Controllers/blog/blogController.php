<?php

namespace App\Http\Controllers\blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\blog;
use App\blogcategory;
use App\Http\Controllers\ApiResponseTrait;
class blogController extends Controller
{
     use ApiResponseTrait;
	public function index()
	{

    $blog = blog::With('blogcategory:id,name,image')->get();
    return $this->ApiResponse($blog,200);
   }
}
