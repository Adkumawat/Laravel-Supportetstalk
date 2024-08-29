<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    use HasFactory;
	
	protected $fillable = [
		'user_id',
		'mobile_no',
		'to_id',
		'type',
		'mode',
		'cr_amount',
		'dr_amount',
		'payment_id',
		'order_id',
		'signatre_id',
		'duration',
		'session_id'
	];
}
