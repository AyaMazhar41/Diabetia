<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\post;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiResponseTrait;


class profileController extends Controller
{
use ApiResponseTrait;
public function index()
{
	$user=User::select('name','image','email','age','type_diabetes')->where('id',auth('api')->user()->id )->get();
	
$post = post::With('User:id,name,image','comments')->WithCount('user')->where('user_id',auth('api')->user()->id )->get();
   return $this->ApiResponse([$user,$post],200);

}

public function create(Request $request)
	{

		 $post = post::create([
		 	'user_id' =>auth('api')->user()->id,
		 	'description' =>$request->description
		 ]
		 );
   
    return $this->ApiResponse($post,200);
   }

}
