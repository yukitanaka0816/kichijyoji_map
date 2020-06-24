<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopItems extends Model
{
    // 配列で取得できるプロパティを取得
    public $fillable = ['user_id', 'bussiness_ours', 'name', 'information', 'image', 'status', 'lat', 'lng', 'url'];
}
