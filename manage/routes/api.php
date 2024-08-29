<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Api\UserWalletController;
use App\Http\Controllers\Api\ListnerController;
use App\Http\Controllers\AgoraDynamicKey\AgoraTokanController;
use App\Http\Controllers\Api\FeedbackController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/toggle-status/{id}', [ListnerController::class, 'toggleStatus']);

Route::post('/update-device-token', [RegistrationController::class, 'updateDeviceToken']);
Route::post('/registrations', [RegistrationController::class, 'store']);
Route::post('/registerWithEmail', [RegistrationController::class, 'registerWithEmail']);
Route::post('/registrations-test', [RegistrationController::class, 'store2']);
Route::get('/users', [RegistrationController::class, 'index']);
Route::get('/permanent_delete_user/{id}', [RegistrationController::class, 'permanent_delete_user']);
Route::get('/user/{id}', [RegistrationController::class, 'show']);
Route::post('/registrations/{id}', [RegistrationController::class, 'update']);
Route::post('/delete', [RegistrationController::class, 'destroy']);


Route::get('/create-initial-wallet/{userId}', [UserWalletController::class, 'createInitialWallet']);

Route::post('/no_generated', [UserWalletController::class, 'no_generated']);
Route::post('/store_wallet', [UserWalletController::class, 'store_wallet']);
Route::get('/show_wallet/{id}', [UserWalletController::class, 'show_wallet']);

Route::get('mode', [ListnerController::class, 'getListeners']);
// Route::get('/listner-list', [ListnerController::class, 'show_all_Listner_list']);
Route::get('/listner-list', [ListnerController::class, 'show_all_Listner_listV2']);
Route::get('/listners', [ListnerController::class, 'show_all_Listner']);
Route::get('/listners-new', [ListnerController::class, 'show_all_Listner_2']);
Route::get('/listner/{id}', [ListnerController::class, 'get_listner_by_id']);
Route::post('/set-listner-password', [ListnerController::class, 'set_listner_password']);
// Route::post('/listner/{registration}/update-image', [ListnerController::class, 'update_listner_image']);
Route::post('/update_listner', [ListnerController::class, 'update_listner']);
Route::post('/call_chat_logs', [ListnerController::class, 'update_call_chat_logs']);
Route::post('/user-missed', [ListnerController::class, 'update_user_call_chat_logs']);
Route::get('/recent_listner/{id}', [UserWalletController::class, 'transaction']);


Route::post('/log_errors', [ListnerController::class, 'log_errors']);
Route::get('/listener_chat_request/{id}', [ListnerController::class, 'listener_chat_request']);
Route::post('/chat_request', [ListnerController::class, 'chat_request']);
Route::post('/update_chat_request', [ListnerController::class, 'update_chat_request']);
Route::get('/user_chat_request/{id}', [ListnerController::class, 'user_chat_request']);
Route::get('/get_chat_request/{id}', [ListnerController::class, 'get_chat_request']);

Route::post('/agoraToken', [AgoraTokanController::class, 'agora_Token']);

Route::post('/feedback', [FeedbackController::class, 'feedback']);
Route::get('/view_feedbacks', [FeedbackController::class, 'view_feedbacks']);
Route::post('/all_reviews', [FeedbackController::class, 'all_reviews']);

Route::post('/search', [ListnerController::class, 'search']);

Route::post('/nickname', [RegistrationController::class, 'nickname']);
Route::get('/nickname_get/{id}', [RegistrationController::class, 'nickname_get']);

Route::post('/charge', [UserWalletController::class, 'charge']);
Route::post('/charge_video_call', [UserWalletController::class, 'charge_video_call']);
Route::get('/show_transaction/{id}', [UserWalletController::class, 'show_transaction']);
Route::get('/show-listener-transaction/{id}', [UserWalletController::class, 'show_listener_transaction']);

Route::post('/onlineOfline', [RegistrationController::class, 'onOf_status']);

Route::post('/block', [RegistrationController::class, 'block']);
Route::post('/report', [RegistrationController::class, 'report']);

Route::post('/bellnotify', [RegistrationController::class, 'bellnotify']);

Route::get('/get_notification/{id}', [RegistrationController::class, 'get_notification']);
Route::post('/notification_read', [RegistrationController::class, 'notification_read']);

Route::post('/withdrawal', [UserWalletController::class, 'withdrawal']);

Route::get('/get_withdrawal/{id}', [UserWalletController::class, 'get_withdrawal']);

Route::post('/busy_status', [RegistrationController::class, 'busy_status']);


//yash
Route::post('/chats', [RegistrationController::class, 'chats']);
Route::post('/get_chat', [RegistrationController::class, 'get_chat']);
Route::post('/chat_end', [RegistrationController::class, 'chat_end']);
Route::post('/messages', [RegistrationController::class, 'messages']);
Route::post('/call_start', [RegistrationController::class, 'call_start']);
Route::post('/call_end', [RegistrationController::class, 'call_end']);
Route::post('/get_call', [RegistrationController::class, 'get_call']);
Route::post('/get_call_test', [RegistrationController::class, 'get_call_test']);
Route::get('/create_token', [AgoraTokanController::class, 'create_Token']);

//Admin Message
Route::get('/get_admin_message/{id}', [RegistrationController::class, 'get_admin_message']);
Route::post('/admin_message_read', [RegistrationController::class, 'admin_message_read']);


Route::post('/listner/{registration}/update-image', [ListnerController::class, 'update_listner_images']);