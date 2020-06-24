<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquire extends Model
{
    // 配列で取得できるプロパティを取得(user_idはいらない)
    public $fillable = ['name', 'email', 'content'];
}
