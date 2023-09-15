<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
# MessageModelを使用できるように定義
use App\Message;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        # Messageの一覧を取得
        // $messages = Message::all();
        $messages = Message::orderBy('updated_at', 'desc')->get();

        # ホーム画面でmessagesの変数を使えるように渡してあげる
        return view('home', compact('messages'));
    }
}
