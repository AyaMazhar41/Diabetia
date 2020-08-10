<?php

namespace App\Http\Controllers\food;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\food;
use App\foodcategory;
use App\Http\Controllers\ApiResponseTrait;
class foodController extends Controller
{
     use ApiResponseTrait;
	public function index()
	{

    $food = food::With('foodcategory:id,name,image')->get();
    return $this->ApiResponse($food,200);
   }
}
