<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
#MessageModelを使用できるように定義
use App\Message;
use Auth;

class MessagesController extends Controller
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
     * 投稿画面を表示
     */
    public function create()
    {
        return view('messages.create');
    }
    /**
     * 投稿の登録
     */
    public function store(Request $request)
    {
        // バリデーションの実装
        $this->validate($request, [
            'title' => 'required|max:10',
            'text' => 'required'
        ]);
        // フォームの入力値を取得
        $inputs = \Request::all();

        // 認証情報からユーザーIDの取得
        $inputs['user_id'] = Auth::user()->id;

        // 投稿の登録処理
        Message::create($inputs);

        // ホーム画面へリダイレクト
        return redirect('home');
    }

    public function destroy($id)
    {
        $message = Message::find($id);
        //メッセージを削除できるのは投稿者のみ
        if($message->user_id === Auth::user()->id) {
            $message->delete();
            return redirect()->back()->with('success', 'メッセージが削除されました。');    
        } else {
            return redirect()->back()->with('error', 'メッセージの削除権限がありません。');
        }
    }
}
