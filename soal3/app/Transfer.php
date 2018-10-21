<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transaction;

class Transfer extends Model
{
    protected $table = 'transfers';
    protected $fillable = [
		'from',
		'to',
		'amount'
    ];

    public static function boot()
    {
    	parent::boot();

    	static::created(function ($transfer) {
    		$fromBalance = $transfer->fromAccount->balance;
    		$toBalance = $transfer->toAccount->balance;

    		$transfer->fromAccount->update([
				'balance'	=>	$fromBalance - $transfer->amount
    		]);

            Transaction::create([
                'account_id'    =>  auth()->user()->account->id,
                'transfer_id'   =>  $transfer->id,
            ]);

    		$transfer->toAccount->update([
				'balance'	=>	$toBalance + $transfer->amount
    		]);

            Transaction::create([
                'account_id'    =>  $transfer->toAccount->id,
                'receive_id'    =>  $transfer->id,
            ]);
    	});
    }

    public function fromAccount()
    {
    	return $this->belongsTo(Account::class, 'from');
    }

    public function toAccount()
    {
    	return $this->belongsTo(Account::class, 'to');
    }
}
