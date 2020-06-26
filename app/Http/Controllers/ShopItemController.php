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
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    

    public function index(){
        
        $title = 'お店選択画面（トップページ）';
        
        if(null !== \Auth::user()) {
            $login_user = TRUE;
            $wants = Wants::order()->get();
        } else {
            $login_user = FALSE;
            $wants = '';
        }
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
            'wants' => $wants,
            'login_user' => $login_user,
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
        
        if (count($wants) < 9) {
            Wants::create([
                'user_id' => $user_id,
                'shop_id' => $shop_id,
                'order' => count($wants) + 1,
                ]);
            return 'ルートに追加しました。「ルート」からルートが作成できます。';
        } else {
            return 'ルートに追加できるスポットは8個までです。';
        }
        return(count($wants));
    }
    
    public function category($id){
        $title = 'お店選択画面（トップページ）';
        
        if(null !== \Auth::user()) {
            $login_user = TRUE;
            $wants = Wants::order()->get();
        } else {
            $login_user = FALSE;
            $wants = '';
        }
        
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
            'login_user' => $login_user,
            'wants' => $wants,
            ]);
    
    }
    
    public function sample(){
        
        return view('samples.index', [
            'title' => 'サンプル'
            ]);
    }
    
     public function wants(){
        //$wants = Wants::where('user_id', '=', \Auth::user()->id)->get();
        //ユーザーが持っている行きたいところリスト
        $wants = \Auth::user()->user_wants()->pluck('shop_id');
        // $wants = DB::table('wants')
        //             ->join('shop_items', function($join){
        //                 $join->on('wants.shop_id', '=', 'shop_items.id')
        //                 ->join('users', function($join) use ($user_id) {
        //                     $join->on('wants.user_id', '=', 'users.id')
        //                     ->where('wants.user_id', '=', $user_id);
        //                 });
        //             });
        
        $shop_items = [];
        for ($i = 0; $i < count($wants); $i++) {
            $shop_item = ShopItems::where('id', $wants[$i])->get();
            $shop_items[] = $shop_item;
        }
        
        //$wants = ShopItems::where('id', \Auth::user()->user_wants()->get('shop_id'))->get();
        
        return $shop_items;
    }
}
