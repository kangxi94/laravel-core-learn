<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-14
 * Time: 14:34
 */

namespace App\Repository;


use App\Zan;
use Illuminate\Support\Facades\Auth;

class ZanRepository {

    public function createZan($zan_post)
    {
        return Zan::create(['post_id' => $zan_post->id,'user_id' => Auth::user()->id]);
    }

    public function getZan($zan_post)
    {
        return Zan::where(['post_id' => $zan_post->id,'user_id' => Auth::user()->id]);
    }

}