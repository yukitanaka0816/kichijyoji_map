<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShopItems;
use App\Comment;
use App\Tag;
use DB;

class KichijojiMapController extends Controller
{
     public function index(){
        
        $title = 'お店選択画面（トップページ）';
        
        //店舗情報をすべて取得
        $shop_items = DB::table('tags')
                            ->join('shop_items',function($join){
                                $join->on( 'tags.shop_id', '=', 'shop_items.id');
                                     
                            })
                            ->where('status', 1)
                            ->groupBy('shop_id')
                            ->get();
        //dd($shop_items);

        //view読み込み
        return view('kichijoji_map.index', [
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
    
    
    public function category($id){
        $title = 'お店選択画面（トップページ）';
        
        //カテゴリー店舗情報を取得
        $shop_items = DB::table('shop_items')
                            ->join('tags',function($join) use ($id){
                                $join->on('shop_items.id', '=', 'tags.shop_id')
                                     ->where('tags.category_id', '=', $id);
                            })
                            ->get();
        //view読み込み
        return view('kichijoji_map.index', [
            'title' => $title,
            'shop_items' => $shop_items,
            ]);
    
    }
    
}
