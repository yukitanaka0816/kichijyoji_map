<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopItems extends Model
{
    protected $fillable = ['user_id', 'name', 'information'];
}
