<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    Protected $table = "bill_detail";
    public function product(){
    	return $this->belongsto('App/Product','id_product','id');
    }
    public function bill(){
    	return $this->belongsto('App/Bill','id_bill','id');
    }
}
