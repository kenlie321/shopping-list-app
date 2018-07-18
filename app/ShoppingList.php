<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    protected $primaryKey = 'list_id';

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function items(){
        return $this->hasMany('App\Items');
    } 
}
