<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostPlaceRequest;
use Illuminate\Support\Facades\Auth;
use DB;
use App\ShopItems;
use App\Tag;
use App\Http\Requests\TagRequest;

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
    public function store(PostPlaceRequest $request, TagRequest $check) {
        
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

        //shop_itemsテーブルへの挿入
        $id = DB::table('shop_items')->insertGetId([
            'user_id' => \Auth::user()->id,
            'business_hours' => '9:00-18:00',
            'name' => $request->name,
            'information' => $request->information,
            'image' => $filename, 
            'status' => '0',
            'lat' => $request->lat,
            'lng' => $request->lng,
            'url' => 'https://',
        ]);
        
        //選択されたカテゴリーをtagsテーブルへ挿入
        $categories = $check->input('categories');
        //dd($categories);
        //dd($id);
        
        foreach($categories as $category){
            Tag::create([
                'shop_id' => $id,
                'category_id' => $category,
            ]);
        }
        \Session::flash('success', '投稿を追加しました');
        return redirect('/post');
    }
}