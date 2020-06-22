<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopItemController extends Controller
{
    public function index(){
        
        $title = 'お店選択画面（トップページ）';
        
        //view読み込み
        return view('shop_items.index', [
            'title' => $title,
            ]);
        
    }
}
