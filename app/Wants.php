<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\ShopItems;

class Wants extends Model
{
    public function shop(){
      return $this->belongsTo('App\ShopItems');
    }
    
    public function scopeOrder($query){
      return $query->with('shop')->where('user_id',\Auth::user()->id)->orderBy('order');
    }
    
    protected $fillable = [
        'user_id', 
        'shop_id',
        'order'
    ];
}
