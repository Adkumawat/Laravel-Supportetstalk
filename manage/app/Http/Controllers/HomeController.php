<?php

namespace App\Http\Controllers;

use App\Models\Api\ChatRequest;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\User;
use App\Models\Call;
use App\Models\Api\UserWallet;
use App\Models\Api\Report;
use App\Models\AdminMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

// use Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function call_recording(){
        $files = Storage::disk('s3')->files('recordingnew');
        // DB::enableQueryLog();
        // print_r($files);
        foreach($files as $file){
            // echo "<pre>";
            // print_r($file);
            // echo "<br>";
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            if($extension == "mp4"){
              $str = explode('_', $file)[0];
                $fileId = explode('/', $str)[1];
                // echo $fileId;
                $recording_url = Storage::disk('s3')->url($file);
                // echo $recording_url;
                // echo "<br>";
                $data = DB::table('calls')->where('sid', $fileId)->update(['recorded_url'=>$recording_url]);
            } else {
                if(Storage::disk('s3')->exists($file)) {
                    Storage::disk('s3')->delete($file);
                }
            }
        }
        // dd(DB::getQueryLog());
    }

  public function index()
  {
    $missed_chat_list = ChatRequest::where('status','cancelled')
    ->where('created_at', '>', now()->subDays(1)->endOfDay())
		->orderBy('created_at', 'desc')
		->skip(0)
		->take(50)
		->get();
    $missed_call_list = DB::table('call_chat_logs')->where('type', 'call')->where('updated_at', '>', now()->subDays(1)->endOfDay())
      ->orderBy('updated_at', 'desc')
      ->get();
    $recharge_today_list = UserWallet::where('mode', 'recharge')
    ->where('created_at', '>', now()->subDays(1)->endOfDay())
		->orderBy('created_at', 'desc')
		->skip(0)
		->take(50)
		->get();

    $users = Registration::where('user_type', 'user')->count();
    $users_today = Registration::where('user_type', 'user')->where('created_at', '>', now()->subDays(1)->endOfDay())->count();
    $users_7days = Registration::where('user_type', 'user')->where('created_at', '>', now()->subDays(7)->endOfDay())->count();
    $users_30days = Registration::where('user_type', 'user')->where('created_at', '>', now()->subDays(30)->endOfDay())->count();

    $user_count = Registration::where('user_type', 'user')->whereMonth('created_at', Carbon::now()->month)->count();

    $listener_count = Registration::where('user_type', 'listner')->whereMonth('created_at', Carbon::now()->month)->count();

    $manual_recharge_today = UserWallet::select('cr_amount')->where('mode', 'manual')->where('created_at', '>', now()->subDays(1)->endOfDay())->sum('cr_amount');
    $recharge_today = UserWallet::select('cr_amount')->where('mode', 'recharge')->where('created_at', '>', now()->subDays(1)->endOfDay())->sum('cr_amount') + $manual_recharge_today;

    $manual_recharge_yesterday = UserWallet::select('cr_amount')->where('mode', 'manual')->where('created_at', '>', now()->subDays(2)->endOfDay())->where('created_at', '<', now()->subDays(1)->endOfDay())->sum('cr_amount');
    $recharge_yesterday = UserWallet::select('cr_amount')->where('mode', 'recharge')->where('created_at', '>', now()->subDays(2)->endOfDay())->where('created_at', '<', now()->subDays(1)->endOfDay())->sum('cr_amount') + $manual_recharge_yesterday;

    $manual_recharge_7days = UserWallet::select('cr_amount')->where('mode', 'manual')->where('created_at','>',  now()->subDays(7)->endOfDay())->sum('cr_amount');
    $recharge_7days = UserWallet::select('cr_amount')->where('mode', 'recharge')->where('created_at','>',  now()->subDays(7)->endOfDay())->sum('cr_amount') + $manual_recharge_7days;

    $manual_recharge_this_month = UserWallet::select('cr_amount')->where('mode', 'manual')->whereMonth('created_at',Carbon::now()->month)->sum('cr_amount');
    $recharge_this_month = UserWallet::select('cr_amount')->where('mode', 'recharge')->whereMonth('created_at',Carbon::now()->month)->sum('cr_amount') + $manual_recharge_this_month;

	$busy_listeners = Registration::where('user_type', 'listner')->where('busy_status', '=', 1)->count();
    $total_calls_today = UserWallet::where('mode', '=', 'Call')->where('created_at', '>', now()->subDays(1)->endOfDay())->count();
    $total_chats_today = UserWallet::where('mode', '=', 'Chat')->where('created_at', '>', now()->subDays(1)->endOfDay())->count();
    $total_vc_today = UserWallet::where('mode', '=', 'Video')->where('created_at', '>', now()->subDays(1)->endOfDay())->count();
    $total_calls_yesterday = UserWallet::where('mode', '=', 'Call')->where('created_at', '>', now()->subDays(2)->endOfDay())->where('created_at', '<', now()->subDays(1)->endOfDay())->count();
    $total_chats_yesterday = UserWallet::where('mode', '=', 'Chat')->where('created_at', '>', now()->subDays(2)->endOfDay())->where('created_at', '<', now()->subDays(1)->endOfDay())->count();
    $total_vc_yesterday = UserWallet::where('mode', '=', 'Video')->where('created_at', '>', now()->subDays(2)->endOfDay())->where('created_at', '<', now()->subDays(1)->endOfDay())->count();

    // $listener = Registration::select('cr_amount')->where('user_type', 'listner')->sum('cr_amount');

    $listener = Registration::where('user_type', 'listner')->count();

    
    $template['page'] = 'dashboard';
    return view('admin.template ', $template,compact('users',
        'listener','user_count', 'listener_count','users_today','users_7days','users_30days',
        'recharge_today','recharge_yesterday','recharge_7days','recharge_this_month',
        'missed_chat_list','missed_call_list','recharge_today_list','busy_listeners',
        'total_calls_today', 'total_chats_today', 'total_vc_today', 'total_vc_yesterday',
        'manual_recharge_this_month', 'total_calls_yesterday', 'total_chats_yesterday'
        ));
    }
  

 	    public function admin()
    {
	    $admin_count = User::count();
		$admin = User::all();

		$template['page'] = 'admin-list';
		return view('admin.template ', $template, compact('admin_count', 'admin'));
    }

	 public function add_admin()
    {
		$template['page'] = 'add-admin';
		return view('admin.template ', $template);
    }

        public function edit_admin()
    {
		$template['page'] = 'edit-admin';
		return view('admin.template ', $template);
    }

	     public function reset_pass($id)
    {
		$id = $id;
		$template['page'] = 'rpass-admin';
		return view('admin.template ', $template, compact('id'));
    }


    public function view_user(Request $request)
    {

        $users = Registration::with('Wallet')->orderBy('created_at', 'desc')->paginate(50);


        $template['page'] = 'view-user';
        return view('admin.template', $template, compact('users'));
    }


  	public function view_user2(Request $request)
      {
         // print_r($request->id);
         $mobile_no =$request->mobile_no;










          $user_data_6000_12000 = DB::table('registrations')
            ->leftJoin('wallets', 'registrations.id', '=', 'wallets.user_id')
            ->select('registrations.*', 'wallets.wallet_amount')
            ->where('mobile_no', 'like', '%' . $mobile_no . '%')
            ->where('registrations.user_type', '=', 'user')
            ->where('registrations.status', '=', '1')
            ->where('registrations.id', '>', '6000')
            ->orderBy('registrations.created_at', 'desc')->get();


           $users_list_last_7days = $user_data_6000_12000;


        //  ->where('created_at', '>', now()->subDays(30)->endOfDay());


       // dd($user_count);
         //print_r($user_data); die;
		$template['page'] = 'view-user2';
		return view('admin.template ', $template, compact('user_data_6000_12000'));
    }

	public function user_wallet()
    {
		$template['page'] = 'user-wallet';
		return view('admin.template ', $template);
    }

	 public function user_transaction($id)
    {
		$user_transections = DB::table('user_wallets')
		->leftJoin('registrations', 'user_wallets.to_id', '=', 'registrations.id')
		->leftJoin('wallets', 'user_wallets.user_id', '=', 'wallets.user_id')
		->select('user_wallets.*', 'registrations.name','registrations.mobile_no','wallets.wallet_amount')
		->where('user_wallets.type', '=', 'user')
		->where('user_wallets.user_id', '=', $id)
		->orderBy('user_wallets.created_at', 'desc')->get();

		//print_r($user_data); die;
		$template['page'] = 'view-user-transaction';
		return view('admin.template ', $template, compact('user_transections'));
    }



    public function user_call($id)
    {
        //Recording Start
        $this->call_recording();
        //Recording End

        $user_call_data = DB::table('calls')
        ->leftJoin('registrations', 'registrations.id', '=', 'calls.from_id')


        ->select('calls.*', 'registrations.name as username','registrations.mobile_no as mobile_number')
        ->where('calls.from_id',$id)
        ->orderBy('calls.created_at', 'desc')->get();

         $user_call_count = DB::table('calls')
        ->leftJoin('registrations', 'registrations.id', '=', 'calls.from_id')
         ->where('calls.from_id',$id)
        ->select('calls.*', 'registrations.name as username','registrations.mobile_no as mobile_number')

        ->orderBy('calls.created_at', 'desc')->count();

		$template['page'] = 'user-call';
		return view('admin.template ', $template,compact('user_call_data','user_call_count'));

    }

        public function block_user()
    {
		$user_data = DB::table('registrations')->leftJoin('wallets', 'registrations.id', '=', 'wallets.user_id')->select('registrations.*', 'wallets.wallet_amount')->where('registrations.user_type', '=', 'user')->where('registrations.status', '=', '0')->orderBy('registrations.created_at', 'desc')->get();
        $user_count = DB::table('registrations')->leftJoin('wallets', 'registrations.id', '=', 'wallets.user_id')->select('registrations.*', 'wallets.wallet_amount')->where('registrations.user_type', '=', 'user')->where('registrations.status', '=', '0')->orderBy('registrations.created_at', 'desc')->count();

		$template['page'] = 'user-block-account';
		return view('admin.template ', $template, compact('user_data', 'user_count'));
    }

   public function view_listener_kanti(Request $request)
    {

        $query = $request->input('search');
        // Query to fetch listener data with wallet amount
        $listner_data = DB::table('registrations')
        ->leftJoin('wallets', 'registrations.id', '=', 'wallets.user_id')
        ->select('registrations.*', 'wallets.wallet_amount as listner_earning')
        ->where('registrations.user_type', 'listner')
        ->where(function ($q) use ($query) {
            $q->where('registrations.id', 'like', "%$query%")
            ->orWhere('registrations.name', 'like', "%$query%")
            ->orWhere('registrations.mobile_no', 'like', "%$query%");
        })
        ->where('registrations.delete_status', '0')
        ->whereIn('registrations.status', [0, 1]) // Check for both 0 and 1 statuses
        ->get();

        // Count of active listeners
        $listner_count = Registration::where('user_type', 'listner')
        ->where('status', '1')
        ->where('delete_status', '0')
        ->count();

        // Map busy_status to status label
        $listner_data->transform(function ($item) {
            if ($item->busy_status == 1) {
                $item->status_label = 'busy';
            } elseif ($item->busy_status == 0) {
                $item->status_label = 'online';
            } else {
                $item->status_label = 'unknown'; // Default label if busy_status is not 0 or 1
            }
            return $item;
        });

        $template['page'] = 'view-listener';
        return view('admin.template', $template, compact('listner_data', 'listner_count'));
// Return the view with data

    }

