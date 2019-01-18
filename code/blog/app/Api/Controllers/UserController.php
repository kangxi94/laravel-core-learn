<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-14
 * Time: 17:17
 */

namespace App\Api\Controllers;

use App\User;
use App\Service\UserService;
use Illuminate\Support\Facades\Auth;

class UserController {

    protected $postService;

    /**
     * PostController constructor.
     * @param $postService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function isFollow(User $follow_user)
    {
        return response()->json([
            'is_follow' => $follow_user->is_follow()
        ]);
    }

    public function followOrCancel(User $follow_user)
    {
        if ($follow_user->is_follow()) {
            $this->userService->doUnFan($follow_user);
            $follow_user->decrement('fan_count');
            Auth:user()->decrement('fav_count');
        }else {
            $this->userService->doFan($follow_user);
            $follow_user->increment('fan_count');
            Auth::user()->increment('fav_count');
        }
        return response()->json([
            'is_follow' => $follow_user->is_follow()
        ]);
    }
}