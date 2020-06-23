<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wants extends Model
{
    public function shop_item(){
      return $this->belongsTo('App\ShopItems');
    }
}
