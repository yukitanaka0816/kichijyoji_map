<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InquiryController extends Controller
{
    //アクセス制限
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        return view ('inquiries.index', [
            'title' => '問い合わせフォーム',
        ]);
    }
    
    public function store() {
        
    }
}
