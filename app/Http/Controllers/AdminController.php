<?php

namespace App\Http\Controllers;

use App\Inquire;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $inquires = Inquire::all();
        return view('admins.index', [
            'title' => 'お問い合わせ一覧',
            'inquires' => $inquires,
        ]);
    }
}
