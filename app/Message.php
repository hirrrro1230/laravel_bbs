<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'text',
    ];

    # Messageの情報から「誰が投稿したのか」の情報を簡単に取得できるように「n対1」を紐付ける
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    # Messageの情報から「この投稿に対するコメント」の情報を簡単に取得できるように「1対n」を紐付ける
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
