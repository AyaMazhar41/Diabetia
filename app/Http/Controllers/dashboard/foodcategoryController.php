<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiResponseTrait;
use App\foodcategory;
class foodcategoryController extends Controller
{
    	use ApiResponseTrait;
   public function index()
   {
    
    $category = foodcategory::all();
   return $this->ApiResponse($category,200);

   }
   public function store(Request $request)
    {
        $validator = Validator::make($request->all() ,
            [
                'name'=>'required|max:191|string',
                'image'=>'nullable|image|mimes:jpg,png,jpeg'
            ]);
       

        if($validator->fails())
        {
            return $validator->errors();
        }

        if($file = $request->file('image')) {

        $nameimage =   time().time().'.'.$file->getClientOriginalExtension();
        
        $target_path=public_path('/uploads');
        
            if($file->move($target_path, $nameimage)) {
               
                // save file name in the database
                $file   =   foodcategory::create([
                    'name'  =>$request->name,
                    'image' => $nameimage
                ]);
            
                return $this->ApiResponse($file,201);
            }
        }
 
}

public function update(Request $request, $id)
    {
         $categoryfood=foodcategory::findOrFail($id);
        
        $validator = Validator::make($request->all() ,
            [
                'name'=>'required|max:191|string',
                'image'=>'required|image|mimes:jpg,png,jpeg'
            ]);

        
        if($validator->fails())
        {
            return $validator->errors();
        }

        if($file= $request->file('image'))
        {
            $nameimage =   time().time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/uploads',$nameimage);
            $categoryfood->image= $nameimage;
             $categoryfood->name=$request->name;
              $categoryfood->save();
              return $this->ApiResponse($categoryfood,201);



        }

    
        if(!$categoryfood)
        {
             return $this->notfound();
        }

}

 public function destroy($id)
    {
        $categorydel=foodcategory::find($id);
        if($categorydel){
            $categorydel->delete();
             return response()->json(['Message'=>'deleted successfully']);
        }

      return $this->ApiResponse(null , 'sorry we not found it' ,404);
    }

}
