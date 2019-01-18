<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-13
 * Time: 12:16
 */

namespace App\Service;


use App\Repository\FanRepository;

class UserService {

    protected $fanRepository;

    /**
     * UserService constructor.
     * @param $fanRepository
     */
    public function __construct(FanRepository $fanRepository)
    {
        $this->fanRepository = $fanRepository;
    }

    /**
     * @return mixed
     */
    public function getPostsByUser($user,$post_id)
    {
        return $user->posts()->where('id','!=',$post_id)->orderBy('created_at', 'desc')->take(5)->get();
    }

    // 关注某人
    public function doFan($follow_user)
    {
        $fan = $this->fanRepository->createFan($follow_user);
        return Auth::user()->follows()->save($fan);
    }

    // 取消关注某人
    public function doUnFan($user)
    {
        $fan = $this->fanRepository->getFan($follow_user);
        return Auth::user()->follows()->delete($fan);
    }

}