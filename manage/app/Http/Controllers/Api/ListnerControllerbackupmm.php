<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Listner;
use App\Models\Registration;


class ListnerController extends Controller
{
	
	public function show_Listner(Request $request, $id)
    {
          $data = Registration::where('id', $id)->where('user_type', 'listner')->get();
	      
		  if($data){
			
		
		return response()->json([
		       'status' => true,
			   'message' => 'Data retrive successfull',
			   'data' => $data,
			]);
			 
			 }else{
				 
			   return response()->json([
		       'status' => false,
			   'message' => 'Data not retrive',
			   'data' => null,
			], 400);
       }
    }
       
	
	
	 public function show_allListner(Request $request)
    {
        $data = Registration::where('user_type', 'listner')->get();
		 
		  if($data){
		return response()->json([
		       'status' => true,
			   'message' => 'Data retrive successfull',
			   'data' => $data,
			]);
		  }else{
			  return response()->json([
		       'status' => false,
			   'message' => 'Data not retrive',
			   'data' => null,
			], 400);
		  }
    }
}
