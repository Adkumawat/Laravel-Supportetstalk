<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');

Route::get('/add-admin', [App\Http\Controllers\HomeController::class, 'add_admin'])->name('add-admin');

Route::get('/edit-admin', [App\Http\Controllers\HomeController::class, 'edit_admin'])->name('edit-admin');

Route::get('/view-user', [App\Http\Controllers\HomeController::class, 'view_user'])->name('view-user');

Route::get('/user-wallet', [App\Http\Controllers\HomeController::class, 'user_wallet'])->name('user-wallet');

Route::get('/user-transaction', [App\Http\Controllers\HomeController::class, 'user_transaction'])->name('user-transaction');

Route::get('/user-chat', [App\Http\Controllers\HomeController::class, 'user_chat'])->name('user-chat');

Route::get('/user-call', [App\Http\Controllers\HomeController::class, 'user_call'])->name('user-call');

Route::get('/block-user', [App\Http\Controllers\HomeController::class, 'block_user'])->name('block-user');

Route::get('/view-listener', [App\Http\Controllers\HomeController::class, 'view_listener'])->name('view-listener');

Route::get('/add-listener', [App\Http\Controllers\HomeController::class, 'add_listener'])->name('add-listener');

Route::get('/edit-listener', [App\Http\Controllers\HomeController::class, 'edit_listener'])->name('edit-listener');

Route::get('/listener-chat', [App\Http\Controllers\HomeController::class, 'listener_chat'])->name('listener-chat');

Route::get('/listener-call', [App\Http\Controllers\HomeController::class, 'listener_call'])->name('listener-call');

Route::get('/listener-wallet', [App\Http\Controllers\HomeController::class, 'listener_wallet'])->name('listener-wallet');

Route::get('/listener-payout', [App\Http\Controllers\HomeController::class, 'listener_payout'])->name('listener-payout');

Route::get('/listener-transaction', [App\Http\Controllers\HomeController::class, 'listener_transaction'])->name('listener-transaction');

Route::get('/listener-charge', [App\Http\Controllers\HomeController::class, 'listener_charge'])->name('listener-charge');

Route::post('/add-charge', [App\Http\Controllers\HomeController::class, 'add_charge'])->name('add-charge');

Route::get('/block-listener', [App\Http\Controllers\HomeController::class, 'block_listener'])->name('block-listener');

Route::get('/search-transaction', [App\Http\Controllers\HomeController::class, 'search_transaction'])->name('search-transaction');

Route::get('/send-notification', [App\Http\Controllers\HomeController::class, 'send_notification'])->name('send-notification');

Route::get('/offence-report', [App\Http\Controllers\HomeController::class, 'offence_report'])->name('offence-report');


///////Date 19.09.22
Route::get('/view-chat/{chat_id}', [App\Http\Controllers\HomeController::class, 'view_chat'])->name('view-chat');


///////////

Route::post('/add-listner', [RegistrationController::class, 'add_listner']);

