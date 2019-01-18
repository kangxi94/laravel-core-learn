<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Notifications\ResetPasswordNotification;
use Cxp\Avatar\Facades\Avatar;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Mail\MailConfirm;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'validate_token', 'is_validate', 'avatar', 'provider', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /*
  * 关注我的用户
  */
    public function fans()
    {
        return $this->hasMany(Fan::class, 'follow_id', 'id');
    }

    /*
     * 我关注的用户
     */
    public function follows()
    {
        return $this->hasMany(Fan::class, 'fan_id', 'id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     *  验证邮件地址
     * @return string
     */
    public function geValidateMailLink(){
        $params = [
            'user_id' => $this->id,
            'validate_token' => $this->validate_token,
        ];
        return route('confirm',$params);
    }

    /**
     *  验证邮件地址
     * @return string
     */
    public function getSendConfirmMailLink(){
        return route('send-confirm-mail');
    }

    /**
     *  发送邮件
     */
    public function sendValidateMail()
    {
        return Mail::to($this->email)->send(new MailConfirm($this));
    }

    public function getAvatarAttribute()
    {
        if (empty($this->attributes['avatar'])) {
            $filename = sprintf('avatars/%s.png', $this->id);
            $filepath = storage_path('app/public/'.$filename);
            if (!is_dir(dirname($filepath))) {
                mkdir(dirname($filepath), 0755, true);
            }
            \Avatar::output($this->name,$filepath);
            $this->update(['avatar' => sprintf('storage/%s', $filename)]);
        }
        return asset($this->attributes['avatar']);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
