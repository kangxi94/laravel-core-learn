<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-14
 * Time: 14:34
 */

namespace App\Repository;


use App\Fan;

class FanRepository {

    public function createFan($user)
    {
        return Fan::create(['fan_id' => Auth::user()-id,'follow_id' => $user->id]);
    }

    public function getFan($user)
    {
        return Fan::where(['fan_id' => Auth::user()-id,'follow_id' => $user->id]);
    }

}