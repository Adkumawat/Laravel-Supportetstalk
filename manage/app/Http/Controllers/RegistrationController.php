<?php

namespace App\Http\Controllers;

use App\Models\Registration;
//use App\Http\Requests\StoreRegistrationRequest;
//use App\Http\Requests\UpdateRegistrationRequest;
use Illuminate\Http\Request;use App\Models\Api\Wallet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Api\Nickname;
use App\Models\Api\Report;
use App\Models\Api\BellNotification;
use App\Models\Api\OnlineNotification;
use App\Models\AdminMessage;
use App\Http\Controllers\AgoraDynamicKey\AgoraTokanController;
//use Illuminate\Support\Facades\Notification;
use Notifiable;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Call;
use App\Models\Chat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
  
  
   public function updateDeviceToken(Request $request)
    {
        $id = $request->input('id');
        $deviceToken = $request->input('device_token');

        try {
            $registration = Registration::findOrFail($id);
            $registration->device_token = $deviceToken;
            $registration->save();

            return response()->json([
                'status' => true,
                'message' => 'Device token updated successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update device token',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
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
    	             //  'ac_delete' => 0,
    	              //'helping_category'=>$request->helping_category,
    	              // 'device_token'=>$request->device_token
    	            //   ]);
    	               
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
    	       
    		    
    		    $data2 = Registration::where('mobile_no', $request->mobile_no)->first();
    		    
    				return response()->json([
    				   'status' => true,
    				   'message' => 'Login Succesfull',
    				   'data' =>  $data2,
    				]);
    	   } 
	   } else {
			if( $data['mobile_no'] && strlen($data['mobile_no']) > 8){
			    
			    $random_user_info = $this->getRandomAvatarAndUniqueName();
			    
			    $data['name'] = $random_user_info['name'];
			    $data['image'] = $random_user_info['avatar'];
			    
				$store = Registration::create($data);
            	
                $free_money['user_id'] = $store['id'];
                $free_money['wallet_amount'] = 25;
                $free_money['debit_amount'] = 0;
                $free_money['created_at'] = $store['created_at'];
                $free_money['updated_at'] = $store['updated_at'];
                $wallet_res = DB::table('wallets')->insert($free_money);
                
                return response()->json([
                       'status' => true,
                       'message' => 'Registration successfull',
                       'data' => $store,
                    ]);
            } else {
                    return response()->json([
                           'status' => false,
                           'message' => 'Registration unsuccessfull'
                     ]);
            }
       }
	 }
	 
    private function getRandomAvatarAndUniqueName() {
		$random_avatar = collect(scandir(base_path('../assets/avatar')))
				->filter(fn ($f) => str_ends_with($f, ".png"))
			->random();

			$random_strings = collect(explode("\r\n", file_get_contents(base_path('../assets/usernames.txt'))));

			$random_name = $random_strings->random() . $random_strings->random();

			while (\App\Models\Registration::where('name', $random_name)->exists()) {
				$random_name = $random_strings->random() . $random_strings->random();
			}



			return ['name' => $random_name, 'avatar' => "https://laravel.supportletstalk.com/assets/avatar/$random_avatar"];
	}
  
   public function registerWithEmail(Request $request) {
		$data = $request->validate([
			'device_token' => 'required',
			'helping_category' => 'required'
		]);

		$data['user_type'] = 'user';
		$data['status'] = 1;
		$data['ac_delete'] = 0;

		$data['helping_category'] = $request->helping_category ?? NULL;
		$data['age'] = $request->age ?? NULL;
		$data['interest'] = $request->interest ?? NULL;
		$data['language'] = $request->language ?? NULL;
		$data['sex'] = $request->sex ?? NULL;
		$data['available_on'] = $request->available_on ?? NULL;
		$data['about'] = $request->about ?? NULL;
		$data['charge'] = $request->charge ?? NULL;
		$data['mobile_no'] = '+910000000000';
		
		$random_user_info = $this->getRandomAvatarAndUniqueName();
			    
		$data['name'] = $random_user_info['name'];
		$data['image'] = $request->image ?? $random_user_info['avatar'];

		$check_user = DB::table('registrations')->where('helping_category', $request->helping_category)->count();
		$check_ac = Registration::where('helping_category', $request->helping_category)->first();

		if ($check_user > 0) {
			if ($check_ac->ac_delete == 1) {
				$data = DB::table('registrations')->where('helping_category', $request->helping_category)->update($data);
				$user_ac = Registration::where('helping_category', $request->helping_category)->first();
				return response()->json([
					'status' => true,
					'message' => 'Registration successfull',
					'data' => $user_ac,
				]);
			} else {
				$data = DB::table('registrations')->where('helping_category', $request->helping_category)->update([
					'device_token' => $request->device_token
				]);
				$data2 = Registration::where('helping_category', $request->helping_category)->first();
				return response()->json([
					'status' => true,
					'message' => 'Login Succesfull',
					'data' => $data2,
				]);
			}
		} else {
			if ($data['helping_category']) {
				$store = Registration::create($data);
				$free_money['user_id'] = $store['id'];
				$free_money['wallet_amount'] = 25;
				$free_money['debit_amount'] = NULL;
				$free_money['created_at'] = $store['created_at'];
				$free_money['updated_at'] = $store['updated_at'];
				$wallet_res = Wallet::create($free_money);
//				$url = 'https://api.supportletstalk.com/api/getAvatarUsername/' . strval($store['id']);
//			$response = json_decode(file_get_contents($url), true);
//				if ($response['name'] && $response['avatar']) {
//					$store['name'] = $response['name'];
//					$store['image'] = $response['avatar'];
//				}
				return response()->json([
					'status' => true,
					'message' => 'Registration successfull',
					'data' => $store,
				]);
			} else {
				return response()->json([
					'status' => false,
					'message' => 'Registration unsuccessfull'
				]);
			}
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
    public function edit($id)
    {
      	 $listeners = Registration::find($id);
     	$template['page'] = 'listeneredit';
		return view('admin.template ', $template, compact('listeners'));
    }
  
  	public function permanent_delete_user($id) {
		     $data = DB::table('registrations')->where('id', $id)->delete();
			 return response()->json([
				'status' => true,
				'message' => 'Deleted Succesfully',
				'data' => $data,
			]);     
    }



 public function updatelistner(Request $request)
    {
		//echo "Hiii";
			//print_r($id);
			//die();
		$id=$request->id;
	
        $data = $request->validate([
           	'name' => 'required',
			'mobile_no' => 'required',
			'helping_category' => 'nullable',
			'image' => 'nullable',
			'age' => 'nullable',
			'interest' => 'nullable',
			'language' => 'nullable',
			'sex' => 'nullable',
			'available_on' => 'nullable',
			'about' => 'nullable',
			
		]);
		//echo "Hiii";
		 $store = Registration::find($id);
	
		 if($store){
		     if($request->file('image')){
            $file= $request->file('image');
            $filename= $file->getClientOriginalName();
           $file-> move(('public/image/listner'), $filename);
           $image = "public/image/listner/$filename";
           echo $data['image']= $image;
           // $data['image']= $filename;
           
        }
         echo '<pre>';
         print_r($data);
			 $store->update($data);
			 
			 
			 
			   return redirect('view-listener')->with(Session::flash('success',' Listener Update Successfully'));
		
		 }else{
			  return redirect('view-listener')->with(Session::flash('success',' Listener Not Update Successfully'));
		 }
		
		
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
		 $store = Registration::find($id);
		 
		 if($store){
			 $store->update(['name'=>$request->name]);
			 
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
		try {
			// Find the registration record
			$registration = Registration::findOrFail($request->user_id);

			// Mark the registeration account for deletion by updating the 'ac_delete' field to 1 for the given user_id
			Registration::where('id', $request->user_id)->update(['ac_delete' => 1]);

			// Delete the record
			// $registration->delete();

			return response()->json([
				'status' => true,
				'message' => 'Data deleted successfully',
				'data' => $registration,
			]);
		} catch (\Exception $e) {
			// Handle errors
			return response()->json([
				'status' => false,
				'message' => 'Failed to delete data',
				'error' => $e->getMessage(),
			], 500);
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
		
		if($request->file('image')){
            $file= $request->file('image');
            $filename= $file->getClientOriginalName();
           $file-> move(('public/image/listner'), $filename);
           $image = "public/image/listner/$filename";
            $data['image']= $image;
           // $data['image']= $filename;
            //dd($image);
        }
		//print_r($data); die;
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
    	} else{
    		return response()->json([
    		       'status' => false,
    			   'message' => 'Data no avilable',
    			]);
    	}
	}
  
  
  public function onOf_status(Request $request){
		$status_check = DB::table('registrations')->where('id', $request->user_id)->first();
		$isUpdatedBusy = DB::table('registrations')->where('id', $request->user_id)->update(['busy_status' => 0]);
        $currentTime = date('Y-m-d H:i:s');
        if ($status_check->online_status == 0) {
			$isUpdated = DB::table('registrations')->where('id', $request->user_id)->update(['online_status' => 1]);
          	if($isUpdated){
              return response()->json([
                  'status' => true,
                  'message' => 'User online successfull',

              ]);
            }
		} else if ($status_check->online_status == 1) {
			$isUpdated2 = DB::table('registrations')->where('id', $request->user_id)->update(['online_status' => 0, 'updated_at' => $currentTime]);
          	if($isUpdated2){
              return response()->json([
                  'status' => true,
                  'message' => 'User offline successfull',
                  'updated_at' => $currentTime

              ]);
            }
		} else {
			$isUpdated3 = DB::table('registrations')->where('id', $request->user_id)->update(['online_status' => 0]);
          	if($isUpdated3){
              return response()->json([
                  'status' => true,
                  'message' => 'User offline successfull'
              ]);
            }
		}
}

 
	
public function onOf_status2(Request $request)
	{
	    $status_check = DB::table('registrations')->where('id', $request->user_id)->first();
        if(($request->busy_status == '') && ($status_check->busy_status == 0)){
		   	if($status_check->online_status == 1){			
                $data = DB::table('registrations')->where('id', $request->user_id)->update(['online_status'=>0]);
        		$data_ac = DB::table('registrations')->where('id', $request->user_id)->first();
        		$reg_id  = $data_ac->id;
        		$data_ac->id = (string)$reg_id;
        	    $status  = $data_ac->status;
        		$data_ac->status = (string)$status;
        		$online_status  = $data_ac->online_status;
        		$data_ac->online_status = (string)$online_status;
        		$ac_delete  = $data_ac->ac_delete;
        		$data_ac->ac_delete = (string)$ac_delete;
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
			    $regId = array();
			    if($data){
				    //$user = DB::table('bell_notifications')->join('registrations','bell_notifications.from_id','=','registrations.id')->select('registrations.*')->where('bell_notifications.from_id', $request->user_id)->where('bell_notifications.status', '1')->get();
				    $user = DB::table('bell_notifications')->where('to_id', $request->user_id)->where('status', '1')->get();
				    $user_c = DB::table('bell_notifications')->where('to_id', $request->user_id)->where('status', '1')->count();
				 
				    if($user_c > 0){
    				    foreach($user as $n_user){
    					    $notify_user = $n_user->from_id;
    					    $notify_listnear = $n_user->to_id;
    					 	$listener = DB::table('bell_notifications')->join('registrations','bell_notifications.to_id','=','registrations.id')->select('registrations.*')->where('bell_notifications.to_id', $request->user_id)->where('bell_notifications.status', '1')->first();
        					$notify = OnlineNotification::create([
        				         'type'=> 'online_status',
        				         'notifiable_id'=> $notify_user,
        				         'data_id'=> $listener->id,
        				         'data_name'=> $listener->name,
        				         'data_image'=> $listener->image,
        				         'data_msg'=> 'Online now'
        				    ]);
        				    $regId[] = DB::table('registrations')->where('id', $notify_user)->first()->device_token;
    				    }	
				    	$update = DB::table('bell_notifications')->where('to_id', $notify_listnear)->update(['status'=>0]);
						//Send Notification
						$url =  url('/');
				// 		$regId[] = $status_check->device_token;
						$imagepath = $url.'/images/logo-small.png';
						$arrNotification= array();          
						$arrNotification["title"] = 'Listener comes Online';                           
						$arrNotification["body"] = $status_check->name.' is online Now. You can chat or Call.';
						$arrNotification["image"] = $imagepath;
						$arrNotification["sound"] = "customsound";
						$arrNotification["type"] = 1;

						$url = 'https://fcm.googleapis.com/fcm/send';
						$fields = array(
							'registration_ids' => $regId,
				// 		'registration_ids' => array('f2mq13T0TGeOvm_0ojBe_c:APA91bH1XXPqpFJgiSe_os87mhJMka57W_Dtl8T06oyOk3uhPaCPBvBVej9kRtDfZWmE6x2ct_ubNEBuwriXXDuFSAmkswnkmCLmszchXzMTcPMjyi7TFurjwKN_WVENOY8EkazT6C06'),
							'notification' => $arrNotification
						);
						
						// Firebase API Key
						$headers = array('Authorization:key=AAAAsl7lYN0:APA91bEBMLw5Pdps-iv5j0zCb6O9m-9-DiJUjylvAwX4lO6FjXZAviKYdu2F6q1hLkd-ek9cridGs5mqkRlPDZT4jXH5L-gh1NjkEReQULbYF-fLWRBrcblNvieYSzxSiUWuUb7aaz5W','Content-Type:application/json');
						// Open connection
						$ch = curl_init();
						// Set the url, number of POST vars, POST data
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_POST, true); 
						curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						// Disabling SSL Certificate support temporarly
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
						curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
						$result = curl_exec($ch);

						if ($result === FALSE) {
							die('Curl failed: ' . curl_error($ch));
						}
						curl_close($ch);
				    }
        	$reg_id  = $data_ac->id;
        		$data_ac->id = (string)$reg_id;
        		$status  = $data_ac->status;
        		$data_ac->status = (string)$status;
        		$online_status  = $data_ac->online_status;
        		$data_ac->online_status = (string)$online_status;
        		$ac_delete  = $data_ac->ac_delete;
        		$data_ac->ac_delete = (string)$ac_delete;
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
        		$reg_id  = $data_ac->id;
        		$data_ac->id = (string)$reg_id;
        		$status  = $data_ac->status;
        		$data_ac->status = (string)$status;
        		$online_status  = $data_ac->online_status;
        		$data_ac->online_status = (string)$online_status;
        		$ac_delete  = $data_ac->ac_delete;
        		$data_ac->ac_delete = (string)$ac_delete;
	          return response()->json([
		       'status' => true,
			   'message' => 'Busy now....',
			   'data' => $data_ac
		    	]);
		    } elseif(($request->busy_status === 'false') && ($online_check->online_status == 1)){
    			 $data = Registration::where('id', $request->user_id)->update(['busy_status'=>0]);
    			 $data_ac = DB::table('registrations')->where('id', $request->user_id)->first();
    		    	$reg_id  = $data_ac->id;
        		$data_ac->id = (string)$reg_id;
        		$status  = $data_ac->status;
        		$data_ac->status = (string)$status;
        		$online_status  = $data_ac->online_status;
        		$data_ac->online_status = (string)$online_status;
        		$ac_delete  = $data_ac->ac_delete;
        		$data_ac->ac_delete = (string)$ac_delete;
    	        return response()->json([
    		       'status' => true,
    			   'message' => 'Online now....',
    			   'data' => $data_ac
    			]);
		    } else{
		         $data = Registration::where('id', $request->user_id)->update(['busy_status'=>0]);
		         $data = Registration::where('id', $request->user_id)->update(['online_status'=>0]);
		         $data_ac = DB::table('registrations')->where('id', $request->user_id)->first();
    		    return response()->json([
        		    'status' => true,
        			'message' => 'User offline successfull',
        			 'data' => $data_ac,
        		]);
		    }
        }
	}
	
	public function busy_status(Request $request)
	{
// 		$busy_status = Registration::where('id', $request->user_id)->first();

// 		if($busy_status->busy_status == '0'){
// 			 $data = Registration::where('id', $request->user_id)->update(['busy_status'=>1]);
// 			 $user_data = Registration::where('id', $request->user_id)->first();
// 	      return response()->json([
// 		       'status' => true,
// 			   'busy_status' => $user_data->busy_status,
// 			   'message' => 'Busy now....',
// 			]);
// 		}else{
// 			 $data = Registration::where('id', $request->user_id)->update(['busy_status'=>0]);
// 			 $user_data = Registration::where('id', $request->user_id)->first();
// 	      return response()->json([
// 		       'status' => true,
// 			   'busy_status' => $user_data->busy_status,
// 			   'message' => 'Online now....',
// 			]);
// 		}
		
		 $busy_status = $request->busy_status;

		if($busy_status == 'true'){
			$data = Registration::where('id', $request->user_id)->update(['busy_status'=>1]);
			$user_data = Registration::where('id', $request->user_id)->first();
	        return response()->json([
		       'status' => true,
			   'busy_status' => $user_data->busy_status,
			   'message' => 'Busy now....',
			]);
		}else if($busy_status == 'false'){
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
		} else{
		    $store = BellNotification::create($data);
		    $name = DB::table('registrations')->where('id', $request->to_id)->first()->name;
		    $regId[] = DB::table('registrations')->where('id', $request->to_id)->first()->device_token;
		    $url =  url('/');
			$imagepath = $url.'/images/logo-small.png';
			$arrNotification= array();          
			$arrNotification["title"] = "User Want's to talk to you.";                           
			$arrNotification["body"] = $name.' is online Now. You can chat or Call.';
			$arrNotification["image"] = $imagepath;
			$arrNotification["sound"] = "customsound";
			$arrNotification["type"] = 1;

			$url = 'https://fcm.googleapis.com/fcm/send';
			$fields = array(
			    'registration_ids' => $regId,
				'notification' => $arrNotification
			);
						
			// Firebase API Key
			$headers = array('Authorization:key=AAAAsl7lYN0:APA91bEBMLw5Pdps-iv5j0zCb6O9m-9-DiJUjylvAwX4lO6FjXZAviKYdu2F6q1hLkd-ek9cridGs5mqkRlPDZT4jXH5L-gh1NjkEReQULbYF-fLWRBrcblNvieYSzxSiUWuUb7aaz5W','Content-Type:application/json');
			// Open connection
			$ch = curl_init();
			// Set the url, number of POST vars, POST data
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			// Disabling SSL Certificate support temporarly
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
			$result = curl_exec($ch);
			if ($result === FALSE) {
				die('Curl failed: ' . curl_error($ch));
			}
			curl_close($ch);
			return response()->json([
			   'notification_payload' => $fields,
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
    			
    	} else{
    	    $store = array();
    			   return response()->json([
    		       'status' => true,
    			   'message' => 'Data not retrive',
    			   'unread_notifications' => $count,
    			   'all_notifications' => $store,
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
	
	
	
	public function chats(Request $request){ 
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
	
	public function get_chat(Request $request){
	    
		$data = $request->validate([
            'user_id' => 'required',
			'user_type' => 'required'
		]);
		$store = array();
		
		if($data['user_type'] == 'user'){
		    $store = Chat::where('user', $data['user_id'])->get()->last();
		  //  $count = Chat::where('user', $data['user_id'])->get()->last()->count();    
		} else if($data['user_type'] == 'listener') {
		    $store = Chat::where('listner', $data['user_id'])->get()->last();
		  //  $count = Chat::where('listner', $data['user_id'])->get()->last()->count();
		}
		
		if($store){
    	    return response()->json([
    		    'status' => true,
    			'message' => 'Data retrive successfull',
    			'data' => $store
    		]);
    	} else{
    		return response()->json([
    		    'status' => true,
    			'message' => 'Data not retrive',
    		]);
        }
	}
	
	public function chat_end(Request $request){ 
        $data = $request->validate([
            'chat_id' => 'required',
		]);
		
		$listener = Chat::where('id', $request->chat_id)->first()->listner;
	    $busy_status = DB::table('registrations')->where('id', $listener)->update(['busy_status'=>'0']);
	
        $data = Chat::where('id', $request->chat_id)->update(['status'=>'end']);
        $store = Chat::where('id', $request->chat_id)->get();
	    return response()->json([
		       'status' => true,
			   'message' => 'Chat End',
			   'data' => $store
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
	
	//*************************************************************** Call ******************************************************************************************//
	//**************************************************************************************************************************************************************//
	public function call_start(Request $request) {
		$agora_app_id = env('AGORA_APP_ID');
		$agora_authorization_key = env('AGORA_AUTHORIZATION_KEY');
        $data = $request->validate([
            'from_id' => 'required',
            'to_id' => 'required',
            'channel_name' => 'required',
            'user_id' => 'required',
            'token' => 'required'
		]);

        $listener_busy_status = Registration::where('id', $request->to_id)->first();
        
        if($listener_busy_status->busy_status == '0'){
    		$store = Call::create($data);
    		$call_id = $store->id;
    	//	$busy_status = DB::table('registrations')->where('id', $request->to_id)->update(['busy_status'=>1]);
    			
    		$cname = $request->channel_name;
            
            $recording = AgoraTokanController::createRecordingToken($cname);
            $recording_token = $recording['recording_token'];
            $recording_uid = $recording['recording_uid'];
            
            $update_recording_token_uid = DB::table('calls')->where('id', $call_id)->update(['recording_uid'=>$recording_uid,'recording_token'=>$recording_token]);
            
            //Get Resource ID using Channel Name and UID
            $acquire_fields = array(
                'cname' => $cname,
                'uid' => $recording_uid,
                'clientRequest' => array(
                    'resourceExpiredHour' => 24,
                    'scene' => 0
                    )
            );
            
            $curl_acquire = curl_init();
            
            curl_setopt_array($curl_acquire, array(
              CURLOPT_URL => 'https://api.agora.io/v1/apps/'.$agora_app_id.'/cloud_recording/acquire',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS=> json_encode($acquire_fields),
              CURLOPT_HTTPHEADER => array(
                // 'Authorization: Basic MGUyM2U0ZTljMWU2NDYwYzlkMjgyZTY2NmRkMjQ4ZDQ6NzZmZmI2MzNlY2NhNGFlMGJiOTU5YzEzMWZkN2RhNWY=',
                'Authorization: Basic '.$agora_authorization_key.'',
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
                'cname' => $cname,
                'uid' => $recording_uid,
                'clientRequest' => array(
                    'token' => $recording_token,
                    'storageConfig' => array(
                        'secretKey' => "zvJkg8l7mDGsTcnRpqYXYfUkjpIFlefssu2XBtM/",
                        'vendor' => 1,
                        'region' => 14,
                        'bucket' => "mysupportbucket",
                        'accessKey' => "AKIA47DXY6ZYKOMIDF5W",
                        'fileNamePrefix' => array("recordingnew")
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
                
            $start_url = 'https://api.agora.io/v1/apps/'.$agora_app_id.'/cloud_recording/resourceid/'.$resourceId.'/mode/mix/start';     
                
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
                // 'Authorization: Basic MGUyM2U0ZTljMWU2NDYwYzlkMjgyZTY2NmRkMjQ4ZDQ6NzZmZmI2MzNlY2NhNGFlMGJiOTU5YzEzMWZkN2RhNWY=',
                'Authorization: Basic '.$agora_authorization_key.'',
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
    			   'busy_status' => 'call_started'
    			]);
        } else {
          	$payload=array(
              			"type"=>"Listner busy",
                        'mobile_no'=>$request->to_id,
              			'user_id'=>$request->from_id,
                        "created_at"=>date('Y-m-d H:i:s'),
             			'err_message'=>'Listner Busy'
            );
			DB::table('error_logs')->insert($payload);
            return response()->json([
    		       'status' => true,
    			   'message' => 'Listener Busy',
    			   'busy_status' => true
    			]);
        }
	}
	
	public function call_end(Request $request)
    { 
        $agora_app_id = env('AGORA_APP_ID');
		$agora_authorization_key = env('AGORA_AUTHORIZATION_KEY');
        $call_id = $request->call_id;
        
        $call_detail = Call::find($call_id);
        
        if($call_detail){
          //  $data = DB::table('registrations')->where('id', $call_detail->to_id)->update(['busy_status'=>0]);
            
            $resourceId = $call_detail->resource_id;
            $sid = $call_detail->sid;
        
            $end_fields = array(
                'cname' => $call_detail->channel_name,
                'uid' => $call_detail->recording_uid,
                'clientRequest' => array()
            );
            
            $stop_url = 'https://api.agora.io/v1/apps/'.$agora_app_id.'/cloud_recording/resourceid/'.$resourceId.'/sid/'.$sid.'/mode/mix/stop';
            
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
              CURLOPT_POSTFIELDS=> json_encode($end_fields,JSON_FORCE_OBJECT),
              CURLOPT_HTTPHEADER => array(
                // 'Authorization: Basic MGUyM2U0ZTljMWU2NDYwYzlkMjgyZTY2NmRkMjQ4ZDQ6NzZmZmI2MzNlY2NhNGFlMGJiOTU5YzEzMWZkN2RhNWY=',
                'Authorization: Basic '.$agora_authorization_key.'',
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
            $call_stop_response_1 = json_decode($call_stop_response);
            if(isset($call_stop_response_1->serverResponse->fileList[0]->fileName)){
                $aws_end_url = env('AWS_END_URL');
                $recorded_url = $aws_end_url.$call_stop_response_1->serverResponse->fileList[0]->fileName;
                $data = DB::table('calls')->where('id', $call_id)->update(['recorded_url'=>$recorded_url]);
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
  
  public function get_call_test(Request $request){
	    $data = $request->validate([
            'user_id' => 'required',
			'user_type' => 'required'
		]);
		$store = array();
		
		if($data['user_type'] == 'user'){
		    $store = Call::where('from_id', $data['user_id'])->orderBy('created_at', 'DESC')->first();
		  //  $count = Chat::where('user', $data['user_id'])->get()->last()->count();    
		} else if($data['user_type'] == 'listener') {
		    $store = Call::where('to_id', $data['user_id'])->orderBy('created_at', 'DESC')->first();
		  //  $count = Chat::where('listner', $data['user_id'])->get()->last()->count();
		}
    
     
    	$datetime = Carbon::createFromFormat('Y-m-d H:i:s', $store->updated_at);
    	$store['a'] = $datetime->shiftTimezone('Asia/Kolkata');

		
		if($store){
    	    return response()->json([
    		    'status' => true,
    			'message' => 'Data retrive successfull',
    			'data' => $store
    		]);
    	} else{
          	$payload=array(
              			"type"=>"Call not found",
                        'mobile_no'=>$data['from_id'],
              			'user_id'=>$data['to_id'],
                        "created_at"=>date('Y-m-d H:i:s'),
             			'err_message'=>$data['user_type']
            );
			DB::table('error_logs')->insert($payload);
    		return response()->json([
    		    'status' => true,
    			'message' => 'Data not retrive',
    		]);
        }
    
	}
	
	public function get_call(Request $request){
	    
		$data = $request->validate([
            'user_id' => 'required',
			'user_type' => 'required'
		]);
		$store = array();
		
		if($data['user_type'] == 'user'){
		    $store = Call::where('from_id', $data['user_id'])->get()->last();
		  //  $count = Chat::where('user', $data['user_id'])->get()->last()->count();    
		} else if($data['user_type'] == 'listener') {
		    $store = Call::where('to_id', $data['user_id'])->get()->last();
		  //  $count = Chat::where('listner', $data['user_id'])->get()->last()->count();
		}
		
		if($store){
    	    return response()->json([
    		    'status' => true,
    			'message' => 'Data retrive successfull',
    			'data' => $store
    		]);
    	} else{
          	$payload=array(
              			"type"=>"Call not found",
                        'mobile_no'=>$data['from_id'],
              			'user_id'=>$data['to_id'],
                        "created_at"=>date('Y-m-d H:i:s'),
             			'err_message'=>$data['user_type']
            );
			DB::table('error_logs')->insert($payload);
    		return response()->json([
    		    'status' => true,
    			'message' => 'Data not retrive',
    		]);
        }
	}
	
	//*************************************************************** Message ***************************************************************************************//
	//**************************************************************************************************************************************************************//
	public function get_admin_message($id){
		
		$store = AdminMessage::where('user_id', $id)->orderBy('id', 'desc')->get();
		$count = AdminMessage::where('user_id', $id)->where('read_status', 'not_read')->count();
		
		if(!$store->isEmpty()){
    		return response()->json([
    		       'status' => true,
    			   'message' => 'Data retrive successfull',
    			   'unread_messages' => $count,
    			   'all_messages' => $store,
    			]);
    			
    	} else{
    	    $store = array();
    			   return response()->json([
    		       'status' => true,
    			   'message' => 'Data not retrive',
    			   'unread_messages' => $count,
    			   'all_messages' => $store,
    			]);
		}
	}
	
	public function admin_message_read(Request $request){
		 $data = AdminMessage::where('id', $request->message_id)->update(['read_status'=>'read']);
	      return response()->json([
		       'status' => true,
			   'message' => 'Message read',
			]);
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
//}
  




