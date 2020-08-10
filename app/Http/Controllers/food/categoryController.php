<?php

namespace App\Http\Controllers\food;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\foodcategory;
use App\Http\Controllers\ApiResponseTrait;
class categoryController extends Controller
{
     use ApiResponseTrait;
    public function index()
	{

    $category = foodcategory::all();
    return $this->ApiResponse($category,200);
   }
}
