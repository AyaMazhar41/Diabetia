<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiResponseTrait;
use App\foodcategory;
use App\food;

class foodController extends Controller
{
    use ApiResponseTrait;
	public function index()
   {
    
    $food = food::With('foodcategory:id,name,image')->get();
    return $this->ApiResponse($food,200);

   }

   public function store(Request $request)
    {
        $validator = Validator::make($request->all() ,
            [
                'name'=>'required|max:191|string',
                'calories'=>'required|max:191|string',
                'sugar'=>'required|max:191|string',
                
                'foodcategory_id' => 'exists:foodcategories,id',
                'grams'=>'required|max:191|string'
            ]);
       

        if($validator->fails())
        {
            return $validator->errors();
        }
        $food= food::create($request->all());

      if($food)
      {
             return $this->ApiResponse($food,201);
      }

      return $this->notfound();
    }

    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all() ,
            [
                 'name'=>'required|max:191|string',
                'calories'=>'required|max:191|string',
                'sugar'=>'required|max:191|string',

                'foodcategory_id' => 'exists:foodcategories,id',
                'grams'=>'required|max:191|string'
            ]);

        if($validator->fails()){
           return $validator->errors();
        }
        $food=food::findOrFail($id);
        $food->update($request->all());
        if($food)
        {
            return $this->ApiResponse($food,201);
        }
       else
        {
             return $this->notfound();
        }

    }

     public function destroy($id)
    {
        $food=food::find($id);
        if($food){
            $food->delete();
             return $this->ApiResponse(null,200);
        }

      return $this->ApiResponse(null ,404, 'sorry we not found it' );
    }
}

