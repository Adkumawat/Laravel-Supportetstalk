<?php

namespace App\Http\Controllers;

use App\Models\Registration;
//use App\Http\Requests\StoreRegistrationRequest;
//use App\Http\Requests\UpdateRegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Api\Nickname;
use App\Models\Api\Report;
use App\Models\Api\BellNotification;
use App\Models\Api\OnlineNotification;
//use Illuminate\Support\Facades\Notification;
use Notifiable;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Call;
use App\Models\Chat;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $store = Registration::where('user_type', 'user')->where('ac_delete', 0)->get();
		
		return response()->json([
		       'status' => true,
			   'message' => 'Data retrive successfull',
			   'data' => $store,
			]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRegistrationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $data = $request->validate([
			'mobile_no' => 'required',
			'device_token' => 'required',
			'helping_category' => 'nullable',
			'image' => 'nullable',
		]);
	
	//	print_r($request->device_token); die;
		
		$data['name'] = 'Anonymous';
		$data['user_type'] = 'user';
		$data['status'] = 1;
		$data['ac_delete'] = 0;
		
		$data['helping_category'] = $request->helping_category ?? NULL;
		$data['image'] = $request->image ?? NULL;
		$data['age'] = $request->age ?? NULL;
		$data['interest'] = $request->interest ?? NULL;
		$data['language'] = $request->language ?? NULL;
		$data['sex'] = $request->sex ?? NULL;
		$data['available_on'] = $request->available_on ?? NULL;
		$data['about'] = $request->about ?? NULL;
		$data['charge'] = $request->charge ?? NULL;
		
		$check_user = DB::table('registrations')->where('mobile_no', $request->mobile_no)->count(); 
		
		$check_ac = Registration::where('mobile_no', $request->mobile_no)->first(); 

	   if($check_user > 0){
	       
	       if($check_ac->ac_delete == 1){
	           
	           $data = DB::table('registrations')->where('mobile_no', $request->mobile_no)->update($data);
	              // 'ac_delete' => 0,
	              // 'helping_category'=>$request->helping_category,
	               //'device_token'=>$request->device_token
	              // ]);
	               
	           $user_ac = Registration::where('mobile_no', $request->mobile_no)->first(); 
	           
	           return response()->json([
		       'status' => true,
			   'message' => 'Registration successfull',
			   'data' =>  $user_ac,
			]);
			
	       }else{
	       
	       $data = DB::table('registrations')->where('mobile_no', $request->mobile_no)->update([
	           'device_token'=>$request->device_token
	           ]);
	       
		   // $data2 = DB::table('registrations')->select('*')->where('mobile_no', $request->mobile_no)->first(); 
		    
		    $data2 = Registration::where('mobile_no', $request->mobile_no)->first();
		    
				return response()->json([
				   'status' => true,
				   'message' => 'Login Succesfull',
				   'data' =>  $data2,
				]);
	   } } else {
		
		
		$store = Registration::create($data);
		
		return response()->json([
		       'status' => true,
			   'message' => 'Registration successfull',
			   'data' => $store,
			]);
    }
	 }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
         $store = Registration::where('id', $id)->where('user_type', 'user')->get();
		 
		  if(!$store->isEmpty()){
			
		
		return response()->json([
		       'status' => true,
			   'message' => 'Data retrive successfull',
			   'data' => $store,
			]);
			
		  }else{
			   return response()->json([
		       'status' => false,
			   'message' => 'Data not retrive',
			   'data' => null,
			], 400);
		  }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRegistrationRequest  $request
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		//echo "Hiii";
			//print_r($id);
			//die();
        $data = $request->validate([
           	'name' => 'required',
			'mobile_no' => 'required',
			'helping_category' => 'required',
			'image' => 'nullable',
		]);
		//echo "Hiii";
		 $store = Registration::find($id);
		 
		 if($store){
			 $store->update($data);
			 
			 return response()->json([
		       'status' => true,
			   'message' => 'Data updated successfull',
			   'data' => $store,
			]);
		 }else{
			 return response()->json([
		       'status' => false,
			   'message' => 'Data not updated',
			   'data' => null,
			], 400);
		 }
		
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //$store = Registration::find($id);
		 
		 //if($store){
		     //$store->delete();
		     
		     $data = DB::table('registrations')->where('id', $request->user_id)->update(['ac_delete'=>1]);
		     
		     $data_ac = DB::table('registrations')->where('id', $request->user_id)->first();
			 
			 if($data){
			 
			 return response()->json([
		       'status' => true,
			   'message' => 'Data deleted successfull',
			   'data' => $data_ac,
			]);
		 }else{
			 return response()->json([
		       'status' => false,
			   'message' => 'Data not found',
			]);
		 }
    }
	
