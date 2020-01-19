<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zan extends Model
{
    protected $fillable = ['article_id', 'user_id'];

    public function article()
    {
    	return $this->belongsTo('App\article');
    }

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }
}