public function view_listener(Request $request)
{
    $query = $request->input('search');

    // Query to fetch listener data with wallet amount and online status
    $listner_data = DB::table('registrations')
        ->leftJoin('wallets', 'registrations.id', '=', 'wallets.user_id')
        ->select('registrations.*', 'wallets.wallet_amount as listner_earning', 'registrations.online_status')
        ->where('registrations.user_type', 'listner')
        ->where(function ($q) use ($query) {
            $q->where('registrations.id', 'like', "%$query%")
              ->orWhere('registrations.name', 'like', "%$query%")
              ->orWhere('registrations.mobile_no', 'like', "%$query%");
        })
        ->where('registrations.delete_status', '0')
        ->whereIn('registrations.status', [0, 1]) // Check for both 0 and 1 statuses
        ->latest()->get();

    // Count of active listeners
    $listner_count = Registration::where('user_type', 'listner')
        ->where('status', '1')
        ->where('delete_status', '0')
        ->count();

    // Map busy_status and online_status to status labels
    $listner_data->transform(function ($item) {
        if ($item->busy_status == 1) {
            $item->status_label = 'busy';
        } elseif ($item->busy_status == 0) {
            $item->status_label = 'online';
        } else {
            $item->status_label = 'unknown'; // Default label if busy_status is not 0 or 1
        }

        // Adding logic to map online_status
        if ($item->online_status == 1) {
            $item->online_status_label = 'online';
        } elseif ($item->online_status == 0) {
            $item->online_status_label = 'offline';
        } else {
            $item->online_status_label = 'unknown'; // Default label if online_status is not 0 or 1
        }

        return $item;
    });

    $template['page'] = 'view-listener';
    return view('admin.template', $template, compact('listner_data', 'listner_count'));
}


	public function destroy($id)
    {
    $opportunity = Registration::findOrFail($id);

       // $opportunity->delete_status = 1;


        $opportunity->delete();

     return redirect()->back()->with(Session::flash('success',' Listener deleted Successfully'));
     }
	  public function add_listener()
    {
		$template['page'] = 'add-listener';

		return view('admin.template ', $template);
    }





         public function listener_call($id)
    {
        //Recording Start
       $this->call_recording();
        //Recording End
         $listner_call_data = DB::table('calls')
        ->leftJoin('registrations', 'registrations.id', '=', 'calls.to_id')

        ->select('calls.*', 'registrations.name as listner_name','registrations.mobile_no as mobile_number')
        ->where('calls.to_id',$id)
        ->orderBy('calls.created_at', 'desc')->get();

         $listner_call_count = DB::table('calls')
        ->leftJoin('registrations', 'registrations.id', '=', 'calls.to_id')

        ->select('calls.*', 'registrations.name as listner_name','registrations.mobile_no as mobile_number')
         ->where('calls.to_id',$id)
        ->orderBy('calls.created_at', 'desc')->count();
		$template['page'] = 'listener-call';
		return view('admin.template ', $template, compact('listner_call_count','listner_call_data'));
    }

	public function listener_wallet()
    {
		$template['page'] = 'listener-wallet';
		return view('admin.template ', $template);
    }

        public function listener_payout()
    {
		$listener_payout = DB::table('withdrawals')->leftJoin('registrations', 'withdrawals.user_id', '=', 'registrations.id')->select('withdrawals.*', 'registrations.name', 'registrations.mobile_no')->where('registrations.user_type', '=', 'listner')->orderBy('withdrawals.created_at', 'desc')->get();

		$template['page'] = 'listener-payout';
		return view('admin.template ', $template, compact('listener_payout'));
    }

        public function listener_transaction($id)
    {
	    $listener_transections = DB::table('user_wallets')
		->leftJoin('registrations', 'user_wallets.to_id', '=', 'registrations.id')
		->leftJoin('wallets', 'user_wallets.user_id', '=', 'wallets.user_id')
		->select('user_wallets.*', 'registrations.name','registrations.mobile_no','wallets.wallet_amount')
		->where('user_wallets.type', '=', 'listner')
		->where('user_wallets.user_id', '=', $id)
		->orderBy('user_wallets.created_at', 'desc')->get();

		$template['page'] = 'listener-transaction';
		return view('admin.template ', $template, compact('listener_transections'));
    }

	public function listener_charge()
    {
		$charge = Registration::where('user_type', 'listner')->first();

		$template['page'] = 'listener-charge';
		return view('admin.template ', $template, compact('charge'));
    }

	public function add_charge(Request $request)
	{
		$data = DB::table('registrations')->where('user_type', 'listner')->update(['charge'=>$request->charge]);
	     return redirect()->back()->with(Session::flash('success','Charge Updated'));
	}

        public function block_listener()
    {
		$listner_block = Registration::where('user_type', 'listner')->where('status', '0')->get();
		$listner_count = Registration::where('user_type', 'listner')->where('status', '0')->count();

		$template['page'] = 'listener-block-account';
		return view('admin.template ', $template, compact('listner_block', 'listner_count'));
    }

     public function search_transaction()
    {
        // $transactions = UserWallet::orderBy('created_at', 'desc')->paginate(50);

        $transactions = UserWallet::join('registrations', 'user_wallets.user_id', '=', 'registrations.id')
            ->orderBy('user_wallets.created_at', 'desc')
            ->paginate(50);

		$template['page'] = 'search-transaction';
		return view('admin.template ', $template, compact('transactions'));
    }
		public function search_call()
   {
    // Fetch transactions in descending order based on created_at timestamp
    $transactions = UserWallet::where('mode', 'call')->orderBy('created_at', 'desc')->paginate(50);

    // Return the view with data
    $template['page'] = 'search-transaction';
    return view('admin.template', $template, compact('transactions'));
}

		public function search_chat()
    {
        // Fetch transactions in descending order based on created_at timestamp
        $transactions = UserWallet::where('mode', 'chat')->orderBy('created_at', 'desc')->paginate(50);

        // Return the view with data
        $template['page'] = 'search-transaction';
        return view('admin.template', $template, compact('transactions'));
    }

		public function search_recharge()
     {
        // Fetch transactions in descending order based on created_at timestamp
        $transactions = UserWallet::where('mode', 'recharge')->orderBy('created_at', 'desc')->paginate(50);

        // Return the view with data
        $template['page'] = 'search-transaction';
        return view('admin.template', $template, compact('transactions'));
    }

		public function search_withdrawal()
    {
        // Fetch transactions in descending order based on created_at timestamp
        $transactions = UserWallet::where('mode', 'withdrawal')->orderBy('created_at',
            'desc'
        )->paginate(50);

        // Return the view with data
        $template['page'] = 'search-transaction';
        return view('admin.template', $template, compact('transactions'));
    }

    	public function search_reel()
    {
        // Fetch transactions in descending order based on created_at timestamp
        $transactions = UserWallet::where('mode', 'reel gift')->orderBy('created_at',
            'desc'
        )->paginate(50);

        // Return the view with data
        $template['page'] = 'search-transaction';
        return view('admin.template', $template, compact('transactions'));
    }
    public function search_video()
    {
        // Fetch transactions in descending order based on created_at timestamp
        $transactions = UserWallet::where('mode', 'video')->orderBy('created_at', 'desc')->paginate(50);

        // Return the view with data
        $template['page'] = 'search-transaction';
        return view('admin.template', $template, compact('transactions'));
    }

   public function search_penalty()
    {
        // Fetch transactions in descending order based on created_at timestamp
        $transactions = UserWallet::where('mode', 'penalty')->orderBy('created_at', 'desc')->paginate(50);

        // Return the view with data
        $template['page'] = 'search-transaction';
        return view('admin.template', $template, compact('transactions'));
    }

	public function send_notification()
    {

        // $user_data = DB::table('registrations')->where('registrations.user_type', '=', 'user')->where('registrations.status', '=', '1')->where('registrations.device_token','!=','')->orderBy('registrations.created_at', 'desc')->get();
        // $listeners = DB::table('registrations')->where('registrations.user_type', '=', 'listner')->where('registrations.status', '=', '1')->where('registrations.device_token','!=','')->orderBy('registrations.created_at', 'desc')->get();

        $template['page'] = 'send-notification';
		return view('admin.template ', $template);
    }

    public function fetchUsers(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 20;
        $search = $request->input('search', '');

        $query = DB::table('registrations')
            ->where('user_type', 'user')
            ->where('status', '1')
            ->where('device_token', '!=', '');

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('mobile_no', 'like', "%$search%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')
            ->offset(($page - 1) * $perPage)
            ->limit($perPage)
            ->get(['id', DB::raw('concat(name, " ", mobile_no) as text')]);

        $totalUsers = $query->count();

        return response()->json([
            'items' => $users,
            'total' => $totalUsers
        ]);
    }

    public function fetchListeners(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 20;
        $search = $request->input('search', '');

        $query = DB::table('registrations')
            ->where('user_type', 'listner')
            ->where('status', '1')
            ->where('device_token', '!=', '');

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('mobile_no', 'like', "%$search%");
            });
        }

        $listeners = $query->orderBy('created_at', 'desc')
            ->offset(($page - 1) * $perPage)
            ->limit($perPage)
            ->get(['id', DB::raw('concat(name, " ", mobile_no) as text')]);

        $totalListeners = $query->count();

        return response()->json([
            'items' => $listeners,
            'total' => $totalListeners
        ]);
    }

  	public function search_bonus()
    {
        // Fetch transactions in descending order based on created_at timestamp
        $transactions = UserWallet::where('mode', 'bonus')->orderBy('created_at', 'desc')->paginate(50);

        // Return the view with data
        $template['page'] = 'search-transaction';
        return view('admin.template', $template, compact('transactions'));
    }

    public function fcm_push_notification($regId, $title,$body,$imagepath){
        // print_r($regId);
        // echo $title;
        // echo $body;
        // echo $imagepath;

// 		 print_r($regId);
        // die();
        //Send Push Notification

        $arrNotification= array();
        $arrNotification["title"] = $title;
        $arrNotification["body"] = $body;
        $arrNotification["image"] = $imagepath;
        $arrNotification["default_sound"] = true;
        $arrNotification["type"] = 1;

        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'registration_ids' => $regId,
            // 'registration_ids' => array('f2mq13T0TGeOvm_0ojBe_c:APA91bH1XXPqpFJgiSe_os87mhJMka57W_Dtl8T06oyOk3uhPaCPBvBVej9kRtDfZWmE6x2ct_ubNEBuwriXXDuFSAmkswnkmCLmszchXzMTcPMjyi7TFurjwKN_WVENOY8EkazT6C06'),
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
//           return $result;
    }

    public function submit_notification(Request $request)
    {

        Log::info($request);

        $regId = array();

        $data = $request->validate([
            'users'=>'required',
            'selected_users'=>'nullable',
            'selected_listeners'=>'nullable',
			'title' => 'required',
			'msg' => 'required',
			'image' => 'nullable',
			'url' => 'nullable',
		]);

		$url1 =  url('/');
		if($request->file('image')){
           $file = $request->file('image');

			if($file)
			{
			 $filename = $file->getClientOriginalName();
			 $file->move(public_path('uploads/images'),$filename);
			 $name=$filename;
			}
			else{
				$name=$request->oldfilename;
			}
         $imagepath= ('/public/uploads/images/'.$filename);
         $imagepath = $url1.$imagepath;
        } else {
            $imagepath = $url1.'/images/logo-small.png';
        }

		$title = $request->title;
		$body = $request->msg;

		if($request->users == "1"){
		    $user_data = DB::table('registrations')->select('device_token')->where('registrations.user_type', '=', 'user')->where('registrations.status', '=', '1')->where('registrations.device_token','!=','')->orderBy('registrations.created_at', 'desc')->get()->toArray();
		    foreach($user_data as $data){
		        $regId[] = $data->device_token;
		    }
		} elseif($request->users == "2"){
		    $user_data = DB::table('registrations')->select('device_token')->where('registrations.user_type', '=', 'listner')->where('registrations.status', '=', '1')->where('registrations.device_token','!=','')->orderBy('registrations.created_at', 'desc')->get()->toArray();
		    foreach($user_data as $data){
		        $regId[] = $data->device_token;
		    }
		} elseif($request->users == "3"){
		    $selected_users = $request->selected_users;
		    foreach($selected_users as $selected_user){
		        $user_data = DB::table('registrations')->select('device_token')->where('registrations.id', '=', $selected_user)->first();
		         $regId[] = $user_data->device_token;
		    }
		} elseif($request->users == "4") {
		     $selected_listeners = $request->selected_listeners;
		    foreach($selected_listeners as $selected_listener){
		        $listener_data = DB::table('registrations')->select('device_token')->where('registrations.id', '=', $selected_listener)->first();
		         $regId[] = $listener_data->device_token;
		    }
		}

		foreach(array_chunk($regId, 1000) as $x){
                // array_chunk() will divide $arr_a into smaller array as [[1, 2, 3..., 500],[501, 502, .... , 1000] and so one till 5000]
                $this->fcm_push_notification($x,$title,$body,$imagepath);
        }
        // die();
	   return redirect()->route('send-notification')->with(Session::flash('success','Notification sent successfully'));
    }

	 public function offence_report(Request $request)
    {
	    $mobile_no =$request->mobile_no;

		$report = DB::table('reports')
		->leftJoin('registrations', 'reports.from_id', '=', 'registrations.id')
		->select('reports.*', 'registrations.name','registrations.mobile_no')
		->where('mobile_no', 'like', '%'.$mobile_no.'%')
		->orderBy('reports.created_at', 'desc')->get();

		$template['page'] = 'offence-reported';
		return view('admin.template ', $template, compact('report'));
    }
	 public function user_chat($id)
    {
        $chats = DB::table('chats')
		->leftJoin('registrations', 'chats.listner', '=', 'registrations.id')
		->select('chats.*', 'registrations.name as listner_name','registrations.mobile_no as mobile_number')

		->where('chats.user',$id)
		->orderBy('chats.created_at', 'desc')->get();
          $documents  = $chats;

        $jsonData = json_decode(file_get_contents('https://firestore.googleapis.com/v1/projects/support-stress-free/databases/(default)/documents/chatroom'), true);
        //?pageToken=AFTOeJy7rX0cUQPrJt56o48HdO05tbQGkHm7NYRivH3GEHYhXGPb1kWgeW8ECSdbBj9C8_2e3afGuJUcGKcs149VK3-FxL5rqVFbtfPRIEZPz85RWl7506niBmwPKZvaOo-_

       // $documents = $jsonData['documents'];



        $template['page'] = 'user-chat';
		return view('admin.template ', $template, compact('documents'));
    }

     public function listener_chat($id)
    {
        $chats = DB::table('chats')
		->leftJoin('registrations', 'chats.user', '=', 'registrations.id')
		->select('chats.*', 'registrations.name as user_name','registrations.mobile_no as mobile_number')

		->where('chats.listner',$id)
		->orderBy('chats.created_at', 'desc')->get();
          $documents  = $chats;


         $jsonData = json_decode(file_get_contents('https://firestore.googleapis.com/v1/projects/support-stress-free/databases/(default)/documents/chatroom'), true);
        //?pageToken=AFTOeJy7rX0cUQPrJt56o48HdO05tbQGkHm7NYRivH3GEHYhXGPb1kWgeW8ECSdbBj9C8_2e3afGuJUcGKcs149VK3-FxL5rqVFbtfPRIEZPz85RWl7506niBmwPKZvaOo-_

       // $documents = $jsonData['documents'];

		$template['page'] = 'listener-chat';
		return view('admin.template ', $template ,compact('documents'));
    }
    public function view_chat($data)
    {

        $jsonDatainfo = json_decode(file_get_contents('https://firestore.googleapis.com/v1/projects/support-stress-free/databases/(default)/documents/chatroom/'.$data), true);
        $jsonData = json_decode(file_get_contents('https://firestore.googleapis.com/v1/projects/support-stress-free/databases/(default)/documents/chatroom/'.$data.'/chats'), true);
        $datas = $jsonData['documents'];

        $datasdetails = $jsonDatainfo['fields'];


        $template['page'] = 'view-chat';
		return view('admin.template ', $template, compact('datas','datasdetails'));
    }
  public function view_chat_listener($data)
    {

        $jsonDatainfo = json_decode(file_get_contents('https://firestore.googleapis.com/v1/projects/support-stress-free/databases/(default)/documents/chatroom/'.$data), true);
        $jsonData = json_decode(file_get_contents('https://firestore.googleapis.com/v1/projects/support-stress-free/databases/(default)/documents/chatroom/'.$data.'/chats'), true);
        $datas = $jsonData['documents'];

        $datasdetails = $jsonDatainfo['fields'];


        $template['page'] = 'view-chat';
		return view('admin.template ', $template, compact('datas','datasdetails'));
    }

  	public function edit_listener($id)
    {



        $listeners = Registration::findOrFail($id);


        $template['page'] = 'edit-listener';

		return view('admin.template ', $template ,compact('listeners'));

     }


    //Messages by Demon
    public function send_message()
    {

        $user_data = DB::table('registrations')->where('registrations.user_type', '=', 'user')->where('registrations.status', '=', '1')->where('registrations.device_token','!=','')->orderBy('registrations.created_at', 'desc')->get();
        $listeners = DB::table('registrations')->where('registrations.user_type', '=', 'listner')->where('registrations.status', '=', '1')->where('registrations.device_token','!=','')->orderBy('registrations.created_at', 'desc')->get();

        $template['page'] = 'send-message';
		return view('admin.template ', $template, compact('user_data','listeners'));
    }

    public function submit_message(Request $request){
        $regId = array();

        $data = $request->validate([
            'users'=>'required',
            'selected_users'=>'nullable',
            'selected_listeners'=>'nullable',
			'title' => 'required',
			'msg' => 'required',
			'link' => 'nullable',
			'image' => 'nullable',
			'url' => 'nullable',
		]);

		$url1 =  url('/');
// 		print_r($request->file('image'));
        if(!$request->link){
            $request->link = '';
        }

		if($request->file('image')){
           $file = $request->file('image');

			if($file)
			{
			 $filename = $file->getClientOriginalName();
			 $file->move(public_path('uploads/images'),$filename);
			 $name=$filename;
			}
			else{
				$name=$request->oldfilename;
			}
         $imagepath= ('/public/uploads/images/'.$filename);
         $imagepath = $url1.$imagepath;
        } else {
            $imagepath = $url1.'/images/logo-small.png';
        }

		if($request->users == "1"){
		    $user_data = DB::table('registrations')->select('id')->where('registrations.user_type', '=', 'user')->where('registrations.status', '=', '1')->where('registrations.device_token','!=','')->orderBy('registrations.created_at', 'desc')->get()->toArray();
		    foreach($user_data as $data) {
		      //  print_r($data->id);
		        $regId[] = $data->id;
		    }
		} elseif($request->users == "2") {
		    $user_data = DB::table('registrations')->select('id')->where('registrations.user_type', '=', 'listner')->where('registrations.status', '=', '1')->where('registrations.device_token','!=','')->orderBy('registrations.created_at', 'desc')->get()->toArray();
		    foreach($user_data as $data){
		        $regId[] = $data->id;
		    }
		} elseif($request->users == "3") {
		    $selected_users = $request->selected_users;
		    foreach($selected_users as $selected_user){
		        $user_data = DB::table('registrations')->select('id')->where('registrations.id', '=', $selected_user)->first();
		         $regId[] = $user_data->id;
		    }
		} elseif($request->users == "4") {
		    $selected_listeners = $request->selected_listeners;
		    foreach($selected_listeners as $selected_listener){
		        $listener_data = DB::table('registrations')->select('id')->where('registrations.id', '=', $selected_listener)->first();
		         $regId[] = $listener_data->id;
		    }
		}

		$messages['title'] = $request->title;
		$messages['link'] = $request->link;
		$messages['message'] = $request->msg;
		$messages['image'] = $imagepath;

        foreach($regId as $regid){
            $messages['user_id'] = $regid;
            // print_r($messages);
            $store = AdminMessage::create($messages);
        }
	   return redirect()->route('send-message')->with(Session::flash('success','Message sent successfully'));
    }


}
