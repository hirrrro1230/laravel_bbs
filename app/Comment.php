<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'message_id', 'text',
    ];

    # Commentの情報から「誰がコメントしたのか」の情報を簡単に取得できるように「n対1」を紐付ける
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    # Commentの情報から「どの投稿にコメントをしたのか」の情報を簡単に取得できるように「1対n」を紐付ける
    public function messages()
    {
        return $this->belongsTo('App\Message');
    }
}