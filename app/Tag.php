<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function tag_shop_items(){
        return $this->belongsTo('App\ShopItems');
    }
}
