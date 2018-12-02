<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    Protected $table = "bills";
     public function bill_detail(){
    	return $this->hasMany('App/BillDetail','id_bill','id');
    }
    public function bill(){
    	return $this->belongsto('App/Customer','id_customer','id');
    }
}
