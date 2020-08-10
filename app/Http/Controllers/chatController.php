<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiResponseTrait;
use App\User;
use App\doctor;
use App\chat;
class chatController extends Controller
{
	use ApiResponseTrait;
    public function index()
{
	
$chat = chat::With('User:id,name,image','doctor:id,name,image')->get();
   return $this->ApiResponse($chat,200);

}

 public function create(Request $request,$doctor_id)
	{

    $doctor = doctor::findOrFail($doctor_id);
		 $chat = chat::create([
		 	'user_id' =>auth('api')->user()->id,
		 	'doctor_id' =>$doctor->id,
		 	
		 	'message' =>$request->message
		 ]
		 );
   
    return $this->ApiResponse($chat,200);
   }
}
