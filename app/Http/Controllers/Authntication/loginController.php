<?php

namespace App\Http\Controllers\Authntication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\User;
use App\Http\Controllers\ApiResponseTrait;
class loginController extends Controller
{
	use ApiResponseTrait;
    public function login(Request $request)
{

	if(auth()->attempt(['email'=>$request->input('email'),
	'password'=>$request->input('password')]))
	{
		$user=auth()->user();
		$user->api_token = Str::random(60);
		$user->save();
	 return $this->ApiResponse($user,200);


	}
	return "check your information";
}


public function logout()
{

if(auth()->user())
{
$user=auth()->user();
$user->api_token = null;
$user->save();
return response()->json(['Message'=>'you are logged out']);
}
return response()->json(['Error'=>'something roang',
	'code' =>401,
	'status'=>401
]);
}
}