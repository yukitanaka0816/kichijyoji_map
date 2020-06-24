<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Wants;
use App\ShopItems;
use App\User;

class WantController extends Controller
{
    //アクセス制限
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        // $wants = \Auth::user()->user_wants;
        $wants = Wants::order()->get();
        return view('wants.index', [
            'title' => 'ルート作成画面',
            'wants' => $wants,
        ]);
    }
    
    public function show(){
        
    }
    
    public function destroy($id){
        $want = Wants::find($id);
        $want->delete();
        \Session::flash('success', '行きたいところリストから削除しました');
        return redirect('/wants');
    } 
    
    public function update(Request $request){
        //dd($request);
        $wants = Wants::order()->get();
        foreach($wants as $i => $want){
            $want->update([
                'order' => $request->order[$i]
            ]);
        }
        \Session::flash('success', '順番を変更しました');
        return redirect('/wants');
    }
}