public function add_listner(Request $request)
		{
			
			$data = $request->validate([
			'name' => 'required',
			'mobile_no' => 'required',
			'age' => 'required',
			'interest' => 'required',
			'language' => 'required',
			'sex' => 'required',
			'available_on' => 'required',
			'about' => 'nullable',
			'image' => 'nullable',
		]);
		//print_r($data); die;
		
	    $data['mobile_no'] = "+91" . $request['mobile_no'];
		
		$interest = $data['interest'];
		$string = implode(",",$interest);
		$data['interest'] = $string;
		
		$language = $data['language'];
		$string1 = implode(",",$language);
		$data['language'] = $string1;
		
		$available_on = $data['available_on'];
		$string2 = implode(",",$available_on);
		$data['available_on'] = $string2;
		
    
		$data['user_type'] = 'listner';
		$data['status'] = 1;
		$data['online_status'] = 0;
		
		if($request->file('image')){
            $file= $request->file('image');
            $filename= $file->getClientOriginalName();
            //dd($filename);
            $file-> move(public_path('/image/listner'), $filename);
             
            $image = "public/image/listner/$filename";
            $data['image']= $image;
            //$data['image']= $image;
        }
	//	dd($data); die;
		$check_user=DB::table('registrations')->where('mobile_no', $data['mobile_no'])->where('user_type', 'user')->count(); 
		$check_listner=DB::table('registrations')->where('mobile_no', $data['mobile_no'])->where('user_type', 'listner')->count(); 

	   if($check_user > 0){
		   $data = DB::table('registrations')->where('mobile_no', $data['mobile_no'])->update($data);
	
				return redirect()->route('view-listener')->with(Session::flash('success','Now you are listner'));
	  
	  } elseif($check_listner > 0){
				
		        return redirect()->back()->with(Session::flash('error', 'You are already listner'));
				
	   }else {
		
		$store = Registration::create($data);
	
			    return redirect()->route('view-listener')->with(Session::flash('success','Registration successfull'));
	   }
    }
    
    public function search(Request $request)
	{
		$searchTerm =$request->serch_keywords;
		$reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
		$searchTerm = str_replace($reservedSymbols, ' ', $searchTerm);

		$searchValues = preg_split('/\s+/', $searchTerm, -1, PREG_SPLIT_NO_EMPTY);

		$res = Registration::where(function ($q) use ($searchValues) {
			foreach ($searchValues as $value) {
			$q->orWhere('name', 'like', "%{$value}%");
			$q->orWhere('about', 'like', "%{$value}%");
			}
		})->get();
		
		//print_r($res); die;
		
	if(!$res->isEmpty()){
	return response()->json([
		       'status' => true,
			   'search_result' => $res,
			]);
	}else{
		return response()->json([
		       'status' => false,
			   'search_result' => 'Data no avilable',
			]);
	}
	}
	
	public function nickname(Request $request)
	{
		$data = $request->validate([
		      'from_id' => 'required',
		      'to_id' => 'required',
		      'nickname' => 'required',
		]);
		
		$check_user = DB::table('nicknames')->where('from_id', $request->from_id)->where('to_id', $request->to_id)->count();
		
		if($check_user > 0){
			$data = DB::table('nicknames')->where('from_id', $request->from_id)->where('to_id', $request->to_id)->update($data);
		    $data2 = DB::table('nicknames')->where('from_id', $request->from_id)->where('to_id', $request->to_id)->first();
			return response()->json([
		       'status' => true,
			   'message' => 'Nickname update successfully',
			   'data' => $data2,
		]);
		}else{
			
			$store = Nickname::create($data);
			
			return response()->json([
		       'status' => true,
			   'message' => 'Nickname store successfully',
			   'data' => $data,
		]);
		}
				
		
	}
	
	public function nickname_get(Request $request, $id)
	{
		
		$data = Nickname::where('from_id', $id)->get();
		
		if(!$data->isEmpty()){
			
		return response()->json([
		       'status' => true,
			   'message' => 'Data retrive successfully',
			   'data' => $data,
		]);
		}else{
		return response()->json([
		       'status' => false,
			   'message' => 'Data no avilable',
			]);
	}
	}
	
	public function onOf_status(Request $request)
	{
	    $status_check = DB::table('registrations')->where('id', $request->user_id)->first();
        if(($request->busy_status == '') && ($status_check->busy_status == 0)){
		   if($status_check->online_status == 1){			
                $data = DB::table('registrations')->where('id', $request->user_id)->update(['online_status'=>0]);
        		$data_ac = DB::table('registrations')->where('id', $request->user_id)->first();
        		if($data){
        		    return response()->json([
        		        'status' => true,
        			    'message' => 'User offline successfull',
        			    'data' => $data_ac,
        			]);
        		 } else{
        		    return response()->json([
        		       'status' => false,
        			   'message' => 'Data not found',
        			   'data' => 0,
        			]);
        		 }
			} else {
				$data = DB::table('registrations')->where('id', $request->user_id)->update(['online_status'=>1]);
			  	$data_ac = DB::table('registrations')->where('id', $request->user_id)->first();
			 
			    if($data){
				    //$user = DB::table('bell_notifications')->join('registrations','bell_notifications.from_id','=','registrations.id')->select('registrations.*')->where('bell_notifications.from_id', $request->user_id)->where('bell_notifications.status', '1')->get();
				    $user = DB::table('bell_notifications')->where('to_id', $request->user_id)->where('status', '1')->get();
				    $user_c = DB::table('bell_notifications')->where('to_id', $request->user_id)->where('status', '1')->count();
				 
				    if($user_c > 0){
    				    foreach($user as $n_user){
    					    $notify_user = $n_user->from_id;
    					    $notify_listnear = $n_user->to_id;
    					 	$listener = DB::table('bell_notifications')->join('registrations','bell_notifications.to_id','=','registrations.id')->select('registrations.*')->where('bell_notifications.to_id', $request->user_id)->where('bell_notifications.status', '1')->first();
        				    //$listener_data = array(
        					   //'user_id' => $listener->id,
        						//'name' => $listener->name,
        						//'image' => $listener->image,
        						//'msg' => 'Online now'
        						//);
        						//print_r($listener_data); die;
        						//$listener_data = implode(" ",$listener_data);
        					$notify = OnlineNotification::create([
        				         'type'=> 'online_status',
        				         'notifiable_id'=> $notify_user,
        				         'data_id'=> $listener->id,
        				         'data_name'=> $listener->name,
        				         'data_image'=> $listener->image,
        				         'data_msg'=> 'Online now'
        				    ]);
    				    }	
				    	$update = DB::table('bell_notifications')->where('to_id', $notify_listnear)->update(['status'=>0]);
				    }
    			 return response()->json([
    		       'status' => true,
    			   'message' => 'User online successfull',
    			   'data' => $data_ac,
    			]);
    		 } else{
        			 return response()->json([
        		       'status' => false,
        			   'message' => 'Data not found',
        			   'data' => 0,
        			]);
        	    }
			}
        } else {
            $online_check = Registration::where('id', $request->user_id)->first();
    		if(($request->busy_status === 'true') && ($online_check->online_status == 1)){
			 $data = Registration::where('id', $request->user_id)->update(['busy_status'=>1]);
			 $data_ac = DB::table('registrations')->where('id', $request->user_id)->first();
	          return response()->json([
		       'status' => true,
			   'message' => 'Busy now....',
			   'data' => $data_ac
		    	]);
		    } elseif(($request->busy_status === 'false') && ($online_check->online_status == 1)){
    			 $data = Registration::where('id', $request->user_id)->update(['busy_status'=>0]);
    			 $data_ac = DB::table('registrations')->where('id', $request->user_id)->first();
    	        return response()->json([
    		       'status' => true,
    			   'message' => 'Online now....',
    			   'data' => $data_ac
    			]);
		    } else{
		         $data_ac = DB::table('registrations')->where('id', $request->user_id)->first();
    		    return response()->json([
        		    'status' => false,
        			'message' => 'Invalid Request',
        			'data' => 0
        		]);
		    }
        }
	}
	
	public function busy_status(Request $request)
	{
		$busy_status = Registration::where('id', $request->user_id)->first();

		if($busy_status->busy_status == '0'){
			 $data = Registration::where('id', $request->user_id)->update(['busy_status'=>1]);
			 $user_data = Registration::where('id', $request->user_id)->first();
	      return response()->json([
		       'status' => true,
			   'busy_status' => $user_data->busy_status,
			   'message' => 'Busy now....',
			]);
		}else{
			 $data = Registration::where('id', $request->user_id)->update(['busy_status'=>0]);
			 $user_data = Registration::where('id', $request->user_id)->first();
	      return response()->json([
		       'status' => true,
			   'busy_status' => $user_data->busy_status,
			   'message' => 'Online now....',
			]);
		}
		
	}
	
	public function block(Request $request)
    {
        //$store = Registration::find($id);
		
		      $check_block = DB::table('registrations')->where('id', $request->user_id)->first();
			
			if($check_block->status == 0){
				return response()->json([
		       'status' => true,
			   'message' => 'User already blocked',
			   'data' => $check_block,
			]);
			}else{
		
		     $data = DB::table('registrations')->where('id', $request->user_id)->update(['status'=>0]);
		     
		     $data_block = DB::table('registrations')->where('id', $request->user_id)->first();
			 
			 
			 return response()->json([
		       'status' => true,
			   'message' => 'User block successfull',
			   'data' => $data_block,
			]);
			}
    }
	
	public function report(Request $request)
	{
		$data = $request->validate([
		      'from_id' => 'required',
		      'to_id' => 'required',
		      'reason' => 'required',
		      'details' => 'nullable',
		]);
		
			$report_store = Report::create($data);
			
			if($report_store){
			   return response()->json([
		       'status' => true,
			   'message' => 'Reported successfully',
			   'data' => $report_store,
		]); 
			}else{
			     return response()->json([
		       'status' => false,
			   'message' => 'Not reported, some error ',
			   ]);
			}
	}
	
