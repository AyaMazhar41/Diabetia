<?php

namespace App\Http\Controllers\community;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiResponseTrait;
use App\User;
use App\comment;
use App\post;
class commentController extends Controller
{
     use ApiResponseTrait;
	public function index()
	{

    $comment = comment::With('User:id,name,image')->get();
  
    return $this->ApiResponse($comment,200);
   }

   public function create(Request $request,$post_id)
	{

    $post = Post::findOrFail($post_id);
		 $comment = comment::create([
		 	'user_id' =>auth('api')->user()->id,
		 	'post_id' =>$post->id,
		 	//'post_id' => Post::find($request->get('post_id')),
		 	'comment' =>$request->comment
		 ]
		 );
   
    return $this->ApiResponse($comment,200);
   }

   public function destroy($id)
    {
        $comment=comment::find($id);
        if($comment)
        {
            $comment->delete();
             return response()->json(['Message'=>'deleted successfully']);
        }

      return $this->ApiResponse(null , 'sorry we not found it');
}
}
