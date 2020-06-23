<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inquire;
use App\Http\Requests\InquiryForm;

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
    
    public function store(InquiryForm $request) {
        Inquire::create([
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content,
        ]);
        \Session::flash('success', 'お問い合わせを送信しました');
        return redirect('/inquiries');
    }
}
