<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Listner;
use App\Models\Api\ChatRequest;
use App\Models\Registration;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Api\Feedback;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ListnerController extends Controller
{
	   public function toggleStatus($id)
{
    // Find the registration record
    $registration = Registration::findOrFail($id);

    // Toggle the status
    $newStatus = $registration->busy_status == 0 ? 1 : 0;
    $registration->busy_status = $newStatus;
    $registration->save();

    // Return JSON response
    return response()->json([
        'message' => 'Busy status toggled successfully.',
        'new_status' => $newStatus,
        'registration' => $registration
    ]);
}
  
  
  public function getListeners(Request $request)
{
    // Total number of modes to distribute
    $totalModes = 20;

    // Predefined list of modes
    $modesList = [
        'Happy', 'Angry', 'Bored', 'Disappointed', 'Embarassed', 'Hungry',
        'Lonely', 'Hurt', 'Nervous', 'Proud', 'Relaxed', 'Scared', 'Surprised',
        'Upset', 'Worried', 'Sick', 'Silly', 'Stressed', 'Excited', 'Tired'
    ];

    // Retrieve data from the registrations table based on user type
    $listeners = DB::table('registrations')
        ->where('user_type', 'listner')
        ->get()
        ->toArray();

    // Calculate the number of listeners
    $listenerCount = count($listeners);

    // Calculate how many listeners each mode should be assigned to
    $listenersPerMode = ($listenerCount > 0) ? ceil($listenerCount / $totalModes) : 0;

    // Debugging information
    Log::info('Listener count: ' . $listenerCount);
    Log::info('Listeners per mode: ' . $listenersPerMode);

    // Shuffle listeners to ensure randomness
    shuffle($listeners);

    // Initialize the modes structure
    $modes = array_fill_keys($modesList, []);

    // Add modes to listeners
    foreach ($listeners as $index => $listener) {
        $modeIndex = $index % $totalModes;
        $modes[$modesList[$modeIndex]][] = $listener->id;
    }

    // Prepare the final modes structure
    $finalModes = array_fill_keys($modesList, []);

    // Reassign listeners from one mode to the next
    for ($i = 0; $i < $totalModes; $i++) {
        $currentMode = $modesList[$i];
        $nextMode = $modesList[($i + 1) % $totalModes];
        $finalModes[$nextMode] = $modes[$currentMode];
    }

    if ($listenerCount > 0) {
        return response()->json([
            'status' => true,
            'message' => 'Data retrieved successfully',
            'modes' => $finalModes
        ]);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Data not retrieved',
            'modes' => null,
        ], 400);
    }
}

  
  
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

	public function update_listner_images(Request $request, Registration $registration)
	{
		// Check if the user_type is not 'listner', abort the request with a 404
		if ($registration->user_type !== "listner") {
			return response()->json([
				'success' => false,
				'message' => 'The user is not a listener.',
			], 404);
		}

		// Validate the request to ensure an image is provided
		$validator = Validator::make($request->all(), [
			'image' => 'required|file|max:5120', // max size of 5MB (5 * 1024 KB)
		]);

		if ($validator->fails()) {
			return response()->json([
				'success'=> false,
				'message' => 'Validation error',
				'errors' => $validator->errors(),
			], 400);
		}

		// Define the path where the image will be stored
		$directory = public_path('image/listner');
		
		// Ensure the directory exists or create it
		if (!File::exists($directory)) {
			File::makeDirectory($directory, 0755, true);
		}

		// Get the uploaded image file
		$image = $request->file('image');

		// Get the original image name and extension
		$originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
		$extension = $image->getClientOriginalExtension();

		// Generate a new filename with the original name and current timestamp
		$filename = Str::slug($originalName) . '_' . time() . '.' . $extension;

		// Define allowed extensions
		$allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];

		// Check if the file extension is allowed
		if (!in_array($extension, $allowedExtensions)) {
			return response()->json([
				'success'=> false,
				'message' => 'Invalid image type. Only jpeg, jpg, png, and gif are allowed.',
			], 400);
		}

		// Check if an image already exists in the database for the listener
		if (!empty($registration->image)) {
			// Get the current image path
			if (PHP_OS === "WINNT") {
				// Use full path for Windows
				$currentImagePath = public_path($registration->image);
			} else {
				// Strip "public/" prefix for Linux
				$currentImagePath = public_path(substr($registration->image, 7));
			}
	
			// If the current image exists in the filesystem, delete it
			if (File::exists($currentImagePath)) {
				File::delete($currentImagePath);
			}
		}

		// Move the uploaded image to the destination directory with the new filename
		$image->move($directory, $filename);

		// Update the image path in the database
		$registration->update(['image' => "image/listner/$filename"]);

		// Return a successful response with the new image path
		return response()->json([
			"success"=> true,
			'message' => 'Listener image updated successfully.',
			'image_path' => asset("image/listner/$filename"),
		], 200);
	}
  
 	public function update_listner_image(Request $request, Registration $registration)
	{
		log::info($registration->user_type);
		abort_if($registration->user_type !== "listner", 404);
		$request->validate([
			'image' => 'required|image'
		]);

		$file = $request->file('image');
		$filename = $file->getClientOriginalName();


		$file->move('public/image/listner', $filename);

		try {
			// if listner image previously exists, remove it
			if ($registration->image) {
				if (PHP_OS === "WINNT") {
					$path = public_path($registration->image);
				} else {
					// strip "public/" prefix from $registration->image for linux
					$path = public_path(substr($registration->image, 7));
				}
				unlink($path);
			}
		} catch (Exception $ex) {
			return response()->json([
				'status' => false,
				'message' => $ex->getMessage()
			], 500);
		}

		$registration->update(['image' => "public/image/listner/$filename"]);

		return response()->json([
			'status' => true,
			'message' => 'success'
		]);
	}
  
  	public function set_listner_password(Request $request)  {
        $id = $request->id;
		$password = $request->password;
      	
        $setPass = DB::table('registrations')->where('id', $id)->update(['helping_category'=>$password]);
      
		if($setPass){
			  return response()->json([
				'status' => true,
				'message' => 'Data updated successfull',
				'data' => $setPass,
			 ]);
		} else {
			return response()->json([
				'status' => false,
				'message' => 'Data not updated',
				'data' => null,
			 ], 400);
		}     	
    }
       
	
	
	 public function show_allListner(Request $request)
    {
       // $data = Registration::where('user_type', 'listner')->get();
        $data = DB::table('registrations')->select('registrations.*','feedbacks.rating as rating ')->leftJoin('feedbacks','feedbacks.to_id','=','registrations.id')->get();
       // print_r( $data);
        	//echo	 $total_rating = Feedback::where('to_id', $id)->sum('rating');
        if($data){
            foreach($data as $listner_data){
    	 $id = $listner_data->id;

	 $total_rating = Feedback::where('to_id', $id)->sum('rating');
	 
	
		 $count_rating = Feedback::where('to_id', $id)->whereNotIn('rating', [0])->count();
		 $count_5 = Feedback::where('to_id', $id)->where('rating', 5)->count();
		 $count_4 = Feedback::where('to_id', $id)->where('rating', 4)->count();
		 $count_3 = Feedback::where('to_id', $id)->where('rating', 3)->count();
		 $count_2 = Feedback::where('to_id', $id)->where('rating', 2)->count();
		 $count_1 = Feedback::where('to_id', $id)->where('rating', 1)->count();
		 $count_0 = Feedback::where('to_id', $id)->where('rating', 0)->count();
		
		  $total_review = DB::table('feedbacks')->where('to_id', $id)->get();
		  
		  $post_ago = [];
		  
		 
		 foreach($total_review as $total_feedback){
			 $id = $total_feedback->id;
			 $from_id = $total_feedback->from_id;
			 $to_id = $total_feedback->to_id;
			 $review = $total_feedback->review;
			 $rating = $total_feedback->rating;
			 $time = $total_feedback->created_at;
			 $ago_time = \Carbon\Carbon::parse($time)->diffForHumans();
			
			 
           $post_ago[] = array(
             'id' => $id,
             'from_id' => $from_id,
             'to_id' => $to_id,
             'review' => $review,
             'rating' => $rating,
             'created_at' => $ago_time
             );
		 }
		
			 if($count_rating){
			     
			 $average_rating = round($total_rating/$count_rating, 1);
			 if($count_5==0){
				 $average_rating_5 = 0;
			 }else{
				 $average_rating_5 = round(($count_5/$count_rating)*100);
			 }
			 if($count_4==0){
				 $average_rating_4 = 0;
			 }else{
				 $average_rating_4 = round(($count_4/$count_rating)*100);
			 }
			 if($count_3==0){
				 $average_rating_3 = 0;
			 }else{
				 $average_rating_3 = round(($count_3/$count_rating)*100);
			 }
			 if($count_2==0){
				 $average_rating_2 = 0;
			 }else{
				 $average_rating_2 = round(($count_2/$count_rating)*100);
			 }
			 if($count_1==0){
				 $average_rating_1 = 0;
			 }else{
				 $average_rating_1 = round(($count_1/$count_rating)*100);
			 }
			 }
			  $review = [];
			 
			   $review []= array(
             'average_rating' => $average_rating,
			   '%_rating_5' => $average_rating_5,
			   '%_rating_4' => $average_rating_4,
			   '%_rating_3' => $average_rating_3,
			   '%_rating_2' => $average_rating_2,
			   '%_rating_1' => $average_rating_1,
			   'rating_5' => $count_5,
			   'rating_4' => $count_4,
			   'rating_3' => $count_3,
			   'rating_2' => $count_2,
			   'rating_1' => $count_1,
			   'rating_0' => $count_0,
			   'all_reviews' => $post_ago,
			 
             );
            }
            
            
          
        }	
	
		  if($data){
		return response()->json([
		       'status' => true,
			   'message' => 'Data retrive successfull',
			   // 'data' => $data,
			   // 'review'=> $review,
			   // 'id' => $id,
			     'all_reviews' => $post_ago,
			  
			]);
		  }else{
			  return response()->json([
		       'status' => false,
			   'message' => 'Data not retrive',
			   'data' => null,
			], 400);
		  }
    }
    
    
    
    //Demon's Code
    function sort_listeners_by_rating($listeners){
        
        $listneres_with_5 = [];
        $listneres_with_4 = [];
        $listneres_with_3 = [];
        $listneres_with_2 = [];
        $listneres_with_1 = [];
        $listneres_with_0 = [];
        
        $listeners_count = count($listeners);
        for($i = 0; $i<$listeners_count;$i++){
            $id = $listeners[$i]['id'];

			log::info('id'.$id);
    
            $total_rating = Feedback::where('to_id', $id)->sum('rating');
			log::info('total_rating -> '.$total_rating);
    	    $count_rating = Feedback::where('to_id', $id)->whereNotIn('rating', [0])->count();
			log::info('count_rating -> '.$count_rating);
    	    $count_5 = Feedback::where('to_id', $id)->where('rating', 5)->count();
    	    $count_4 = Feedback::where('to_id', $id)->where('rating', 4)->count();
    	    $count_3 = Feedback::where('to_id', $id)->where('rating', 3)->count();
    	    $count_2 = Feedback::where('to_id', $id)->where('rating', 2)->count();
    	    $count_1 = Feedback::where('to_id', $id)->where('rating', 1)->count();
    	    $count_0 = Feedback::where('to_id', $id)->where('rating', 0)->count();
    	    $total_review_count = DB::table('feedbacks')->where('to_id', $id)->count();
        	$total_review = DB::table('feedbacks')->where('to_id', $id)->get()->toArray();
        	$post_ago = [];
    	  
    	    $index = 0;
            foreach(@array_reverse($total_review) as $total_feedback){
                $index = $index + 1;
                
                if($index < 40){
                    $id = $total_feedback->id;
            		$from_id = $total_feedback->from_id;
            		$to_id = $total_feedback->to_id;
            		$review = $total_feedback->review;
            		$rating = $total_feedback->rating;
            		$time = $total_feedback->created_at;
            		$ago_time = \Carbon\Carbon::parse($time)->diffForHumans();
            		// print_r($ago_time); die;
            		$post_ago[] = array(
                        'id' => "$id",
                        'from_id' => "$from_id",
                        'to_id' => "$to_id",
                        'review' => $review,
                        'rating' => "$rating",
                        'created_at' => $ago_time
                    );
                }
        	}
    		
    		if($count_rating){ 
        		$average_rating = round($total_rating/$count_rating, 1);
        		if($count_5==0){
        		    $average_rating_5 = 0;
        		}else{
        		    $average_rating_5 = round(($count_5/$count_rating)*100);
        		}
        		if($count_4==0){
        		    $average_rating_4 = 0;
        	    }else{
        		    $average_rating_4 = round(($count_4/$count_rating)*100);
        		}
        		if($count_3==0){
        		    $average_rating_3 = 0;
        		}else{
        		    $average_rating_3 = round(($count_3/$count_rating)*100);
        		}
        		if($count_2==0){
        		    $average_rating_2 = 0;
        		}else{
        			 $average_rating_2 = round(($count_2/$count_rating)*100);
        		}
        		if($count_1==0){
        		    $average_rating_1 = 0;
        		}else{
        		    $average_rating_1 = round(($count_1/$count_rating)*100);
        		}
            } else {
                $average_rating = 0;
                $average_rating_5 = 0;
                $average_rating_4 = 0;
                $average_rating_3 = 0;
                $average_rating_2 = 0;
                $average_rating_1 = 0;
                $count_5 = 0;
                $count_4 = 0;
                $count_3 = 0;
                $count_2 = 0;
                $count_1 = 0;
                $count_0 = 0;
            }
            $listeners[$i]['total_review_count'] = @$total_review_count;
            $listeners[$i]['average_rating'] = @$average_rating;
            $listeners[$i]['rating_reviews'] = array(
                                  'average_rating' => @$average_rating,
                    			   '%_rating_5' => @$average_rating_5,
                    			   '%_rating_4' => @$average_rating_4,
                    			   '%_rating_3' => @$average_rating_3,
                    			   '%_rating_2' => @$average_rating_2,
                    			   '%_rating_1' => @$average_rating_1,
                    			   'rating_5' => @$count_5,
                    			   'rating_4' => @$count_4,
                    			   'rating_3' => @$count_3,
                    			   'rating_2' => @$count_2,
                    			   'rating_1' => @$count_1,
                    			   'rating_0' => @$count_0,
                    			   'all_reviews' => @$post_ago, 
                                );
                                
            
        }
        
    //    $key_values = array_column($listeners, 'total_review_count'); 
     //   array_multisort($key_values, SORT_DESC, $listeners);
   
        return $listeners;
    }
    
    
    public function rankListners($online_listeners){
		$online = $online_listeners;
		$listeners_count = count($online);
		
        for($i = 0; $i<$listeners_count;$i++){
			$ob = (object) $online_listeners[$i];
			if($ob->id == 1783){
				array_splice($online, $i, 1);
				array_splice($online, 0, 0, array($ob));
			} else if($ob->id == 4280){
				array_splice($online, $i, 1);
				array_splice($online, 1, 0, array($ob));
			}
        }

		return $online;
	}
     
	public function show_all_Listner_list(Request $request)
	{
		$listners = DB::table('registrations')
			->where('user_type', 'listner')
			->get()
			->toArray();
	
		$sorted_listners = $this->sortlistners($listners);

		$listnerIds = array_column($sorted_listners, 'id');
		$listnerStats = DB::table('listner_stats')
			->whereIn('id', $listnerIds)
			->get();
	
		$listnerStatsMap = [];
		foreach ($listnerStats as $stats) {
			$listnerStatsMap[$stats->id] = [
				'avg_rating' => $stats->avg_rating,
				'rating_count' => $stats->rating_count,
			];
		}

		foreach ($sorted_listners as &$listner) {
			$listnerId = $listner->id;
			if (isset($listnerStatsMap[$listnerId])) {
			// $listner->avg_rating = $listnerStatsMap[$listnerId]['avg_rating'];
			// $listner->avg_rating = floor($listnerStatsMap[$listnerId]['avg_rating'] * 10) / 10;
			$listner->avg_rating = sprintf("%.1f", ceil($listnerStatsMap[$listnerId]['avg_rating'] * 10) / 10);

			log::info('listner id ->'. $listnerId);
			log::info('listner average rating ->'. $listner->avg_rating);
				$listner->rating_count = $listnerStatsMap[$listnerId]['rating_count'];
			} else {
				$listner->avg_rating = "0.0";
				$listner->rating_count = 0;
			}
		}

		if ($sorted_listners) {
			return response()->json([
				'status' => true,
				'message' => 'Data retrieved successfully',
				'data' => $sorted_listners
			]);
		} else {
			return response()->json([
				'status' => false,
				'message' => 'Data not retrieved',
				'data' => null,
			], 400);
		}
	}

	public function show_all_Listner_listV2(Request $request)
	{
		$listners_list = Registration::where('user_type', 'listner')->get()->toArray();

		$sorted_listners = self::sortlistnersV2($listners_list);

		$listeners_count = count($sorted_listners);
		for($i = 0; $i < $listeners_count; $i++) {
			$id = $sorted_listners[$i]['id'];

			// Retrieve the necessary data
			$total_rating = Feedback::where('to_id', $id)->sum('rating');
			$count_rating = Feedback::where('to_id', $id)->whereNotIn('rating', [0])->count();

			// Calculate average ratings
			if ($count_rating) {
				$average_rating = round($total_rating / $count_rating, 1);
			} else {
				$average_rating = 0.0;
			}

			// Save the calculated data to each listener
			$sorted_listners[$i]['total_review_count'] = Feedback::where('to_id', $id)->count();
			$sorted_listners[$i]['average_rating'] = $average_rating;
		}

		// Merge the sorted listeners
		$listners = array_merge($sorted_listners);

		if ($listners) {
			return response()->json([
				'status' => true,
				'message' => 'Data retrieved successfully',
				'data' => $listners
			]);
		} else {
			return response()->json([
				'status' => false,
				'message' => 'Data not retrieved',
				'data' => null,
			], 400);
		}
	}

    private function sortlistners($listeners)
    {
        $organized_listeners = [
            'online' => [],
            'busy' => [],
            'offline' => [],
        ];

        // Separate listeners by online_status and busy_status
        foreach ($listeners as $listener) {
            if ($listener->online_status == 1 && $listener->busy_status == 0) {
                // Online and not busy
                $organized_listeners['online'][] = $listener;
            } elseif ($listener->online_status == 1 && $listener->busy_status == 1) {
                // Online and busy
                $organized_listeners['busy'][] = $listener;
            } elseif ($listener->online_status == 0 && $listener->busy_status == 0) {
                // Offline and not busy
                $organized_listeners['offline'][] = $listener;
            } else {
				// Log::info('Listener skipped', ['id' => $listener->id]);
			}
        }

        // Define the sequence to sort other listeners
        // $sequence = ['all', 'chat & cal', 'video & au', 'audio call', 'video call'];

		$sequence = ['all', 'chat & cal', 'call,chat', 'chat,call', 'video & au'];
        $sorted_listeners = [];

        // Sort listeners within each status group according to the sequence
        foreach (['online', 'busy', 'offline'] as $status) {
            foreach ($sequence as $value) {
                if (isset($organized_listeners[$status])) {
                    foreach ($organized_listeners[$status] as $listener) {
                        if ($listener->available_on === $value) {
                            $sorted_listeners[] = $listener;
                        }
                    }
                }
            }
        }

		// log::info($sorted_listeners);

        return $sorted_listeners;
    }

	private function sortlistnersV2($listeners)
	{
		$organized_listeners = [
			'online' => [],
			'busy' => [],
			'offline' => [],
		];

		foreach ($listeners as $listener) {
			if ($listener['online_status'] == 1 && $listener['busy_status'] == 0) {
				$organized_listeners['online'][] = $listener;
			} elseif ($listener['online_status'] == 1 && $listener['busy_status'] == 1) {
				$organized_listeners['busy'][] = $listener;
			} elseif ($listener['online_status'] == 0 && $listener['busy_status'] == 0) {
				$organized_listeners['offline'][] = $listener;
			}
		}

		$sequence = ['all', 'chat & cal', 'call,chat', 'chat,call', 'video & au'];
		$sorted_listeners = [];

		foreach (['online', 'busy', 'offline'] as $status) {
			foreach ($sequence as $value) {
				if (isset($organized_listeners[$status])) {
					foreach ($organized_listeners[$status] as $listener) {
						if ($listener['available_on'] === $value) {
							$sorted_listeners[] = $listener;
						}
					}
				}
			}
		}	

		return $sorted_listeners;
	}
  
 public function show_all_Listner(Request $request)
    {
        // Cache settings
        $folder_name = "cache";
        $api_name = 'admin';
        if (!is_dir($folder_name)) {
            mkdir($folder_name, 0777, true);
        }
        $cache_expire_time = 2; // seconds
        $create_cache_key = md5($api_name);

        if (file_exists("$folder_name/{$create_cache_key}.json") && (time() - filemtime("$folder_name/{$create_cache_key}.json")) < $cache_expire_time) {
            // Data is cached, retrieve it
            $datas = file_get_contents("$folder_name/{$create_cache_key}.json");
            if ($datas) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data retrieve successful',
                    'data' => json_decode($datas, true),
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data not retrieved',
                    'data' => null,
                ], 400);
            }
        } else {
            // Data is not cached, retrieve and organize it
            $online_listeners = DB::select('CALL get_online_listeners()');
            $busy_listeners = DB::select('CALL get_busy_listeners()');
            $offline_listeners = DB::select('CALL get_offline_listeners()');

            $online_listeners = self::sort_listeners_by_rating(json_decode(json_encode($online_listeners), true));
            $busy_listeners = self::sort_listeners_by_rating(json_decode(json_encode($busy_listeners), true));
            $offline_listeners = self::sort_listeners_by_rating(json_decode(json_encode($offline_listeners), true));

            // Organize online listeners by available_on values
            $sorted_online_listeners = $this->sortListeners($online_listeners);
            $sorted_busy_listeners = $this->sortListeners($busy_listeners);
            $sorted_offline_listeners = $this->sortListeners($offline_listeners);

            // Flatten the sorted listeners
            $sorted_data = array_merge($sorted_online_listeners, $sorted_busy_listeners, $sorted_offline_listeners);

            file_put_contents("$folder_name/{$create_cache_key}.json", json_encode($sorted_data));

            if ($sorted_data) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data retrieve successful',
                    'data' => $sorted_data
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data not retrieve',
                    'data' => null,
                ], 400);
            }
        }
    }

    private function sortListeners($listeners)
    {
        $organized_listeners = [];
        foreach ($listeners as $listener) {
            $available_on = $listener['available_on'];
            if (!isset($organized_listeners[$available_on])) {
                $organized_listeners[$available_on] = [];
            }
            $organized_listeners[$available_on][] = $listener;
        }

        // Arrange the data
        $sorted_listeners = [];
        $sequence = ['all', 'chat & cal', 'video & au', 'audio call', 'video call'];
        foreach ($sequence as $value) {
            if (isset($organized_listeners[$value])) {
                $sorted_listeners = array_merge($sorted_listeners, $organized_listeners[$value]);
                unset($organized_listeners[$value]);
            }
        }
        // Merge the rest of the available_on values
        foreach ($organized_listeners as $value) {
            $sorted_listeners = array_merge($sorted_listeners, $value);
        }

        return $sorted_listeners;
    }


  
   public function show_all_Listner_2(Request $request){
      
     $online_listeners = DB::select('CALL get_online_listeners()');
      	$busy_listeners = DB::select('CALL get_busy_listeners()');
      	$offline_listeners = DB::select('CALL get_offline_listeners()');
        $online_listeners = $online_listeners;
     	$busy_listeners = self::sort_listeners_by_rating(json_decode (json_encode($busy_listeners), true));
    	$offline_listeners = self::sort_listeners_by_rating(json_decode (json_encode($offline_listeners), true));
 
        $datas = array_merge($online_listeners,$busy_listeners,$offline_listeners);
        
     
        if($datas){
		    return response()->json([
		       'status' => true,
			   'message' => 'Data retrive successful',
              	'count' => count($datas),
			   'data' => $datas
			]);
		} else{
		    return response()->json([
		       'status' => false,
			   'message' => 'Data not retrive',
			   'data' => null,
			], 400);
		} 
      
    }
  
  	public function get_listner_by_id(Request $request){
        $online_listeners = Registration::where('id', $request->id)->where('user_type', 'listner')->get()->toArray();


		log::info('Before');
		log::info($online_listeners);
        
		
        $online_listeners = self::sort_listeners_by_rating($online_listeners);

		log::info('After');
		log::info($online_listeners);
		

        $datas = array_merge($online_listeners);
        
        
        if($datas){
		    return response()->json([
		       'status' => true,
			   'message' => 'Data retrive successfull',
			   'data' => $datas,
			  
			]);
		} else{
		    return response()->json([
		       'status' => false,
			   'message' => 'Data not retrive',
			   'data' => null,
			], 400);
		}  
    }
  
  
    public function update_call_chat_logs(Request $request)  {		
        DB::table('registrations')->where('id', $request->listner_id)->update(['online_status'=>0]);
     	DB::table('registrations')->where('id', $request->listner_id)->update(['busy_status'=>0]);
      
        $user_id = $request->input('user_id');
        $listner_id = $request->input('listner_id');
        $type = $request->input('type');
        $event = $request->input('event');
        $data=array('user_id'=>$user_id,"listner_id"=>$listner_id,"type"=>$type,"event"=>$event,"updated_at"=>Carbon::now()->toDateTimeString());
        DB::table('call_chat_logs')->insert($data);
        return response()->json([
          'status' => true,
          'message' => 'Data updated successfull'
        ]);
    }
    
    public function update_user_call_chat_logs(Request $request) {
		$data = $request->validate([
			'user_id' => 'required|numeric',
			'listner_id' => 'required|numeric',
			'type' => 'required|in:call,video'
		]);
		Registration::where('id', $data['listner_id'])->update(['busy_status' => 0]);
		DB::table('call_chat_logs')->insert([
			'user_id' => $data['user_id'],
			"listner_id" => $data['listner_id'],
			"type" => $data['type'],
			"event" => 1,
			"updated_at" => now()->toDateTimeString(),
		]);
		return response()->json([
			'status' => true,
			'message' => 'Data updated successfull'
		]);
	}

  	// To track errors while generating OTP's
	public function log_errors(Request $request)  {		
		$mobile_no = $request->input('mobile_no');
		$err_message = $request->input('err_message');
      
		$data=array(
          			'mobile_no'=>$mobile_no,
                    "type"=>"OTP Error",
                    "created_at"=>date('Y-m-d H:i:s'),
          			"user_id"=>"null",
          			"err_message"=>$err_message
        );
		DB::table('error_logs')->insert($data);
		return response()->json([
			'status' => true,
			'message' => 'Data updated successfull'
			]);
	}
  
	//Update Listner
	public function update_listner(Request $request)  {		
		$id = $request->id;
		if(!empty($id)){
			$data = $request->validate([
				'available_on' => 'required',
		 	]);
		   	$store = Registration::find($id);
		   
		   $data['available_on'] = strtolower($data['available_on']);
		  
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
		} else {
			return response()->json([
				'status' => false,
				'message' => 'Data not updated',
				'data' => null,
			 ], 400);
		}     	
    }
    
    //Search By Demon
    public function search(Request $request)
	{
		$searchTerm = $request->search_keywords;
		$reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
		$searchTerm = str_replace($reservedSymbols, ' ', $searchTerm);
		$searchValues = preg_split('/\s+/', $searchTerm, -1, PREG_SPLIT_NO_EMPTY);

		if (count($searchValues) === 0) $count = 0;
		else {
			$datas = Registration::where('user_type', 'listner')->where(function ($q) use ($searchValues) {
				foreach ($searchValues as $value) {
					$q->orWhere('name', 'like', "{$value}%");
				}
			})
				->with('feedbacks')
				->get();
			$count = $datas->count();
		}
		for ($i = 0; $i < $count; $i++) {
			$feedbacks = $datas[$i]->feedbacks;
			// map rating points to number of received ratings, eg. ['5' => 1225, '3' => 100, ...]
			$rating_counts = $feedbacks->groupBy('rating')->map(fn ($ratings) => count($ratings));

			$total_rating = $feedbacks->sum('rating');
			$count_rating = $feedbacks->where('rating', '>', 0)->count();

			$rating_counts = $rating_counts->toArray();
			$getRatingCount = fn ($key) => array_key_exists($key, $rating_counts) ? $rating_counts[$key] : 0;

			$count_5 = $getRatingCount('5');
			$count_4 = $getRatingCount('4');
			$count_3 = $getRatingCount('3');
			$count_2 = $getRatingCount('2');
			$count_1 = $getRatingCount('1');
			$count_0 = $getRatingCount('0');

			$total_review = $datas[$i]->feedbacks;

			$post_ago = [];

			foreach ($total_review as $total_feedback) {
				$id = $total_feedback->id;
				$from_id = $total_feedback->from_id;
				$to_id = $total_feedback->to_id;
				$review = $total_feedback->review;
				$rating = $total_feedback->rating;
				$time = $total_feedback->created_at;
				$ago_time = \Carbon\Carbon::parse($time)->diffForHumans();
				// print_r($ago_time); die;
				$post_ago[] = array(
					'id' => $id,
					'from_id' => $from_id,
					'to_id' => $to_id,
					'review' => $review,
					'rating' => $rating,
					'created_at' => $ago_time
				);
			}

			if ($count_rating) {
				$average_rating = round($total_rating / $count_rating, 1);
				if ($count_5 == 0) {
					$average_rating_5 = 0;
				} else {
					$average_rating_5 = round(($count_5 / $count_rating) * 100);
				}
				if ($count_4 == 0) {
					$average_rating_4 = 0;
				} else {
					$average_rating_4 = round(($count_4 / $count_rating) * 100);
				}
				if ($count_3 == 0) {
					$average_rating_3 = 0;
				} else {
					$average_rating_3 = round(($count_3 / $count_rating) * 100);
				}
				if ($count_2 == 0) {
					$average_rating_2 = 0;
				} else {
					$average_rating_2 = round(($count_2 / $count_rating) * 100);
				}
				if ($count_1 == 0) {
					$average_rating_1 = 0;
				} else {
					$average_rating_1 = round(($count_1 / $count_rating) * 100);
				}
			} else {
				$average_rating = 0;
				$average_rating_5 = 0;
				$average_rating_4 = 0;
				$average_rating_3 = 0;
				$average_rating_2 = 0;
				$average_rating_1 = 0;
				$count_5 = 0;
				$count_4 = 0;
				$count_3 = 0;
				$count_2 = 0;
				$count_1 = 0;
				$count_0 = 0;
			}

			$datas[$i]['average_rating'] = $average_rating;
			$datas[$i]['total_review_count'] = $count_rating;

			$datas[$i]['rating_reviews'] = array(
				'%_rating_5' => @$average_rating_5,
				'%_rating_4' => @$average_rating_4,
				'%_rating_3' => @$average_rating_3,
				'%_rating_2' => @$average_rating_2,
				'%_rating_1' => @$average_rating_1,
				'rating_5' => @$count_5,
				'rating_4' => @$count_4,
				'rating_3' => @$count_3,
				'rating_2' => @$count_2,
				'rating_1' => @$count_1,
				'rating_0' => @$count_0,
				'all_reviews' => @$post_ago,
			);
		}
		if (isset($datas)) {
			return response()->json([
				'status' => true,
				'search_result' => $datas,
				'searcg_msg' => 'Data Found'
			]);
		} else {
			$datas = array();
			return response()->json([
				'status' => false,
				'search_result' => $datas,
				'search_msg' => 'Data not available',
			]);
		}
	}

	
	//Chat Request
	public function chat_request(Request $request){
        $data = $request->validate([
		      'from_id' => 'required',
		      'to_id' => 'required'
		]);
		
		$listener_busy_status = Registration::where('id', $request->to_id)->first();
		if($listener_busy_status->busy_status == '0'){
		
    		$check_request = ChatRequest::where('from_id', $request->from_id)->where('to_id', $request->to_id)->where('status', 'requested')->count();
    			
    		if($check_request > 0){
    			return response()->json([
    		       'status' => true,
    			   'message' => 'You already Requested.',
    			]);
    		} else {
    		    $busy_status = DB::table('registrations')->where('id', $request->to_id)->update(['busy_status'=>1]);
    		    $store = ChatRequest::create($data);
    		    $user_name = DB::table('registrations')->where('id', $request->from_id)->first()->name;
    		    $regId[] = DB::table('registrations')->where('id', $request->to_id)->first()->device_token;
    		    //Send Notification
    			$url =  url('/');
    			$imagepath = $url.'/images/logo-small.png';
    			$arrNotification= array();          
    			$arrNotification["title"] = 'Chat request from User';                           
    			$arrNotification["body"] = $user_name.' requested to chat. You can Approve or Decline.';
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
    // 			curl_setopt($ch, CURLOPT_URL, $url);
    // 			curl_setopt($ch, CURLOPT_POST, true); 
    // 			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // 			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // 			// Disabling SSL Certificate support temporarly
    // 			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    // 			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    // 			$result = curl_exec($ch);
    
    //         	if ($result === FALSE) {
    // 				die('Curl failed: ' . curl_error($ch));
    // 			}
    // 			curl_close($ch);
    			return response()->json([
    		       'status' => true,
    			   'message' => 'You can Chat only after Listener Approve.',
    			   'data' => $store,
    			   'busy_status' => 'chat_requested'
    			]);
    		}
		} else {
            return response()->json([
    		       'status' => true,
    			   'message' => 'Listener Busy',
    			   'busy_status' => true
    			]);
        }
    }
    
       public function update_chat_request(Request $request){
	    
	    $id = $request->request_id;
		if(!empty($id)){
		    $data = $request->validate([
				'status' => 'required',
		 	]);
		   	$store = ChatRequest::find($id);
		    $data['status'] = strtolower($data['status']);
		    if($store){
		        if($request->status == 'decline'){
    		   	    $busy_status = DB::table('registrations')->where('id', $store->to_id)->update(['busy_status'=>'0']);
    		   	}
          //      if($request->status == 'cancelled'){
    	//	   	    $busy_status = DB::table('registrations')->where('id', $store->to_id)->update(['online_status'=>'0']);
    	//	   	}
			    $store->update($data);
    			return response()->json([
    			    'status' => true,
    				'message' => 'Data updated successfull',
    				'data' => $store,
    			]);
		    } else {
    			return response()->json([
    			    'status' => false,
    				'message' => 'Data not updated',
    				'data' => null,
    			], 400);
    		}
		} else {
			return response()->json([
				'status' => false,
				'message' => 'Data not updated',
				'data' => null,
			 ], 400);
		}
	}
	
	public function get_chat_request($id){
		$store = ChatRequest::where('id', $id)->get();
		
		if(!$store->isEmpty()){
		    return response()->json([
		       'status' => true,
			   'message' => 'Data retrive successfull',
			   'data' => $store,
			]);
			
		} else{
		    $store = array();
			   return response()->json([
		       'status' => true,
			   'message' => 'Data not retrive',
			]);
		}
	}
	
	public function listener_chat_request($id){
		
		$stores = ChatRequest::where('to_id', $id)->where('status', 'requested')->get();
		foreach($stores as $store){
		    $created_at = $store['created_at'];
		    if(strtotime('Now') >= strtotime($created_at. ' +02 minutes')){
		        $update_chat_request = ChatRequest::find($store['id']);
		        $data['status'] = 'cancelled';
		        $busy_status = DB::table('registrations')->where('id', $id)->update(['busy_status'=>'0']);
		        $update_chat_request->update($data);
		    } 
		}
		$stores = ChatRequest::where('to_id', $id)->where('status', 'requested')->get();
		$requested_count = ChatRequest::where('to_id', $id)->where('status', 'requested')->count();
		$approve_count = ChatRequest::where('to_id', $id)->where('status', 'approve')->count();
		$decline_count = ChatRequest::where('to_id', $id)->where('status', 'decline')->count();
		
		if(!$stores->isEmpty()){
		    return response()->json([
		       'status' => true,
			   'message' => 'Data retrive successfull',
			   'requested_count' => $requested_count,
			   'approve_count' => $approve_count,
			   'decline_count' => $decline_count,
			   'requests' => $stores,
			]);
			
		} else{
		    $store = array();
			   return response()->json([
		       'status' => true,
			   'message' => 'Data not retrive',
			]);
		}
	}
	
	public function user_chat_request($id){
		
		$stores = ChatRequest::where('from_id', $id)->where('status', 'requested')->get();
		$requested_count = ChatRequest::where('from_id', $id)->where('status', 'requested')->count();
		$approve_count = ChatRequest::where('from_id', $id)->where('status', 'approve')->count();
		$decline_count = ChatRequest::where('from_id', $id)->where('status', 'decline')->count();
		$cancelled_count = ChatRequest::where('from_id', $id)->where('status', 'cancelled')->count();
		
		if(!$store->isEmpty()){
		    return response()->json([
		       'status' => true,
			   'message' => 'Data retrive successfull',
			   'requested_count' => $requested_count,
			   'approve_count' => $approve_count,
			   'decline_count' => $decline_count,
			   'cancelled_count' => $cancelled_count,
			   'requests' => $stores,
			]);
			
		} else{
		    $store = array();
			   return response()->json([
		       'status' => true,
			   'message' => 'Data not retrive',
			]);
		}
	}
}






