<?php

namespace App\Http\Controllers\community;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiResponseTrait;
use App\User;
use App\comment;
use App\post;
use Illuminate\Support\Facades\Auth;
class postController extends Controller
{
    use ApiResponseTrait;
	public function index()
	{

    $post = post::With('User:id,name,image','comments')->WithCount('user')->get();
    

    
    //$post3=$post2->user()->count();
    return $this->ApiResponse($post,200);
   }
public function create(Request $request)
	{

   // $post = post::create($request->all());
		 $post = post::create([
		 	'user_id' =>auth('api')->user()->id,
		 	'description' =>$request->description
		 ]
		 );
   
    return $this->ApiResponse($post,200);
   }

 public function destroy($id)
    {
        $post=post::find($id);
        if($post)
        {
            $post->delete();
             return response()->json(['Message'=>'deleted successfully']);
        }

      return $this->ApiResponse(null , 'sorry we not found it');
}
}
