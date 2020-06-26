<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShopItems;
use App\Wants;
use App\Comment;
use App\Users;
use App\Tag;
use DB;

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
        $shop_items = DB::table('tags')
                            ->join('shop_items',function($join){
                                $join->on( 'tags.shop_id', '=', 'shop_items.id');
                                     
                            })
                            ->where('status', 1)
                            ->groupBy('shop_id')
                            ->get();
        //dd($shop_items);
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
        
        $wants = \Auth::user()->user_wants()->get('shop_id');
        
        if ($wants.length < 9) {
            Wants::create([
                'user_id' => $user_id,
                'shop_id' => $shop_id,
                'order' => $wants.lengt,
                ]);
        } else {
            \Session::flash('error', '行きたい！は8個までです。');
        }
        
    }
    
    public function category($id){
        $title = 'お店選択画面（トップページ）';
        
        //カテゴリー店舗情報を取得
        $shop_items = DB::table('tags')
                            ->join('shop_items',function($join) use ($id){
                                $join->on( 'tags.shop_id', '=', 'shop_items.id',)
                                     ->where('tags.category_id', '=', $id);
                            })
                            ->where('status', 1)
                            ->get();
        //dd($shop_items);
        //view読み込み
        return view('shop_items.index', [
            'title' => $title,
            'shop_items' => $shop_items,
            ]);
    
    }
    
    public function sample(){
        
        return view('samples.index', [
            'title' => 'サンプル'
            ]);
    }
}
