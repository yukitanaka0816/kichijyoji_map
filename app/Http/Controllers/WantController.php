<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WantController extends Controller
{
    public function index(){
        return view('wants.index', [
            'title' => 'ルート作成画面',
        ]);
    }
    
    public function show(){
        
    }
    
    public function destroy(){
        
    } 
    
    public function update(){
        
    }
}
