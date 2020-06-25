<?php

namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Inquire;
    use App\Http\Requests\InquiryForm;

class InquiryController extends Controller
{
    
    public function index() {
        return view ('inquiries.index', [
            'title' => 'お問い合わせ',
        ]);
    }
    
    public function store(InquiryForm $request) {
        Inquire::create([
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content,
        ]);
        \Session::flash('success', 'お問い合わせありがとうございます！送信いたしました！');
        return redirect('/inquiries');
    }
    
    
}
