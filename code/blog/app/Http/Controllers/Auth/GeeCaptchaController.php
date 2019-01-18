<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-09
 * Time: 14:49
 */

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use  \Laravist\GeeCaptcha\GeeCaptcha;

class GeeCaptchaController extends Controller {

    protected $captcha;

    public function __construct()
    {
        $this->captcha = new GeeCaptcha(env('CAPTCHA_ID'), env('PRIVATE_KEY'));
    }

    /**
     * @return bool
     */
    public function verify()
    {
        if ($this->captcha->isFromGTServer()) {
            if($this->captcha->success()){
                return true;
            }
        }
        return false;
    }

    public function captcha()
    {
        return $this->captcha->GTServerIsNormal();
    }

}