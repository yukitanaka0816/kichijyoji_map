<?php

namespace App\Http\Controllers;

use App\Inquire;
use App\ShopItems;
use App\Admin;
use App\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index_inquiries() {
        $inquires = Inquire::all();
        return view('admins.index_inquiries', [
            'title' => 'お問い合わせ一覧',
            'inquires' => $inquires,
        ]);
    }
    
    public function index_shop_items() {
        $shop_items = ShopItems::all();
        return view('admins.index_shop_items', [
            'title' => 'お店一覧',
            'shop_items' => $shop_items,
        ]);
        
    }
    
    public function index_users() {
        $users = User::all();
        return view('admins.index_users', [
            'title' => 'ユーザー一覧',
            'users' => $users,
        ]);
        
    }
    
    public function destroy_user($id) {
        $user = User::find($id);
        $user->delete();
        \Session::flash('success', 'ユーザーを削除しました');
        return redirect('/admin/users');
    }
    
    public function update_status(Request $request, $id) {
        $shop_item = ShopItems::find($id);
        $shop_item->update([
            'status' =>$request->update_status,
        ]);
        \Session::flash('success', '公開ステータスを変更しました');
        return redirect('/admin/shop_items');
    }
    
    public function update_bussiness_hours(Request $request, $id) {
        $shop_item = ShopItems::find($id);
        $shop_item->save([
            'url' => $request->url,
            'status' => $request->status,
        ]);
        $shop_item->update([
            'bussiness_hours' => $request->update_bussiness_hours,
        ]);
        \Session::flash('success', '営業時間を変更しました');
        return redirect('/admin/shop_items');
    }
    
    public function update_url(Request $request, $id) {
        $shop_item = ShopItems::find($id);
        $shop_item->save([
            'bussiness_hours' => $request->bussiness_hours,
            'status' => $request->status,
        ]);
        $shop_item->update([
            'url' => $request->update_url,
        ]);
        \Session::flash('success', 'URLを変更しました');
        return redirect('/admin/shop_items');
    }
    
    
    public function __construct()
    {
        $this->middleware('auth');
    }
}
