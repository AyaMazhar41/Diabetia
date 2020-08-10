<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ApiResponseTrait;
use App\User;

class userController extends Controller
{
	use ApiResponseTrait;
public function index()
   {
    
    $user = User::all();
    return $this->ApiResponse($user,200);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all() ,
            [
             'name'=>'required|max:191|string',
    		'email'=>'required|email|max:191|string|unique:users',
    		'phone'=>'required|string|max:191|unique:users',
    		'password'=>'required|min:8|string',
    		'image'=>'nullable|image|mimes:jpg,png,jpeg',
    		'age' => 'required|string|max:191',
    		'weight' => 'required|max:191',
            'length' => 'required|max:191',
            
            'is_active' =>'required|boolean',
            'type_diabetes'=>'required|string|in:A,B',
           
            'type_treatment'=>'required|string|in:pills,injection',
            'role'=>'required|string|in:user,admin',
            'blood_pressure' =>'required|string|max:191',
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
                    
                     'is_active'=>$request->is_active,
                    'type_diabetes'  =>$request->type_diabetes,
                    'type_treatment'  =>$request->type_treatment,
                    'api_token'=>Str::random(60),
                    'role'=>$request->role,
                    'blood_pressure'  =>$request->blood_pressure,
                    'doctor_id'=>$request->doctor_id,

                ]);
            
               return $this->ApiResponse($file,201);
            }
         }
    	}


    }



    public function update(Request $request, $id)
    {
    	$userid=User::findOrFail($id);
    	$validator = Validator::make($request->all() ,
            [
             'name'=>'required|max:191|string',
    		'email'=>'required|email|max:191|string|unique:users,id',
    		'phone'=>'required|string|max:191|unique:users,id',
    		'password'=>'required|min:8|string',
    		'image'=>'required|image|mimes:jpg,png,jpeg',
    		'age' => 'required|string|max:191',
    		'weight' => 'required|max:191',
            'length' => 'required|max:191',
            
            'is_active' =>'required|boolean',
            'type_diabetes'=>'required|string|in:A,B',
           
            'type_treatment'=>'required|string|in:pills,injection',
            'role'=>'required|string|in:user,admin',
            'blood_pressure' =>'required|string|max:191',
            'doctor_id'=>'nullable|string'

            ]);
       

        if($validator->fails())
        {
            return $validator->errors();
        }
        if($file= $request->file('image'))
        {
            $nameimage =   time().time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/uploads',$nameimage);
            
             $userid->name=$request->name;
              $userid->email=$request->email;
              $userid->phone=$request->phone;

              $userid->password=Hash::make($request->password);
              $userid->image= $nameimage;
              $userid->age=$request->age;
              $userid->weight=$request->weight;
              $userid->length=$request->length;
              $userid->is_active=$request->is_active;
              $userid->type_diabetes=$request->type_diabetes;
               $userid->type_treatment=$request->type_treatment;
                $userid->role=$request->role;
                 $userid->blood_pressure=$request->blood_pressure;
                 $userid->doctor_id=$request->doctor_id;

              $userid->save();
              return $this->ApiResponse($userid,201);



        }

    
        if(!$userid)
        {
             return $this->notfound();
        }

    }


    public function destroy($id)
    {
        $user=User::find($id);
        if(!$user)
        {
           
             return response()->json(['Message'=>' not found this user']);
        }
       
        $user->delete();
             return response()->json(['Message'=>'deleted successfully']);

    }

}
