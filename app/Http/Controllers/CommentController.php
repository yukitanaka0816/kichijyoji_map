<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //アクセス制限
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //口コミ一覧を表示
    public function index() {
        return view('comments.index', [
            'title' => '口コミ一覧',
            //'comments' => $comments,
            ]);
    }
    
    //口コミを投稿
    public function store(CommentRequest $request) {
        Comment::create([
            'user_id' => \Auth::user()->id,
            'shop_id' => $request->shop_id,
            'comments' => $request->comments,
            ]);
        \Session::flash('success', '口コミを投稿しました');
        return redirect('/comments');
    }
}
