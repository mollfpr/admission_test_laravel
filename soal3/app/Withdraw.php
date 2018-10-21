<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transaction;

class Withdraw extends Model
{
    protected $table = 'withdraws';
    protected $fillable = [
		'account_id',
		'amount'
    ];

    public static function boot()
    {
    	parent::boot();

    	static::created(function ($withdraw) {
    		$currentBalance = $withdraw->account->balance;

    		$withdraw->account->update([
				'balance'	=>	$currentBalance - $withdraw->amount
    		]);

            $data = [
                'account_id'    =>  $withdraw->account->id,
                'withdraw_id'   =>  $withdraw->id
            ];

            Transaction::create($data);
    	});
    }

    public function account()
    {
    	return $this->belongsTo(Account::class, 'account_id');
    }
}
