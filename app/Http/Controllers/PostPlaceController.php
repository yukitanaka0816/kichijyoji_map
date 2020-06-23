<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostPlaceRequest;
use Illuminate\Support\Facades\Auth;
use App\ShopItems;


class PostPlaceController extends Controller
{
    // //アクセス制限
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //投稿画面の表示
    public function index() {
        $user = \Auth::user();
        return view('post.index', [
            'title' => '新規地点投稿',
            ]);
    }
    
    //新規地点の投稿
    public function store(PostPlaceRequest $request) {
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

        ShopItems::create([
          'user_id' => \Auth::user()->id,
          'business_hours' => $request->input('business_hours', '9:00-18:00'),
          'name' => $request->name,
          'information' => $request->information,
          'image' => $filename, 
          'status' => $request->input('status', '0'),
          'lat' => $request->lat,
          'lng' => $request->lng,
          'url' => $request->url,
        ]);
        
        \Session::flash('success', '投稿を追加しました');
        return redirect('/posts');
      }
}
