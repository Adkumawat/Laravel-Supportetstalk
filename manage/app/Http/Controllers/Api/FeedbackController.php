<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Feedback;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;

class FeedbackController extends Controller
{
    public function feedback(Request $request) {
		
		$data = $request->validate([
		      'from_id' => 'required',
		      'to_id' => 'required',
		      'review' => 'nullable',
		      'rating' => 'nullable'
		]);
		
		$feed_store = Feedback::create($data);
		
		if($feed_store){
		    return response()->json([
		       'status' => true,
			   'message' => 'Feedback store successfully',
			   'data' => $feed_store,
		]);
		}else{
		     return response()->json([
		       'status' => false,
			   'message' => 'Feedback not store, some error',
		]);
		}
		
		
	}
	
	public function view_feedbacks(Request $request) {
		
		$store = Feedback::all();
		
		return response()->json([
		       'status' => true,
			   'message' => 'Feedback retrive successfull',
			   'data' => $store,
			]);
	}
	
	public function all_reviews(Request $request) {
		
		 $id = $request->user_id;
		
		 $total_rating = Feedback::where('to_id', $id)->sum('rating');
		 //$count_rating = Feedback::where('to_id', $id)->whereNotNull('rating')->count();
		 $count_rating = Feedback::where('to_id', $id)->whereNotIn('rating', [0])->count();
		 $count_5 = Feedback::where('to_id', $id)->where('rating', 5)->count();
		 $count_4 = Feedback::where('to_id', $id)->where('rating', 4)->count();
		 $count_3 = Feedback::where('to_id', $id)->where('rating', 3)->count();
		 $count_2 = Feedback::where('to_id', $id)->where('rating', 2)->count();
		 $count_1 = Feedback::where('to_id', $id)->where('rating', 1)->count();
		 $count_0 = Feedback::where('to_id', $id)->where('rating', 0)->count();
		 //$total_review = Feedback::where('to_id', $id)->get();
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
			 
		
		return response()->json([
		       'status' => true,
			   'message' => 'Avarage ratings & all reviews retrive successfull',
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
			]);
	}else{
		return response()->json([
		       'status' => false,
			   'message' => 'Data no avilable',
			]);
	}
	}
	   
}
