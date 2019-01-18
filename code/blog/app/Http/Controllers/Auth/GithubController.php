<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-09
 * Time: 13:59
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\User;
class GithubController extends Controller {
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $github_user = Socialite::driver('github')->user();
        // 根据github email查询用户
        $user = User::where('email',$github_user->getEmail())->first();
        if(!$user) {
            $user = User::create([
                'name' => $github_user->getName(),
                'email' => $github_user->getEmail(),
                'avatar' => $github_user->getAvatar(),
                'validate_token' => str_random(24),
                'is_validate' => 1,
                'provider' => 'github',
                'api_token' => str_random(24),
                'password' => bcrypt(str_random(6)),
            ]);
        }
        Auth::loginUsingId($user->id);
        return redirect('/');
    }
}