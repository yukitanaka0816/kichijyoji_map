<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wants extends Model
{
    protected $fillable = [
        'user_id', 
        'shop_id',
        'order'
    ];
}
