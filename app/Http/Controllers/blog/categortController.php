<?php

namespace App\Http\Controllers\blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\blogcategory;
use App\Http\Controllers\ApiResponseTrait;

class categortController extends Controller
{
    use ApiResponseTrait;
    public function index()
	{

    $category = blogcategory::all();
    return $this->ApiResponse($category,200);
   }
   
    
}
