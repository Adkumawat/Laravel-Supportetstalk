<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use HasFactory;
    
    protected $fillable = [
		'from_id',
        'to_id',
		'channel_name',
		'user_id',
		'token'
	];
}
