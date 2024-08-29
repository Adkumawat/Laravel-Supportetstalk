<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
	
	protected $fillable = [
		'user_id',
		'wallet_amount'
	];
    public function registration()
    {
        return $this->belongsTo(Registration::class, 'user_id', 'id');
    }
}
