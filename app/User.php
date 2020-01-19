<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\controllers\Zlog;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    public function zans()
    {
        return $this->hasMany('App\Zan');
    }

    // 取当前用户关注了哪些人---当前用户是粉丝 所以 fan_id 等于当前用户的id
    public function stars()
    {
        return $this->hasMany('App\Fan', 'fan_id', 'id');
    }

    // 获取当前用户拥有多少粉丝--当前用户是被关注的 所以star_id 等于当前用户的id
    public function fans()
    {
        return $this->hasMany('App\Fan', 'star_id', 'id');
    }

    // 当前用户是否关注某个用户  并算出总数
    public function hasStar($userId)
    {
        return $this->stars()->where('star_id', $userId)->count();
    }

    // 当前用户是否被人关注  并算出总数
    public function hasFan($userId)
    {
        return $this->stars()->where('fan_id', $userId)->count();
    }

    // 关注某人
    public function doFan($userId)
    {
        return \App\Fan::create(['star_id' => $userId, 'fan_id' => $this->id]);
    }

    // 取消关注某人
    public function doUnFan($userId)
    {
        return \App\Fan::where('star_id', $userId)->where('fan_id', $this->id)->delete();
    }
}
