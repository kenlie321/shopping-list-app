<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $primaryKey = 'item_id';
    protected $foreignKey = 'list_id';

    public function lists(){
        return $this->belongsTo('App\ShoppingList');
    }
}
