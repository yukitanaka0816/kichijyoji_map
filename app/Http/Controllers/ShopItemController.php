<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShopItems;

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
        
        //店舗情報をjson形式に変換
        $shop_items_json = json_encode($shop_items, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
        //改行コードをhtml形式に変換
        $shop_items_json = str_replace('\n', '<br>', $shop_items_json);
        
        //view読み込み
        return view('shop_items.index', [
            'title' => $title,
            'shop_items' => $shop_items,
            ]);
    }
    
    
    
    public function show(Request $request){
        $shop_id = $request->input('shop_id');
        
        //選択された店舗の情報を取得
        $shop_items_info = ShopItems::where('id', $shop_id)->get();
        
        dd($shop_items_info);
    }
}
