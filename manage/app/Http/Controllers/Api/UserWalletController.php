<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\UserWallet;
use App\Models\Api\Wallet;
use App\Models\Registration;
use App\Models\Api\Withdrawal;
use Illuminate\Support\Facades\Session;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class UserWalletController extends Controller
{
    public function no_generated(Request $request){
		$data = $request->validate([
			'amount' => 'required',
		]);
		
		$unique_no = random_int(100000, 999999);
		
		return response()->json([
		       'status' => true,
			   'message' => 'Unique number generated successfully',
			   'data' => $unique_no,
			]);
	}
	
	public function store_wallet(Request $request){
		
		$data = $request->validate([
		      'user_id' => 'required',
		      'mobile_no' => 'required',
		      'cr_amount' => 'required',
		      'payment_id' => 'required',
		      'order_id' => 'required',
		      'signatre_id' => 'required',
		]);
		
		$data['mode'] = 'recharge';
		$data['type'] = 'user';
		
		$store = UserWallet::create($data);
		
		$check_wallet = Wallet::where('user_id', $request->user_id)->count();

        if($check_wallet > 0){
			$check_amount = Wallet::where('user_id', $request->user_id)->first();
            $wallet_amount = $check_amount->wallet_amount+$request->cr_amount;	
			
			$wallet_data = Wallet::where('user_id', $request->user_id)->update([
			'wallet_amount'=> $wallet_amount
			]);
		}else{
			$wallet_data = Wallet::create([
			      'user_id'=>$request->user_id,
				  'wallet_amount'=> $request->cr_amount
			]);
		}		
		
		return response()->json([
		       'status' => true,
			   'message' => 'Transection detaills store successfully',
			   'data' => $store,
		]);
	}
  
   public function createInitialWallet($userId) {
     
    $wallet = new Wallet();
    $wallet->user_id = $userId; 
    $wallet->debit_amount = null;
    $wallet->wallet_amount = 31;
    $wallet->created_at = now(); 
    $wallet->updated_at = now(); 
    $wallet->save();

    return response()->json(['message' => 'Initial wallet created successfully'], 200);
}

	
	public function show_wallet(Request $request, $user_id)
	{
	    $data = Wallet::where('user_id', $user_id)->get();
		 if(!$data->isEmpty()){
			return response()->json([
		       'status' => true,
			   'message' => 'Data retrive successfull',
			   'wallet_amount' => $data,
			]);
		} else {
			return response()->json([
		       'status' => true,
			   'message' => 'Data not retrive',
			   'wallet_amount' => 0,
			]);
	    }
	}
	
// 	public function charge(Request $request){
// 		$data = $request->validate([
// 		      'from_id' => 'required',
// 		      'to_id' => 'required',
//               'duration' => 'required',     
//               'mode' => 'required',
//               'session_id'=>'required'
// 		]);
		
// 		$charge = Registration::where('user_type', 'listner')->first();
// 		//dd($charge);
// 		$rate = $charge->charge;
		
// 		$deduct_amount = $rate*$request->duration;
		
// 		$listener_amount = $deduct_amount/2;
		
// 		//$data['dr_amount'] = $deduct_amount;
// 		//$data['cr_amount'] = $listener_amount;
		
// 		$user_wallet1 = UserWallet::create([
// 			      'user_id'=>$request->from_id,
// 			      'mode'=> $request->mode,
// 			      'type'=> 'user',
// 			      'to_id'=> $request->to_id,
// 				  'dr_amount'=> $deduct_amount,
// 				  'duration' => $request->duration,
// 				  'session_id'=>$request->session_id
// 			]);
			
// 		//	print_r($user_wallet1);
// 		$user_wallet2 = UserWallet::create([
// 			      'user_id'=>$request->to_id,
// 			      'mode'=> $request->mode,
// 			      'type'=> 'listner',
// 				  'to_id'=>$request->from_id,
// 				  'cr_amount'=> $listener_amount,
// 				  'duration' => $request->duration,
// 				  'session_id'=>$request->session_id
// 			]);
		
// 		$check_wallet = Wallet::where('user_id', $request->from_id)->count();

//         if($check_wallet > 0){
// 			$check_amount = Wallet::where('user_id', $request->from_id)->first();
//             $wallet_amount = $check_amount->wallet_amount-$deduct_amount;
			
			
			
// 			$wallet_data = Wallet::where('user_id', $request->from_id)->update([
// 			'wallet_amount'=> $wallet_amount
// 			]);
// 		}else{
// 			$wallet_data = Wallet::create([
// 			      'user_id'=>$request->from_id,
// 				  'wallet_amount'=> 0.00
// 			]);
// 		}
		
// 		$check_wallet2 = Wallet::where('user_id', $request->to_id)->count();

//         if($check_wallet2 > 0){
// 			$check_amount2 = Wallet::where('user_id', $request->to_id)->first();
//             $wallet_amount2 = $check_amount2->wallet_amount+$listener_amount;	
			
// 			$wallet_data2 = Wallet::where('user_id', $request->to_id)->update([
// 			'wallet_amount'=> $wallet_amount2
// 			]);
// 		}else{
// 			$wallet_data2 = Wallet::create([
// 			      'user_id'=>$request->to_id,
// 				  'wallet_amount'=> $listener_amount
// 			]);
// 		}
		
// 		$remaning_wallet = Wallet::where('user_id', $request->from_id)->first();
		
// 		return response()->json([
// 		       'status' => true,
// 			   'remaning_wallet' => $remaning_wallet
// 			]);
// 	}
	
	public function charge(Request $request)	{
			$data = $request->validate([
				'from_id' => 'required',
				'to_id' => 'required',
				'duration' => 'required',
				'mode' => 'required',
				'session_id' => 'required'
			]);
			$user_wallet = Wallet::where('user_id', $request->from_id)->first();
			if (!empty($user_wallet) && ($user_wallet->wallet_amount > 4)) {
				$deduct_amount = 6;
				$listener_amount = $data['mode'] == 'Chat' ? 2.5 : 3;

				$user_wallet1 = UserWallet::create([
					'user_id' => $request->from_id,
					'mode' => $request->mode,
					'type' => 'user',
					'to_id' => $request->to_id,
					'dr_amount' => $deduct_amount,
					'duration' => $request->duration,
					'session_id' => $request->session_id
				]);

				$user_wallet2 = UserWallet::create([
					'user_id' => $request->to_id,
					'mode' => $request->mode,
					'type' => 'listner',
					'to_id' => $request->from_id,
					'cr_amount' => $listener_amount,
					'duration' => $request->duration,
					'session_id' => $request->session_id
				]);

				$check_wallet = Wallet::where('user_id', $request->from_id)->count();
				if ($check_wallet > 0) {
					$check_amount = Wallet::where('user_id', $request->from_id)->first();
					$wallet_amount = $check_amount->wallet_amount - $deduct_amount;
					$wallet_data = Wallet::where('user_id', $request->from_id)->update([
						'wallet_amount' => $wallet_amount
					]);
				} else {
					$wallet_data = Wallet::create([
						'user_id' => $request->from_id,
						'wallet_amount' => 0.00
					]);
				}

				$check_wallet2 = Wallet::where('user_id', $request->to_id)->count();
				if ($check_wallet2 > 0) {
					$check_amount2 = Wallet::where('user_id', $request->to_id)->first();
					$wallet_amount2 = $check_amount2->wallet_amount + $listener_amount;

					$wallet_data2 = Wallet::where('user_id', $request->to_id)->update([
						'wallet_amount' => $wallet_amount2
					]);
				} else {
					$wallet_data2 = Wallet::create([
						'user_id' => $request->to_id,
						'wallet_amount' => $listener_amount
					]);
				}
				$remaning_wallet = Wallet::where('user_id', $request->from_id)->first();
				return response()->json([
					'status' => true,
					'remaning_wallet' => $remaning_wallet
				]);
			} else {
				$payload = array(
					"type" => "Low balance",
					'mobile_no' => "9999999999",
					'user_id' => $request->from_id,
					"created_at" => date('Y-m-d H:i:s'),
					'err_message' => $request->to_id
				);
				DB::table('error_logs')->insert($payload);
				return response()->json([
					'status' => false,
					'msg' => "Low Balance."
				]);
			}
	}






	public function charge_video_call(Request $request)	{
		$data = $request->validate([
				'from_id' => 'required',
				'to_id' => 'required',
				'duration' => 'required',
				'mode' => 'required',
				'session_id' => 'required'
			]);
			$user_wallet = Wallet::where('user_id', $request->from_id)->first();
			if (!empty($user_wallet) && ($user_wallet->wallet_amount > 4)) {
				$deduct_amount = 18;
				$listener_amount = 8;

				$user_wallet1 = UserWallet::create([
					'user_id' => $request->from_id,
					'mode' => $request->mode,
					'type' => 'user',
					'to_id' => $request->to_id,
					'dr_amount' => $deduct_amount,
					'duration' => $request->duration,
					'session_id' => $request->session_id
				]);

				$user_wallet2 = UserWallet::create([
					'user_id' => $request->to_id,
					'mode' => $request->mode,
					'type' => 'listner',
					'to_id' => $request->from_id,
					'cr_amount' => $listener_amount,
					'duration' => $request->duration,
					'session_id' => $request->session_id
				]);

				$check_wallet = Wallet::where('user_id', $request->from_id)->count();
				if ($check_wallet > 0) {
					$check_amount = Wallet::where('user_id', $request->from_id)->first();
					$wallet_amount = $check_amount->wallet_amount - $deduct_amount;
					$wallet_data = Wallet::where('user_id', $request->from_id)->update([
						'wallet_amount' => $wallet_amount
					]);
				} else {
					$wallet_data = Wallet::create([
						'user_id' => $request->from_id,
						'wallet_amount' => 0.00
					]);
				}

				$check_wallet2 = Wallet::where('user_id', $request->to_id)->count();
				if ($check_wallet2 > 0) {
					$check_amount2 = Wallet::where('user_id', $request->to_id)->first();
					$wallet_amount2 = $check_amount2->wallet_amount + $listener_amount;

					$wallet_data2 = Wallet::where('user_id', $request->to_id)->update([
						'wallet_amount' => $wallet_amount2
					]);
				} else {
					$wallet_data2 = Wallet::create([
						'user_id' => $request->to_id,
						'wallet_amount' => $listener_amount
					]);
				}
				$remaning_wallet = Wallet::where('user_id', $request->from_id)->first();
				return response()->json([
					'status' => true,
					'remaning_wallet' => $remaning_wallet
				]);
			} else {
				$payload = array(
					"type" => "Low balance",
					'mobile_no' => "9999999999",
					'user_id' => $request->from_id,
					"created_at" => date('Y-m-d H:i:s'),
					'err_message' => $request->to_id
				);
				DB::table('error_logs')->insert($payload);
				return response()->json([
					'status' => false,
					'msg' => "User doesn't have any Balance."
				]);
			}
	}
  
  
  	public function chargeOld(Request $request)	{
		$lastT = UserWallet::where('user_id', $request->from_id)->orderBy('created_at', 'DESC')->first();
		$timeDiffBetweenT = $lastT['created_at']->diffInSeconds(Carbon::now());
		if ($timeDiffBetweenT > 30) {
			$data = $request->validate([
				'from_id' => 'required',
				'to_id' => 'required',
				'duration' => 'required',
				'mode' => 'required',
				'session_id' => 'required'
			]);
			$user_wallet = Wallet::where('user_id', $request->from_id)->first();
			if (!empty($user_wallet) && ($user_wallet->wallet_amount > 4)) {
				$deduct_amount = 5;
				$listener_amount = 2;

				$user_wallet1 = UserWallet::create([
					'user_id' => $request->from_id,
					'mode' => $request->mode,
					'type' => 'user',
					'to_id' => $request->to_id,
					'dr_amount' => $deduct_amount,
					'duration' => $request->duration,
					'session_id' => $request->session_id
				]);

				$user_wallet2 = UserWallet::create([
					'user_id' => $request->to_id,
					'mode' => $request->mode,
					'type' => 'listner',
					'to_id' => $request->from_id,
					'cr_amount' => $listener_amount,
					'duration' => $request->duration,
					'session_id' => $request->session_id
				]);

				$check_wallet = Wallet::where('user_id', $request->from_id)->count();
				if ($check_wallet > 0) {
					$check_amount = Wallet::where('user_id', $request->from_id)->first();
					$wallet_amount = $check_amount->wallet_amount - $deduct_amount;
					$wallet_data = Wallet::where('user_id', $request->from_id)->update([
						'wallet_amount' => $wallet_amount
					]);
				} else {
					$wallet_data = Wallet::create([
						'user_id' => $request->from_id,
						'wallet_amount' => 0.00
					]);
				}

				$check_wallet2 = Wallet::where('user_id', $request->to_id)->count();
				if ($check_wallet2 > 0) {
					$check_amount2 = Wallet::where('user_id', $request->to_id)->first();
					$wallet_amount2 = $check_amount2->wallet_amount + $listener_amount;

					$wallet_data2 = Wallet::where('user_id', $request->to_id)->update([
						'wallet_amount' => $wallet_amount2
					]);
				} else {
					$wallet_data2 = Wallet::create([
						'user_id' => $request->to_id,
						'wallet_amount' => $listener_amount
					]);
				}
				$remaning_wallet = Wallet::where('user_id', $request->from_id)->first();
				return response()->json([
					'status' => true,
					'remaning_wallet' => $remaning_wallet
				]);
			} else {
				$payload = array(
					"type" => "Low balance",
					'mobile_no' => "9999999999",
					'user_id' => $request->from_id,
					"created_at" => date('Y-m-d H:i:s'),
					'err_message' => $request->to_id
				);
				DB::table('error_logs')->insert($payload);
				return response()->json([
					'status' => false,
					'msg' => "User doesn't have any Balance."
				]);
			}
		} else {
			$payload = array(
				"type" => "Already deducted balance within 30 se",
				'mobile_no' => "9999999999",
				'user_id' => $request->from_id,
				"created_at" => date('Y-m-d H:i:s'),
				'err_message' => $timeDiffBetweenT
			);
			DB::table('error_logs')->insert($payload);
			return response()->json([
				'status' => false,
				'msg' => "Already deducted balance within 30 sec"
			]);
		}
	}
	
  	public function show_listener_transaction(Request $request, $user_id) {
      $data = UserWallet::where('user_id', $user_id)->orderBy('created_at', 'desc')->take(50)->get();
      if($data){
        return response()->json([
		       'status' => true,
			   'message' => 'Success',
			   'transactions' => $data
			]);
      } else {
        return response()->json([
		       'status' => false,
			   'message' => 'Not found',
			   'transactions' => []
			]); 
      }      
    }
  
  
  
  
  
//  public function show_transaction(Request $request, $user_id)
 // { $data = UserWallet::where('user_id', $user_id)->orderBy('created_at', 'desc')->take(50)->get();
  //    if($data){
//        return response()->json([
	//	       'status' => true,
//			   'message' => 'Success',
//			   'transactions' => $data
//			]);
 //     } else {
  //      return response()->json([
//		       'status' => false,
//			   'message' => 'Not found',
//			   'transactions' => []
//			]); 
 //     }      
  //  }
  
  
public function show_transaction(Request $request, $user_id)
{
    $threeMonthsAgo = now()->subMonths(3);
    Log::info("Three months ago: " . $threeMonthsAgo);

    $call_chat_video_data = UserWallet::where('user_id', $user_id)
        ->whereIn('mode', ['Call', 'Chat', 'Video'])
        ->where('created_at', '>=', $threeMonthsAgo)
        ->get();

    $recharges = UserWallet::where('user_id', $user_id)
        ->whereIn('mode', ['recharge', 'withdrawal', 'Manual'])
        ->where('created_at', '>=', $threeMonthsAgo)
        ->get();

    $bonuses_penalties = UserWallet::where('user_id', $user_id)
        ->whereIn('mode', ['bonus', 'penalty'])
        ->where('created_at', '>=', $threeMonthsAgo)
        ->get();

    $reel_gifts = UserWallet::where('user_id', $user_id)
        ->where('mode', 'reel gift')
        ->where('created_at', '>=', $threeMonthsAgo)
        ->get();

    $all_transactions = $call_chat_video_data->merge($recharges)
                                              ->merge($bonuses_penalties)
                                              ->merge($reel_gifts)
                                              ->sortByDesc('created_at');

    if (!$all_transactions->isEmpty()) {
        $transactions = [];

        foreach ($all_transactions as $transaction) {
            $user_name = '';
            $listener_name = '';

            if ($transaction->type == 'user') {
                if (!empty($transaction->user_id)) {
                    $user = Registration::where('id', $transaction->user_id)->first();
                    $user_name = $user ? $user->name : '';
                }
                if (!empty($transaction->to_id)) {
                    $listener = Registration::where('id', $transaction->to_id)->first();
                    $listener_name = $listener ? $listener->name : '';
                }
            } elseif ($transaction->type == 'listner') {
                if (!empty($transaction->user_id)) {
                    $listener = Registration::where('id', $transaction->user_id)->first();
                    $listener_name = $listener ? $listener->name : '';
                }
                if (!empty($transaction->to_id)) {
                    $user = Registration::where('id', $transaction->to_id)->first();
                    $user_name = $user ? $user->name : '';
                }
            }

            $transactions[] = [
                'id' => $transaction->id,
                'user_id' => (string)$transaction->user_id,
                'to_id' => (string)$transaction->to_id,
                'user_name' => $user_name,
                'listner_name' => $listener_name,
                'type' => (string)$transaction->type,
                'mobile_no' => (string)$transaction->mobile_no,
                'mode' => $transaction->mode,
                'duration' => $transaction->duration,
                'cr_amount' => $transaction->cr_amount,
                'dr_amount' => $transaction->dr_amount,
                'payment_id' => $transaction->payment_id,
                'order_id' => $transaction->order_id,
                'signatre_id' => $transaction->signatre_id,
                'created_at' => $transaction->created_at->format('Y-m-d H:i:s'),
                'session_id' => $transaction->session_id,
            ];
        }

        $results = [];
        foreach ($transactions as $match) {
            $results[$match['session_id']][] = $match;
        }

        $trans = collect();
        foreach ($results as $session => $values) {
            $duration = 0;
            $cr_amount = 0.0;
            $dr_amount = 0.0;

            foreach ($values as $value) {
                $duration += $value['duration'];
                $cr_amount += $value['cr_amount'];
                $dr_amount += $value['dr_amount'];
            }

            $values[0]['duration'] = $duration;
            $values[0]['cr_amount'] = $cr_amount;
            $values[0]['dr_amount'] = $dr_amount;
            $trans->push($values[0]);
        }

//        $trans = $trans->concat(
 //           $recharges->map(function ($recharge) {
//                return array_merge(
//                    $recharge->toArray(),
//                    [
 //                       'user_id' => (string)$recharge->user_id,
 //                       'to_id' => $recharge->to_id ? (string)$recharge->to_id : "",
 //                       'user_name' => "",
 //                       'listner_name' => "",
 //                       'mobile_number' => $recharge->mobile_no ?? "",
 //                       'duration' => (float)$recharge->duration,
 //                       'cr_amount' => (float)$recharge->cr_amount,
   //                     'dr_amount' => (float)$recharge->dr_amount,
 //                   ]
   //             );
   //         })
   //     );

        $trans = $trans->concat(
                $recharges->map(function ($recharge) {
                  
                    $adjustedCreatedAt = $recharge->created_at->addHours(5)->addMinutes(30);

                    return array_merge(
                        $recharge->toArray(),
                        [
                            'user_id' => (string) $recharge->user_id,
                            'to_id' => $recharge->to_id ? (string) $recharge->to_id : "",
                            'user_name' => "",
                            'listner_name' => "",
                            'mobile_number' => $recharge->mobile_no ?? "",
                            'duration' => (float) $recharge->duration,
                            'cr_amount' => (float) $recharge->cr_amount,
                            'dr_amount' => (float) $recharge->dr_amount,
                            'created_at' => $adjustedCreatedAt, 
                        ]
                    );
                })
            );

      
        $trans = $trans->concat(
            $bonuses_penalties->map(function ($transaction) {
                return array_merge(
                    $transaction->toArray(),
                    [
                        'user_id' => (string)$transaction->user_id,
                        'to_id' => $transaction->to_id ? (string)$transaction->to_id : "",
                        'user_name' => "",
                        'listner_name' => "",
                        'mobile_number' => $transaction->mobile_no ?? "",
                        'duration' => (float)$transaction->duration,
                        'cr_amount' => (float)$transaction->cr_amount,
                        'dr_amount' => (float)$transaction->dr_amount,
                    ]
                );
            })
        );

        $trans = $trans->concat(
            $reel_gifts->map(function ($transaction) {
                $user_name = '';
                $listener_name = '';

                if (!empty($transaction->user_id)) {
                    $user = Registration::where('id', $transaction->user_id)->first();
                    $user_name = $user ? $user->name : '';
                }
                if (!empty($transaction->to_id)) {
                    $listener = Registration::where('id', $transaction->to_id)->first();
                    $listener_name = $listener ? $listener->name : '';
                }
                       $adjustedCreatedAt = $transaction->created_at->addHours(5)->addMinutes(30);  
                return array_merge(
                    $transaction->toArray(),
                    [
                        'user_id' => (string)$transaction->user_id,
                        'to_id' => $transaction->to_id ? (string)$transaction->to_id : "",
                        'user_name' => $user_name,
                        'listner_name' => $listener_name,
                        'mobile_number' => $transaction->mobile_no ?? "",
                        'duration' => (float)$transaction->duration,
                        'cr_amount' => (float)$transaction->cr_amount,
                        'dr_amount' => (float)$transaction->dr_amount,
                       'created_at' => $adjustedCreatedAt,
                    ]
                );
            })
        );

        $trans = $trans->sortByDesc('created_at')->values();

        return response()->json([
            'status' => true,
            'message' => 'Data retrieved successfully',
            'count' => $trans->count(),
            'transactions' => $trans->slice(0, 250)
        ]);
    } else {
        return response()->json([
            'status' => true,
            'message' => 'Data not retrieved',
            'transactions' => [],
        ]);
    }
}








	public function withdrawal(Request $request){
		$data = $request->validate([
		      'user_id' => 'required',
		      'amount' => 'required',
		      'upi_id' => 'nullable',
		      'account_no' => 'nullable',
		      'ifsc_code' => 'nullable',
		      'bank_name' => 'nullable'
		]);
		
		$wallet_count = Wallet::where('user_id', $request->user_id)->count();
		
		if($wallet_count>0){
		
		    $wallet_amount = Wallet::where('user_id', $request->user_id)->get();
    		foreach($wallet_amount as $wa_amount){
    		    $amount = $wa_amount->wallet_amount;
    		}
		 
		    $data['wallet_amount'] = $amount;
		
    		if($request->amount > $amount){
    			return response()->json([
    		       'status' => true,
    			   'message' => "You don't have sufficient balance, your current wallet amount is ".$amount." "
    		    ]);
    		} else {
        		if(!$request->upi_id == ''){
        		    if($request->amount > 50000){
            	        return response()->json([
            	            'status' => true,
            	            'message' => 'Maximum withdrawal amount is 50000',
            		    ]);
        			} elseif($request->amount < 1500){
        		        return response()->json([
        		            'status' => true,
        			        'message' => 'Minimum withdrawal amount is 1500',
        		        ]);
        		    } else {
            		    $store = Withdrawal::create($data);
                	    return response()->json([
                	        'status' => true,
                		    'message' => 'withdrawal request send',
                			'data' => $store,
                		]);
        		    }
        		} else {
        		    if($request->amount > 15000){
                	    return response()->json([
                	        'status' => true,
                		    'message' => 'Maximum withdrawal amount is 15000',
                		]);
        			} elseif($request->amount < 1500){
        				return response()->json([
                            'status' => true,
        			        'message' => 'Minimum withdrawal amount is 1500',
        		        ]);
        		    } else {
            			$store = Withdrawal::create($data);
            		    return response()->json([
            		       'status' => true,
            			   'message' => 'withdrawal request send',
            			   'data' => $store,
            		    ]);
        		    }
        		}
    	    }
    	} else {
    	    return response()->json([
        		'status' => true,
        		'message' => "You don't have wallet balance"
    		]);
	    }
	}
	
	public function get_withdrawal($id)
	{
		$withdrawal_details = Withdrawal::where('user_id', $id)->get();
		
		 if(!$withdrawal_details->isEmpty()){
		
		return response()->json([
		       'status' => true,
			   'message' => 'Data retrive successfull',
			   'withdrawal_details' => $withdrawal_details
			]);
			 
			 }else{
				 
			   return response()->json([
		       'status' => false,
			   'message' => 'Data not retrive'
			]);
			
		  }
	}
	
	public function withdrawal_cancel($id)
	{
		$Withdrawal = Withdrawal::where('id', $id)->update([
			'status'=> 2
			]);
			return redirect()->back()->with(Session::flash('error','Withdrawal Cancel'));
	}
	
	public function withdrawal_success($id)
	{
	    	
	   	$Withdrawal = Withdrawal::find($id);
    	$debit_amount=$Withdrawal->amount;
	
	
	  $userdwallet=Wallet::where('user_id',$Withdrawal->user_id)->first();

		$Withdrawal_less = Wallet::find($userdwallet->id);
	
      $total_amt=$Withdrawal_less->wallet_amount;
	    $lessamount=($total_amt - $debit_amount);
	    if($debit_amount<=$total_amt){
	    	   
		$Withdrawal_less->wallet_amount=$lessamount;
		$Withdrawal_less->debit_amount=$debit_amount;
	
		$Withdrawal_less->update();
		
		$Withdrawal->status=0;
		$Withdrawal->update();

          $Withdrawalstatus = Withdrawal::where('id',$id)->where('status','0')->count();
	         if($Withdrawalstatus>0){
	   
		     $six_digit_random_number = random_int(100000, 999999);
	    	 $transection_id= time().$six_digit_random_number;
			 $user_wallet1 = UserWallet::create([
			      'user_id'=>$Withdrawal->user_id,
			      'mode'=> 'withdrawal',
			      'type'=> 'listner',
			      'payment_id'=>$transection_id,
				  'dr_amount'=> $debit_amount,
				
				
			]);
	}
     	}
     	else{
     	   	return redirect()->back()->with(Session::flash('success','Withdrawal Cancle No Sufficent Amount in Your Wallet'));
     	  }
     

	
			return redirect()->back()->with(Session::flash('success','Withdrawal Done'));
	}
	
	public function wallet_edit($id){
      	$all_users = Registration::find($id);
      	$wallets = DB::table('wallets')->where('user_id',$id)->get()->last();
    //   	print_r($wallets);
      	if(!$wallets){
      	    $wallets = array('wallet_amount'=>'0.00');
      	    $wallets = (object)$wallets;
      	}
    //   	print_r($wallets);
     	$template['page'] = 'wallet-edit';
		return view('admin.template ', $template, compact('all_users','wallets'));
    }
    
    public function wallet_update(Request $request){
		$data = $request->validate([
		    'user_id' => 'required',
           	'amount' => 'required',
		]);
		
		$user = Registration::where('id', $request->user_id)->first();
		
		
		$wallet_user_data['user_id'] = $request->user_id;
		$wallet_user_data['mode'] = 'Manual';
		$wallet_user_data['type'] = $user->user_type;
		
		if($request->amount > 0){
		    $wallet_user_data['cr_amount'] = $request->amount;
		} else if ($request->amount < 0){
		    $wallet_user_data['dr_amount'] = abs($request->amount);
		}
		
		$store = UserWallet::create($wallet_user_data);
		
		$check_wallet = Wallet::where('user_id', $request->user_id)->count();

        if($check_wallet > 0){
			$check_amount = Wallet::where('user_id', $request->user_id)->first();
            $wallet_amount = $check_amount->wallet_amount+$request->amount;	
			
			$wallet_data = Wallet::where('user_id', $request->user_id)->update([
			'wallet_amount'=> $wallet_amount
			]);
			return redirect()->back()->with(Session::flash('success',' Wallet Update Successfully'));
		}else{
		    if($request->amount > 0){
    		    $wallet_data = Wallet::create([
			      'user_id'=>$request->user_id,
				  'wallet_amount'=> $request->amount
			    ]);
			    return redirect()->back()->with(Session::flash('success','Wallet Update Successfully'));
    		}
		}
    }
public function transaction(Request $request, $user_id)
{
    // Fetch all transactions for the specified user ordered by creation date
    $transactions = UserWallet::where('user_id', $user_id)
        ->orderBy('created_at', 'desc')
        ->get();

    if (!$transactions->isEmpty()) {
        // Extract unique listener IDs in the order they appear
        $listenerIds = [];
        foreach ($transactions as $transaction) {
            if (!in_array($transaction->to_id, $listenerIds) && count($listenerIds) < 6) {
                $listenerIds[] = $transaction->to_id;
            }
        }

        // Fetch listener names for these IDs
        $listeners = Registration::whereIn('id', $listenerIds)
                                ->orderBy('name')
                                ->pluck('name', 'id')
                                ->toArray();

        // Format the listeners data into an array of arrays with 'id' and 'name' keys
        $formattedListeners = [];
        foreach ($listenerIds as $id) {
            if (isset($listeners[$id])) {
                $formattedListeners[] = [
                    'id' => $id,
                    'name' => $listeners[$id],
                ];
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Last 5 listeners who have received transactions from the specified user retrieved successfully',
            'listeners' => $formattedListeners,
        ]);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'No transactions found for the specified user',
            'listeners' => [],
        ]);
    }
}

	
	
}
