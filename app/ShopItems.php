<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Wants;

class ShopItems extends Model
{
    public function wants_shops(){
      return $this->hasMany('App\Wants');
    }
}
