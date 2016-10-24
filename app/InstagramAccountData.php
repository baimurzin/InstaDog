<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstagramAccountData extends Model
{
    protected $table = 'instagram_account_datas';

    public function account() {
       return $this->hasOne('\App\Account', 'id', 'account_id');
    }
}
