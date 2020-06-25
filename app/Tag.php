<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ShopItems;

class Tag extends Model
{

    protected $fillable = ['shop_id', 'category_id'];
    
    public function shop_item() {
        return $this->belongTo('App\Tag');

    public function tag_shop_items(){
        return $this->belongsTo('App\ShopItems');
    }
}
