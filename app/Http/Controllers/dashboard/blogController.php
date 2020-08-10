<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiResponseTrait;
use App\blogcategory;
use App\blog;
class blogController extends Controller
{
    use ApiResponseTrait;
	public function index()
   {
    
    $blog = blog::With('blogcategory:id,name,image')->get();
    return $this->ApiResponse($blog,200);

   }

   public function store(Request $request)
    {
        $validator = Validator::make($request->all() ,
            [
                'title'=>'required|max:191|string',
                'description'=>'required|string',
                'blogcategory_id' => 'exists:blogcategories,id'
            ]);
       

        if($validator->fails())
        {
            return $validator->errors();
        }
        $blog= blog::create($request->all());

      if($blog)
      {
             return $this->ApiResponse($blog,201);
      }

      return $this->notfound();
    }


public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all() ,
            [
                 'title'=>'required|max:191|string',
                'description'=>'required|string',
                'blogcategory_id' => 'exists:blogcategories,id'
            ]);

        if($validator->fails()){
           return $validator->errors();
        }
        $blog=blog::findOrFail($id);
        $blog->update($request->all());
        if($blog)
        {
            return $this->ApiResponse($blog,201);
        }
       else
        {
             return $this->notfound();
        }

    }

     public function destroy($id)
    {
        $blog=blog::find($id);
        if($blog){
            $blog->delete();
             return $this->ApiResponse(null,200);
        }

      return $this->ApiResponse(null ,404, 'sorry we not found it' );
    }
}

