<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Account;
use App\Transaction;

class Topup extends Model
{
    protected $table = 'topups';
    protected $fillable = [
		'account_id',
		'amount'
    ];

    public static function boot()
    {
    	parent::boot();

    	static::created(function ($topup) {
    		$currentBalance = $topup->account->balance;

    		$topup->account->update([
				'balance'	=>	$currentBalance + $topup->amount
    		]);

            $data = [
                'account_id'    =>  $topup->account->id,
                'topup_id'      =>  $topup->id
            ];

            Transaction::create($data);
    	});
    }

    public function account()
    {
    	return $this->belongsTo(Account::class, 'account_id');
    }
}
