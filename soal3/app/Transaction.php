<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = [
		'account_id',
		'topup_id',
		'withdraw_id',
		'transfer_id',
		'receive_id'
    ];

    public function topup()
    {
    	return $this->belongsTo(Topup::class, 'topup_id');
    }

    public function withdraw()
    {
    	return $this->belongsTo(Withdraw::class, 'withdraw_id');
    }

    public function transfer()
    {
    	return $this->belongsTo(Transfer::class, 'transfer_id');
    }

    public function receive()
    {
    	return $this->belongsTo(Transfer::class, 'receive_id');
    }

    public function getTypeFormattedAttribute()
    {
    	$format = '';
    	if (!empty($this->topup_id)) {
    		$format = '<span class="badge badge-success">Top Up</span>';
    	} elseif (!empty($this->withdraw_id)) {
    		$format = '<span class="badge badge-primary">Withdraw</span>';
    	} elseif (!empty($this->transfer_id)) {
    		$format = '<span class="badge badge-danger">Transfer</span>';
    	} elseif (!empty($this->receive_id)) {
    		$format = '<span class="badge badge-success">Receive</span>';
    	}
    	return $format;
    }

    public function getAmountFormattedAttribute()
    {
    	$format = '';
    	if (!empty($this->topup_id)) {
    		$format = '<span class="text-success"> + ' . $this->topup->amount . '</span>';
    	} elseif (!empty($this->withdraw_id)) {
    		$format = '<span class="text-danger"> - ' . $this->withdraw->amount . '</span>';
    	} elseif (!empty($this->transfer_id)) {
    		$format = '<span class="text-danger"> - ' . $this->transfer->amount . ' </span>';
    	} elseif (!empty($this->receive_id)) {
    		$format = '<span class="text-success"> + ' . $this->receive->amount . '</span>';
    	}
    	return $format;
    }
}
