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
        
        //view読み込み
        return view('shop_items.index', [
            'title' => $title,
            ]);
        
    }
}
