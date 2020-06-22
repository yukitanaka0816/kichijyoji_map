<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index() {
        return view ('inquiries.index', [
            'title' => '問い合わせフォーム',
        ]);
    }
    
    public function store() {
        
    }
}
