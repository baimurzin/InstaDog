<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    const STATUS_WAIT_LOGIN = 0,
        STATUS_OK = 1,
        STATUS_ERROR = 2;

    protected $table = 'accounts';

    protected $fillable = ['login', 'password'];

    public function accData() {
        return $this->hasOne('\App\InstagramAccountData', 'account_id', 'id');
    }
}
