<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiResponseTrait;
use App\blogcategory;
class blogcategoryController extends Controller
{
	use ApiResponseTrait;
	public function index()
   {
    
    $category = blogcategory::all();
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
        
        $target_path=public_path().'/uploads/'.$nameimage;
        
            if($file->move($target_path, $nameimage)) {
               
                // save file name in the database
                $file   =   blogcategory::create([
                    'name'  =>$request->name,
                    'image' => $target_path
                ]);
            
                return $this->ApiResponse($file,201);
            }
        }
 
}

public function update(Request $request, $id)
    {
         $categoryblog=blogcategory::findOrFail($id);
        
        $validator = Validator::make($request->all() ,
            [
                'name'=>'required|max:191|string',
                'image'=>'required|image'
            ]);

        
        if($validator->fails())
        {
            return $validator->errors();
        }

        if($file= $request->file('image'))
        {
            $nameimage =   time().time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/uploads',$nameimage);
            $categoryblog->image= $nameimage;
             $categoryblog->name=$request->name;
              $categoryblog->save();
              return $this->ApiResponse($categoryblog,201);



        }

    
        if(!$categoryblog)
        {
             return $this->notfound();
        }

}

 public function destroy($id)
    {
        $categorydel=blogcategory::find($id);
        if($categorydel){
            $categorydel->delete();
             return response()->json(['Message'=>'deleted successfully']);
        }

      return $this->ApiResponse(null , 'sorry we not found it' ,404);
    }

   
}
