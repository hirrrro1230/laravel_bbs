<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

# CommentModelを使用できるように定義
use App\Comment;
use Auth;

class CommentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * コメントの登録
     */
    public function store()
    {
        // フォームの入力値を取得
        $inputs = \Request::all();

        // 認証情報からユーザーIDの取得
        $inputs['user_id'] = Auth::user()->id;

        // コメントの登録処理
        Comment::create($inputs);

        // ホーム画面へリダイレクト
        return redirect('home');
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        if ($comment->user_id === Auth::user()->id) {
            $comment->delete();
            return redirect()->back()->with('success', 'コメントが削除されました。');
        } else {
            return redirect()->back()->with('error', 'コメントの削除権限がありません。');
        }
    }
}