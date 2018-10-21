<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Faker\Factory;

/** MODELS */
use App\Account;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $faker = Factory::create();
            $data = [
                'user_id'               =>  $user->id,
                'number'                =>  $faker->creditCardNumber,
                'balance'               =>  0
            ];

            Account::create($data);
        });
    }

    public function account()
    {
        return $this->hasOne(Account::class, 'user_id', 'id');
    }
}
