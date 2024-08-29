<?php

namespace App\Http\Controllers\AgoraDynamicKey;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use App\Http\Controllers\AgoraDynamicKey\RtcTokenBuilder;
use App\Models\Registration;

class AgoraTokanController extends Controller
{
    public function agora_Token(Request $request){
	
	$data = $request->validate([
			'user_id' => 'required',
		]);
	
	$data = Registration::where('id', $request->user_id)->first();
	
	if($data){
	  $appID = "ffbd24b671cf47469f9e8fc7df7eb7b6";
      $appCertificate = "07990efb749746d08b325a66239017ed";
$channelName = "7d72365eb983485397e3e3f9d460bdda";
$uid = 2882341273;
$uidStr = "2882341273";
$role = RtcTokenBuilder::RoleAttendee;
$expireTimeInSeconds = 3600;
$currentTimestamp = (new DateTime("now", new DateTimeZone('UTC')))->getTimestamp();
$privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

$token_with_int_uid = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);
//echo 'Token with int uid: ' . $token . PHP_EOL;

$token_with_uaccount = RtcTokenBuilder::buildTokenWithUserAccount($appID, $appCertificate, $channelName, $uidStr, $role, $privilegeExpiredTs);
//echo 'Token with user account: ' . $token . PHP_EOL;

		return response()->json([
					   'status' => true,
					   'channel_name' => $channelName,
					   'token_with_int_uid' =>  $token_with_int_uid,
					   'token_with_uaccount' =>  $token_with_uaccount,
					   'uid' => $uid,
					   'uidStr' => $uidStr,
					   'device_token' => $data->device_token
					]);
	}else{
	    return response()->json([
					   'status' => false,
					   'message' => "This user does't exist",
					]);
	}



	}
	
	
	public function create_Token(){
	    
	    $appId = "11644e46dc56453b9da54562219452bd";
        $appCertificate = "59ea93f5358e45ed9618a24861fea728";
        $expireTimeInSeconds = 860000;
        
        
        $room_id = strval(rand(100000, 999999));
        $agora_uid_one = strval(rand(1000000, 9999999));
        $agora_uid_two = strval(rand(1000000, 9999999));
        $currentTimestamp = (new DateTime("now", new DateTimeZone('UTC')))->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
	
	    $token_one = RtcTokenBuilder::buildTokenWithUid($appId, $appCertificate, $room_id, $agora_uid_one, 2, $privilegeExpiredTs);
        //echo 'Token with int uid: ' . $token . PHP_EOL;
        
        $token_two = RtcTokenBuilder::buildTokenWithUid($appId, $appCertificate, $room_id, $agora_uid_two, 2, $privilegeExpiredTs);
        //echo 'Token with int uid: ' . $token . PHP_EOL;
        
       return response()->json([
            "room_id" =>$room_id,
            "agora_uid_one"=> $agora_uid_one,
            "agora_uid_two"=> $agora_uid_two,
            "token_one"=> $token_one,
            "token_two"=> $token_two
           ]);
	}
	
	//Demon's Code Date 17-01-2022
	public static function createRecordingToken($channel_id){
	    
	    $appId = "38d72d8d7a90490a80f2fb9e328f2e8a";
        $appCertificate = "f9ce459e414d4c31852bc3904287f5c1";
        $expireTimeInSeconds = 860000;
        
        
        $room_id = $channel_id;
        $agora_uid_one = strval(rand(1000000, 9999999));
        $agora_uid_two = strval(rand(1000000, 9999999));
        $currentTimestamp = (new DateTime("now", new DateTimeZone('UTC')))->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
	
	    $token_one = RtcTokenBuilder::buildTokenWithUid($appId, $appCertificate, $room_id, $agora_uid_one, 2, $privilegeExpiredTs);
        //echo 'Token with int uid: ' . $token . PHP_EOL;
        
        $token_two = RtcTokenBuilder::buildTokenWithUid($appId, $appCertificate, $room_id, $agora_uid_two, 2, $privilegeExpiredTs);
        //echo 'Token with int uid: ' . $token . PHP_EOL;
        
        return ['recording_token'=>$token_one, 'recording_uid'=>$agora_uid_one];
        // return $token_one;
	}
}
