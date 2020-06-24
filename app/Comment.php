<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    protected $fillable = ['user_id', 'shop_id', 'comments'];
    
    public function shop_item() {
        return $this->belongTo('App\ShopItems');
    }
    
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    
}