public function bellnotify(Request $request)
    {
        $data = $request->validate([
		      'from_id' => 'required',
		      'to_id' => 'required'
		]);
		
		    $check_bell = BellNotification::where('from_id', $request->from_id)->where('to_id', $request->to_id)->where('status', 1)->count();
			
			if($check_bell > 0){
				return response()->json([
		       'status' => true,
			   'message' => 'You already press bell',
			]);
			}else{
		
		     $store = BellNotification::create($data);
			 
			 return response()->json([
		       'status' => true,
			   'message' => 'If listener come online notify you',
			   'data' => $store,
			]);
			}
    }
	
	public function get_notification($id){
		
		$store = OnlineNotification::where('notifiable_id', $id)->get();
		$count = OnlineNotification::where('notifiable_id', $id)->where('read_status', 1)->count();
		 
		  if(!$store->isEmpty()){
			
		
		return response()->json([
		       'status' => true,
			   'message' => 'Data retrive successfull',
			   'unread_notifications' => $count,
			   'all_notifications' => $store,
			]);
			
		  }else{
			   return response()->json([
		       'status' => false,
			   'message' => 'Data not retrive',
			]);
		  }
	}
	
	public function notification_read(Request $request)
	{
		 $data = OnlineNotification::where('notifiable_id', $request->user_id)->update(['read_status'=>0]);
	      return response()->json([
		       'status' => true,
			   'message' => 'Notification read',
			]);
	}
	
	
	
	public function chats(Request $request)
    { 
        $data = $request->validate([
            'user' => 'required',
			'listner' => 'required',
			'chatroom' => 'required',
		]);
	
        $store = Chat::create($data);
		
		return response()->json([
		       'status' => true,
			   'message' => 'Chat created successfull',
			   'data' => $store,
			]);
	}
	
		public function messages(Request $request)
    { 
        $data = $request->validate([
			'user_id' => 'required',
			'chat_id' => 'required',
			'message' => 'required',
		    'status' => 'required'
		]);
	
        $store = chat_message::create($data);
        
		$chat['client_one_id']  = $store->clie;
		
		return response()->json([
		       'status' => true,
			   'message' => 'Messages successfull',
			   'data' => $store,
			]);
	}
	
	
	public function call_start(Request $request)
    { 
         $data = $request->validate([
            'from_id' => 'required',
            'to_id' => 'required',
            'channel_name' => 'required',
            'user_id' => 'required',
            'token' => 'required'
		]);
		
		$busy_status = DB::table('registrations')->where('id', $request->to_id)->update(['busy_status'=>1]);
		
		$store = Call::create($data);
		$call_id = $store->id;
        
//         //Get Resource ID
        $acquire_fields = array(
            'cname' => $request->channel_name,
            'uid' => $request->user_id,
            'clientRequest' => array(
                'resourceExpiredHour' => 24,
                'scene' => 0
                )
        );
        
        $curl_acquire = curl_init();
        
        curl_setopt_array($curl_acquire, array(
          CURLOPT_URL => 'https://api.agora.io/v1/apps/ffbd24b671cf47469f9e8fc7df7eb7b6/cloud_recording/acquire',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS=> json_encode($acquire_fields),
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic MGUyM2U0ZTljMWU2NDYwYzlkMjgyZTY2NmRkMjQ4ZDQ6NzZmZmI2MzNlY2NhNGFlMGJiOTU5YzEzMWZkN2RhNWY=',
            'Content-Type: application/json'
          ),
        ));
        
        $resourceId = curl_exec($curl_acquire);
        
        curl_close($curl_acquire);
        $resourceId = json_decode(($resourceId));
        
        $resourceId = $resourceId->resourceId;
        
        if($resourceId){
            $data = DB::table('calls')->where('id', $call_id)->update(['resource_id'=>$resourceId]);
        }
        
        //Start Recording
        
        $start_fields = array(
            'cname' => $request->channel_name,
            'uid' => $request->user_id,
            'clientRequest' => array(
                'token' => $request->token,
                'storageConfig' => array(
                    'secretKey' => "zvJkg8l7mDGsTcnRpqYXYfUkjpIFlefssu2XBtM/",
                    'vendor' => 1,
                    'region' => 14,
                    'bucket' => "mysupportbucket",
                    'accessKey' => "AKIA47DXY6ZYKOMIDF5W",
                    'fileNamePrefix' => array()
                    ),
                'recordingConfig' => array(
                    'audioProfile'=> 0,
                    'maxIdleTime'=> 30,
                    'channelType' => 1,
                    'streamTypes' => 0,
                  /* 'transcodingConfig' => array(
                        'height' => 640,
                        'width'  => 360,
                        'bitrate' => 500,
                        'fps'    => 15,
                        'mixedVideoLayout' => 1,
                        'backgroundColor' => "#FF0000"
                        )*/
                    ),
                    'recordingFileConfig' => array('avFileType' => array("hls","mp4"))
                )
            );
            
        $start_url = 'https://api.agora.io/v1/apps/ffbd24b671cf47469f9e8fc7df7eb7b6/cloud_recording/resourceid/'.$resourceId.'/mode/mix/start';     
            
        $curl_start = curl_init();
        
        curl_setopt_array($curl_start, array(
          CURLOPT_URL => $start_url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS=> json_encode($start_fields),
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic MGUyM2U0ZTljMWU2NDYwYzlkMjgyZTY2NmRkMjQ4ZDQ6NzZmZmI2MzNlY2NhNGFlMGJiOTU5YzEzMWZkN2RhNWY=',
            'Content-Type: application/json'
          ),
        ));
        
     
        $data = DB::table('calls')->where('id', $call_id)->update(['call_start_url'=> $start_url,'call_start_request'=>json_encode($start_fields)]);
        
        $start_response = curl_exec($curl_start);
        
         if($start_response){
          $data = DB::table('calls')->where('id', $call_id)->update(['call_start_response'=>$start_response]); 
        }
        
        curl_close($curl_start);
        
        $start_response = json_decode(($start_response));
        
        $sid = $start_response->sid;
        if($sid){
          $data = DB::table('calls')->where('id', $call_id)->update(['sid'=>$sid]); 
        }
        
        $data_block = DB::table('registrations')->where('id', $request->to_id)->first();
        
		return response()->json([
		       'status' => true,
			   'message' => 'Call successfull',
			   'call_id' => $call_id,
			   'busy_status' => $data_block->busy_status
			]);
	}
	
	public function call_end(Request $request)
    { 
        $call_id = $request->call_id;
        
        $call_detail = Call::find($call_id);
        
        if($call_detail){
            $data = DB::table('registrations')->where('id', $call_detail->to_id)->update(['busy_status'=>0]);
            
            $resourceId = $call_detail->resource_id;
            $sid = $call_detail->sid;
        
            $end_fields = array(
                'cname' => $call_detail->channel_name,
                'uid' => $call_detail->user_id,
                'clientRequest' => array()
            );
            
            $stop_url = 'https://api.agora.io/v1/apps/ffbd24b671cf47469f9e8fc7df7eb7b6/cloud_recording/resourceid/'.$resourceId.'/sid/'.$sid.'/mode/mix/stop';
            
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
              CURLOPT_URL => $stop_url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS=> json_encode($end_fields),
              CURLOPT_HTTPHEADER => array(
                'Authorization: Basic MGUyM2U0ZTljMWU2NDYwYzlkMjgyZTY2NmRkMjQ4ZDQ6NzZmZmI2MzNlY2NhNGFlMGJiOTU5YzEzMWZkN2RhNWY=',
                'Content-Type: application/json'
              ),
            ));
            $data = DB::table('calls')->where('id', $call_id)->update(['call_stop_url'=>$stop_url, 'call_stop_request'=>json_encode($end_fields)]);
            
            $call_stop_response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if($call_stop_response){
               $data = DB::table('calls')->where('id', $call_id)->update(['call_stop_response'=>$call_stop_response]); 
            }
            $data_block = DB::table('registrations')->where('id', $call_detail->to_id)->first();
            if($httpcode == '200'){
                return response()->json([
    		       'status' => true,
    			   'message' => 'Recorded Successfully',
    			   'response' => $call_stop_response,
    			   'busy_status' => $data_block->busy_status,
    			   'listener_id' => $call_detail->to_id
    			]); 
            } else {
                return response()->json([
    		       'status' => false,
    			   'message' => 'Invalid Request',
    			   'response' => $call_stop_response,
    			   'busy_status' => $data_block->busy_status,
    			   'listener_id' => $call_detail->to_id
    			]);
            }
            
        } else {
           return response()->json([
		       'status' => false,
			   'message' => 'Invalid Request'
			]); 
        }
	}
	
	
	/* -------------------------- Admin ------------------------------- */
	
	public function user_block($id)
	{
		$data = DB::table('registrations')->where('id', $id)->update(['status'=>0]);
	     return redirect()->back()->with(Session::flash('success','User Blocked'));
	}
	
	public function user_unblock($id)
	{
		$data = DB::table('registrations')->where('id', $id)->update(['status'=>1]);
	     return redirect()->back()->with(Session::flash('success','User Unblocked'));
	}
	
	public function Ablock($id)
	{
		$data = DB::table('registrations')->where('id', $id)->update(['status'=>0]);
		$report = DB::table('reports')->where('to_id', $id)->update(['status'=>1]);
	     
		 return redirect()->back()->with(Session::flash('success','User Blocked'));
	}
	
	public function user_delete($id)
    {
       
		     $data = DB::table('registrations')->where('id', $id)->update(['ac_delete'=>1]);
		     
		     return redirect()->back()->with(Session::flash('error','User Deleted'));
    }
	
	public function cretae_admin(Request $request)
		{
			
			$data = $request->validate([
			'name' => 'required',
			'number' => 'required',
			'email' => 'required',
			'image' => 'nullable',
			'password' => 'required',
			'role' => 'required',
		]);
		//dd($request); die;
		
		$data['password']= Hash::make($request->password);
		
		if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/image/admin'), $filename);
            $image = "public/image/admin/$filename";
            $data['image']= $image;
        }
		
		$check_admin = User::where('number', $request->number)->orwhere('email', $request->email)->count(); 
	   if($check_admin > 0){	
				 return redirect()->back()->with(Session::flash('error','Email or number already exist'));				
	   }else {
		
		$store = User::create($data);
            //'username' => $data['username'],
            //'email' => $data['email'],
            //'number' => $data['number'],
            //'image' => $data['image'],
            //'role' => $data['role'],
            //'password' => Hash::make($data['password'])
	
			    return redirect()->route('admin')->with(Session::flash('success','Admin register successfull'));
	   }
    }
	
	public function rpass_admin(Request $request)
    {
		$data = $request->validate([
			'id' => 'required',
			'password' => 'required',
			
		]);
		$pass = Hash::make($request->password);
		$data = User::where('id', $request->id)->update([
		'password'=> $pass,
		]);
		if($data){
			return redirect()->back()->with(Session::flash('success','Password Changed'));
		}else{     
		 return redirect()->back()->with(Session::flash('error','Somthimg error'));
		}
	}
	
	public function Adminblock($id)
	{
		$data = User::where('id', $id)->update(['status'=>0]);
	     
		 return redirect()->back()->with(Session::flash('error','Admin Blocked'));
	}
	
	public function Adminunblock($id)
	{
		$data = User::where('id', $id)->update(['status'=>1]);
	     
		 return redirect()->back()->with(Session::flash('success','Admin Unblocked'));
	}
	
	 public function privacy_policy ()
   {
      
       	return view('privacy_policy');
       
   }
		
}
