<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
	
	public $table = "feedbacks";
	
	protected $fillable = [
		'from_id',
		'to_id',
		'review',
		'rating'		
	];
	
	protected $dates = [
    'created_at',
    'updated_at',
    // your other new column
];
}
