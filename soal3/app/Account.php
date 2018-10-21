<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';
    protected $fillable = [
		'user_id',
		'number',
		'balance'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function acceptBalance()
    {
        return $this->hasMany(Transfer::class, 'to', 'id');
    }

    public function getBalanceFormattedAttribute()
    {
    	$format = "Rp. $this->balance,-";
    	return $format;
    }
}
