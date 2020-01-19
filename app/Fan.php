<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    protected $fillable = ['fan_id', 'star_id'];

    // 获取粉丝用户
    public function fanUser()
    {
    	return $this->hasOne(\App\User::class, 'id', 'fan_id');
    }

    // 获取被关注的用户
    public function starUser()
    {
    	return $this->hasOne(\App\User::class, 'id', 'star_id');
    }
}
