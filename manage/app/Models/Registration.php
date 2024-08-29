<?php

namespace App\Models;

use App\Models\Api\Wallet;
use App\Models\Api\Feedback;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
	
	protected $fillable = [
		'name',
		'mobile_no',
		'helping_category',
		'age',
		'interest',
		'language',
		'sex',
		'available_on',
		'about',
		'image',
		'device_token',
		'user_type',
		'status',
		'online_status',
		'busy_status',
		'ac_delete',
	];
	
	protected $casts = [
    'status' => 'integer',
    'online_status' => 'integer',
    'busy_status' => 'integer',
    'ac_delete' => 'integer',
];


	/**
	 * Get feedbacks for a listener
	 */
	public function feedbacks()
	{
		return $this->hasMany(Feedback::class, 'to_id');
	}
   
    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'user_id', 'id');
    }

}
