<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Api\UserWalletController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
//Route::post('/listeners/{id}/toggle-online-status', [ListenerController::class, 'toggleOnlineStatus'])->name(toggleOnlineStatus);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');
Route::post('/cretae_admin', [RegistrationController::class, 'cretae_admin'])->name('cretae_admin');
Route::get('/admin-block/{id}', [RegistrationController::class, 'Adminblock'])->name('admin-block');
Route::get('/admin-unblock/{id}', [RegistrationController::class, 'Adminunblock'])->name('admin-unblock');

Route::get('/add-admin', [App\Http\Controllers\HomeController::class, 'add_admin'])->name('add-admin');

Route::get('/resetPass/{id}', [App\Http\Controllers\HomeController::class, 'reset_pass'])->name('resetPass');
Route::post('/rpass_admin', [RegistrationController::class, 'rpass_admin'])->name('rpass_admin');

Route::get('/view-user/', [App\Http\Controllers\HomeController::class, 'view_user'])->name('view-user');
Route::get('/view-user2/', [App\Http\Controllers\HomeController::class, 'view_user2'])->name('view-user2');

Route::get('/user-wallet', [App\Http\Controllers\HomeController::class, 'user_wallet'])->name('user-wallet');

Route::get('/user-transaction/{id}', [App\Http\Controllers\HomeController::class, 'user_transaction']);

Route::get('/user-chat/{id}', [App\Http\Controllers\HomeController::class, 'user_chat'])->name('user-chat');

Route::get('/user-call/{id}', [App\Http\Controllers\HomeController::class, 'user_call'])->name('user-call');

Route::get('/block-user', [App\Http\Controllers\HomeController::class, 'block_user'])->name('block-user');

Route::get('/view-listener/', [App\Http\Controllers\HomeController::class, 'view_listener'])->name('view-listener');

Route::get('/edit-listener/{id}', [App\Http\Controllers\HomeController::class, 'edit_listener'])->name('edit-listener');

Route::get('delete/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('delete');


Route::get('/add-listener', [App\Http\Controllers\HomeController::class, 'add_listener'])->name('add-listener');



Route::get('/listener-chat/{id}', [App\Http\Controllers\HomeController::class, 'listener_chat'])->name('listener-chat');

Route::get('/listener-call/{id}', [App\Http\Controllers\HomeController::class, 'listener_call'])->name('listener-call');

Route::get('/listener-wallet', [App\Http\Controllers\HomeController::class, 'listener_wallet'])->name('listener-wallet');

Route::get('/listener-payout', [App\Http\Controllers\HomeController::class, 'listener_payout'])->name('listener-payout');

Route::get('/listener-transaction/{id}', [App\Http\Controllers\HomeController::class, 'listener_transaction'])->name('listener-transaction');

Route::get('/listener-charge', [App\Http\Controllers\HomeController::class, 'listener_charge'])->name('listener-charge');

Route::post('/add-charge', [App\Http\Controllers\HomeController::class, 'add_charge'])->name('add-charge');

Route::get('/block-listener', [App\Http\Controllers\HomeController::class, 'block_listener'])->name('block-listener');

Route::get('/search-transaction', [App\Http\Controllers\HomeController::class, 'search_transaction'])->name('search-transaction');
Route::get('/call-transactions', [App\Http\Controllers\HomeController::class, 'search_call'])->name('call-transactions');
Route::get('/chat-transactions', [App\Http\Controllers\HomeController::class, 'search_chat'])->name('chat-transactions');
Route::get('/recharge-transactions', [App\Http\Controllers\HomeController::class, 'search_recharge'])->name('recharge-transactions');
Route::get('/withdrawal-transactions', [App\Http\Controllers\HomeController::class, 'search_withdrawal'])->name('withdrawal-transactions');
Route::get('/video', [App\Http\Controllers\HomeController::class, 'search_video'])->name('video');
Route::get('/bonus', [App\Http\Controllers\HomeController::class, 'search_bonus'])->name('bonus');
Route::get('/penalty', [App\Http\Controllers\HomeController::class, 'search_penalty'])->name('penalty');
Route::get('/reel', [App\Http\Controllers\HomeController::class, 'search_reel'])->name('reel');

Route::get('/send-notification', [App\Http\Controllers\HomeController::class, 'send_notification'])->name('send-notification');
Route::get('/fetch-users', [App\Http\Controllers\HomeController::class, 'fetchUsers'])->name('fetch-users');
Route::get('/fetch-listeners', [App\Http\Controllers\HomeController::class, 'fetchListeners'])->name('fetch-listeners');


Route::get('/offence-report', [App\Http\Controllers\HomeController::class, 'offence_report'])->name('offence-report');

///////Date 19.09.22
Route::get('/view-chat/{chat_id}', [App\Http\Controllers\HomeController::class, 'view_chat'])->name('view-chat');

Route::get('/view-listener_chat/{chat_id}', [App\Http\Controllers\HomeController::class, 'view_chat_listener'])->name('view-listener_chat');

//Route::get('/privacy_policy', [App\Http\Controllers\HomeController::class, 'privacy_policy'])->name('privacy_policy');

Route::get('privacy_policy', [RegistrationController::class, 'privacy_policy'])->name('privacy_policy');

Route::get('/call_recording_show', [App\Http\Controllers\HomeController::class, 'call_recording_show'])->name('call_recording_show');

Route::get('/send-notifications', [App\Http\Controllers\HomeController::class, 'send_notifications'])->name('send-notifications');
///////////


///////////

///////////

Route::post('/add-listner', [RegistrationController::class, 'add_listner']);

Route::get('/user-block/{id}', [RegistrationController::class, 'user_block']);
Route::get('/user-unblock/{id}', [RegistrationController::class, 'user_unblock']);

Route::get('/user-delete/{id}', [RegistrationController::class, 'user_delete']);

Route::get('/listener-edit/{id}', [RegistrationController::class, 'edit'])->name('listener-edit');

Route::post('/update-listner', [RegistrationController::class, 'updatelistner'])->name('update-listner');

Route::post('/listener-update/', [RegistrationController::class, 'update']);

Route::get('/block/{id}', [RegistrationController::class, 'Ablock']);

Route::get('/withdrawal-cancel/{id}', [UserWalletController::class, 'withdrawal_cancel']);
Route::get('/withdrawal-success/{id}', [UserWalletController::class, 'withdrawal_success']);

Route::post('/submit-notification', [App\Http\Controllers\HomeController::class, 'submit_notification'])->name('submit-notification');
Route::get('/create_token', [App\Http\Controllers\AgoraDynamicKey\AgoraTokanController::class, 'create_Token']);

Route::get('/send-message', [App\Http\Controllers\HomeController::class, 'send_message'])->name('send-message');

Route::post('/submit-message', [App\Http\Controllers\HomeController::class, 'submit_message'])->name('submit-message');

//Wallet
Route::get('/wallet-edit/{id}', [UserWalletController::class, 'wallet_edit'])->name('wallet-edit');
Route::post('/wallet-update', [UserWalletController::class, 'wallet_update'])->name('wallet-update');



Route::get('/upload-image', function () {
    return view('upload_image');
});
