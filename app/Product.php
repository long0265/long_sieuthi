<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    Protected $table = "products";
    public function product_type(){
    	return $this->belongsto('App/Product_type','id_type','id');
    }
    public function bill_detail(){
    	return $this->hasMany('App/BilldDetail','id_product','id');
    }
}
