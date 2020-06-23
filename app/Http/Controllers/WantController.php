<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WantController extends Controller
{
    //アクセス制限
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $wants = Wants::where('user_id', \Auth::user()->id)->get();
        return view('wants.index', [
            'title' => 'ルート作成画面',
            'wants' => $wants,
        ]);
    }
    
    public function show(){
        
    }
    
    public function destroy(){
        
    } 
    
    public function update(){
        
    }
}
