<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Account extends Model
{
    use SoftDeletes;
    const STATUS_WAIT_LOGIN = 0,
        STATUS_OK = 1,
        STATUS_ERROR = 2;

    protected $table = 'accounts';

    protected $fillable = ['login', 'password'];

    public function accData() {
        return $this->hasOne('\App\InstagramAccountData', 'account_id', 'id');
    }

    protected $dates = ['deleted_at'];

}
