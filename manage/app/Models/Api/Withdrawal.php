<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;
	
	protected $fillable = [
		'user_id',
		'upi_id',
		'amount',
		'wallet_amount',
		'account_no',
		'ifsc_code',
		'bank_name',
		'transection_no',
		'status',
	];
}
