<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShopItems;
use App\Wants;
use App\Comment;
use App\Users;

class ShopItemController extends Controller
{
    
    
    
    
    //アクセス確認
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    
    public function index(){
        
        $title = 'お店選択画面（トップページ）';
        
        //店舗情報をすべて取得
        $shop_items = ShopItems::all();
        
        //view読み込み
        return view('shop_items.index', [
            'title' => $title,
            'shop_items' => $shop_items,
            ]);
    }
    
    
    
    public function show(Request $request){
        $data = $request->all();
        $shop_id = $data['shop_id'];
        
        //選択された店舗の情報を取得
        $shop_item_info = ShopItems::where('id', '=', $shop_id)->get();
        
        //選択された店舗のコメント情報を取得
        $comments = Comment::where('shop_id', '=', $shop_id)->get();
        
        //データをまとめてreturn
        $shop_data = ["shop_item_info" => $shop_item_info, "comments" => $comments];
        
        return $shop_data;
    }
    
    
    
    public function toggleWant(Request $request){
        $data = $request->all();
        $shop_id = $data['shop_id'];
        
        $user_id = \Auth::user()->id;
        
        Wants::create([
            'user_id' => $user_id,
            'shop_id' => $shop_id,
            'order' => 1,
            ]);
        
    }
    
    
    
    public function sample(){
        
        return view('samples.index', [
            'title' => 'サンプル'
            ]);
    }
}
