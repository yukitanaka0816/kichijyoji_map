<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\ShopItems;

class CommentController extends Controller
{
    // //アクセス制限
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // //口コミ一覧とお店の詳細を表示
    public function show($id) {
        $shop_item = ShopItems::find($id);
        $reviews = Comment::where('shop_id', '=', $id)->get();
        return view('comments.show', [
            'title' => '口コミ一覧',
            'shop_item' => $shop_item,
            'reviews' => $reviews,
            ]);
    }
    
    //口コミを投稿
    public function store(CommentRequest $request) {
        //画像投稿処理
        $filename = '';
        $image = $request->file('image');
        if( isset($image) === true ){
            // 拡張子を取得
            $ext = $image->guessExtension();
            // アップロードファイル名は [ランダム文字列20文字].[拡張子]
            $filename = \Str::random(20) . '.' . $ext;
            // publicディスク(storage/app/public/)のphotosディレクトリに保存
            $path = $image->storeAs('photos', $filename, 'public');
        }

        Comment::create([
            'user_id' => \Auth::user()->id,
            'shop_id' => $request->shop_id,
            'image' => $filename, 
            'comments' => $request->comments,
            'status' => '1',
            ]);
        \Session::flash('success', '口コミを投稿しました');
        return redirect('/comments/' . $request->shop_id);
    }
    
    
    //トップ画面から口コミを投稿
    public function top_store(CommentRequest $request){
        Comment::create([
            'user_id' => \Auth::user()->id,
            'shop_id' => $request->shop_id,
            'comments' => $request->comments,
            //'status' => $request ->status,
            ]);
        \Session::flash('success', '口コミを投稿しました');
    }
}
