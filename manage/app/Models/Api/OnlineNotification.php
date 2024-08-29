<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineNotification extends Model
{
    use HasFactory;
	
	protected $fillable = [
		'type',
		'notifiable_id',	
		'data',	
		'data_id',	
		'data_name',	
		'data_image',
        'data_msg',		
		'read_status',	
	];
}
