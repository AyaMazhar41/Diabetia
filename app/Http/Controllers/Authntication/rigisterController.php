<?php

namespace App\Http\Controllers\Authntication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Http\Controllers\ApiResponseTrait;
class rigisterController extends Controller
{
    use ApiResponseTrait;
    public function register(Request $request)
	 {
	 	
	 	$validator =Validator::make($request->all(),
	 		[
    		'name'=>'required|max:191|string',
    		'email'=>'required|email|max:191|string|unique:users',
    		'phone'=>'required|string|max:191|unique:users',
    		'password'=>'required|min:8|string',
    		'image'=>'nullable|image|mimes:jpg,png,jpeg',
    		'age' => 'required|string|max:191',
    		'weight' => 'required|max:191',
            'length' => 'required|max:191',
            'blood_pressure' =>'required|string|max:191',
            'type_diabetes'=>'required|string|in:A,B',
            'type_treatment'=>'required|string|in:pills,injection',
            'doctor_id'=>'nullable|string'



    		


    	]);
    	if($validator->fails())
    	{
    		return $validator->errors();
    	}
    	else
    	{
    		if($file = $request->file('image')) {

        $nameimage =   time().time().'.'.$file->getClientOriginalExtension();
        
        $target_path=public_path('/uploads');
        
            if($file->move($target_path, $nameimage)) {
               
                // save file name in the database
                $file   =   User::create([
                    'name'  =>$request->name,
                    'email'  =>$request->email,
                    'phone'  =>$request->phone,
                   'password'=>Hash::make($request->password),
                    'image' => $nameimage,
                    'age'  =>$request->age,
                    'weight'  =>$request->weight,
                    'length'  =>$request->length,
                    'blood_pressure'  =>$request->blood_pressure,
                     'is_active'=>1,
                    'type_diabetes'  =>$request->type_diabetes,
                    'type_treatment'  =>$request->type_treatment,
                    'api_token'=>Str::random(60),
                    'role'=>'user',
                 'doctor_id'  =>$request->doctor_id,


                ]);
            
               return $this->ApiResponse($file,201);
            }
         }
    	}



	 }

}
