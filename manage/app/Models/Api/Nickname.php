<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nickname extends Model
{
    use HasFactory;
	
	protected $fillable = [
		'from_id',
		'to_id',
		'nickname'		
	];
}
