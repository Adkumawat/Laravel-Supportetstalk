<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chat_message extends Model
{
    use HasFactory;
    
      protected $fillable = [
		    'user_id',
			'chat_id' ,
			'message' ,
			'status' 
		
	];
}
