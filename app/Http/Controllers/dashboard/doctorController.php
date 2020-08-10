<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiResponseTrait;
use App\doctor;
class doctorController extends Controller
{
  use ApiResponseTrait;
public function index()
   {
    
    $doctor = doctor::all();
    return $this->ApiResponse($doctor,200);

    }

     public function store(Request $request)
    {
        $validator = Validator::make($request->all() ,
            [
             'name'=>'required|max:191|string',
    		'email'=>'required|email|max:191|string|unique:doctors',
    		
    		'image'=>'nullable|image|mimes:jpg,png,jpeg',
    		 'experience'=>'required|max:191|string',
    		
    		 'short_description'=>'string',
             'long_description'=>'string',
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
                $file   =   doctor::create([
                    'name'  =>$request->name,
                    'email'  =>$request->email,
                 
                    'image' => $nameimage,
                    'experience'  =>$request->experience,
                    
                    'short_description'  =>$request->short_description,
                    'long_description'  =>$request->long_description,
                    
                    

                ]);
            
               return $this->ApiResponse($file,201);
            }
         }
    	}


    }
     public function update(Request $request, $id)
    {
    	$doctorid=doctor::findOrFail($id);
    	$validator = Validator::make($request->all() ,
            [
              'name'=>'required|max:191|string',
    		'email'=>'required|email|max:191|string|unique:doctors',
    		
    		'image'=>'required|image|mimes:jpg,png,jpeg',
    		 'experience'=>'required|max:191|string',
    		 
    		 'short_description'=>'string',
             'long_description'=>'string',
            

            ]);
       

        if($validator->fails())
        {
            return $validator->errors();
        }
        if($file= $request->file('image'))
        {
            $nameimage =   time().time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/uploads',$nameimage);
            
             $doctorid->name=$request->name;
              $doctorid->email=$request->email;
              $doctorid->image= $nameimage;
              $doctorid->experience=$request->experience;
              $doctorid->short_description=$request->short_description;
              $doctorid->long_description=$request->long_description;
              $doctorid->save();
              return $this->ApiResponse($doctorid,201);



        }

    
        if(!$userid)
        {
             return $this->notfound();
        }

    }

     public function destroy($id)
    {
        $doctor=doctor::find($id);
        if(!$doctor)
        {
           
             return response()->json(['Message'=>' not found this doctor']);
        }
       
        $doctor->delete();
             return response()->json(['Message'=>'deleted successfully']);

    }


}
