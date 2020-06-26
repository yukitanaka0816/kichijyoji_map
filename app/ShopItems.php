<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Wants;
use App\Tag;

class ShopItems extends Model
{
    protected $fillable = ['user_id', 'name', 'information', 'business_hours', 'image', 'lat', 'lng', 'status', 'url'];
    

    public function tags(){
        return $this->hasMany('App\Tag');
    }
    
    
}
