<?php

namespace App\Http\Controllers\doctors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiResponseTrait;
use App\doctor;
use App\review;
class doctorController extends Controller
{
	use ApiResponseTrait;

	public function show($id)
	{
	 $doctor_profile = doctor::findOrFail($id);
	 $name= $doctor_profile->name;
	 $email= $doctor_profile->email;
	 $image= $doctor_profile->image;
	 $experience= $doctor_profile->experience;
	 $appointments= $doctor_profile->user->count();
	 $follow= $doctor_profile->user->count();
	 $long_description= $doctor_profile->long_description;
	 $reviews=$doctor_profile->reviews()->avg('rate');





   return $this->ApiResponse( ['name'=>$name,'email'=>$email,'image'=>$image,'experience'=>$experience,'appointments'=>$appointments,'followers'=>$follow,'long_description'=>$long_description,'reviews'=>$reviews],200);
      /*$test = doctor::select('name')->where('id', $doctor_profile->id)->get();
       return $this->ApiResponse($test,200);*/

   if(!$doctor_profile)
   {
   	return response(['message'=>'not found the doctor']);
   }


	}
	public function index()
	{
		$doctors=doctor::select('name','image','short_description')->get();

		 return $this->ApiResponse($doctors,200);

	}

	


    
}
