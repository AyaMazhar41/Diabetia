<?php
namespace App\Http\Controllers;
trait ApiResponseTrait
{


	public function ApiResponse($data = null  ,$code=200, $error = null)
		{
			$array =[
				'data'=>$data ,
				'status'=> in_array($code, $this->successCode()) ? true : false ,
				'error' =>$error

			];
			return response($array , $code);

	    }
	    public function successCode(){
	    	return [200 ,201,202];
	    	
	    }
	    public function notfound(){
	    	return $this->ApiResponse(null , 'sorry we not found it' ,404);
	    }

}