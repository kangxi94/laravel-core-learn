<?php

namespace App;

class Fan extends Model
{
    /*
     * 关注我的用户
     */
    public function fan_user()
    {
        return $this->hasOne(User::class, 'id', 'fan_id');
    }

    /*
     * 我关注的用户
     */
    public function follow_user()
    {
        return $this->hasOne(User::class, 'id', 'follow_id');
    }
}
