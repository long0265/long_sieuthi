<?php

namespace App\Http\Controllers;
use App\Slide;
use App\Product;
use App\Cart;
use Session;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\ProductType;
use Illuminate\Http\Request;

class PateController extends Controller
{
    public function getIndex(){
    	$slide = Slide::all();
    	$new_product = Product::where('new',1)->paginate(4);
    	$sale = Product::where('promotion_price','<>',0)->paginate(4);
    	return view('pate.trangchu',compact('slide','new_product',"sale"));
    }

    public function getLoaiSP($type){
        $sp_theoloai = Product::where('id_type',$type)->get();
    	return view('pate.loai_sanpham',compact('sp_theoloai'));
    }

    public function getChitietSP(Request $req){
        $sanpham = Product::where('id',$req->id)->first();
        $sp_tuongtu = Product::where('id_type',$sanpham->id_type)->paginate(3);
    	return view('pate.chitiet_sanpham',compact('sanpham','sp_tuongtu'));
    }

    public function getLienHe(){
    	return view('pate.contacts');
    }

    public function getGioiThieu(){
    	return view('pate.gioithieu');
    }

    public function getAddtoCart(Request $req,$id){
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $req->Session()->put('cart',$cart);
        return redirect()->back();
    }

    public function getDelCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }
        return redirect()->back();
    }

    public function getDatHang(){
        if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                return view('pate.dathang',['product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }
        else{
            return view('pate.dathang');
        }
       
    }

    public function postDatHang(Request $req){
        $cart = Session::get('cart');

        $customer = new Customer;
        $customer->name = $req->full_name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number = $req->phone;
        $customer->note = $req->notes;
        $customer->save();

        $bill = new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment_method;
        $bill->note = $req->notes;
        $bill->save();

        foreach ($cart->items as $key=>$value) {
            $bill_detail = new BillDetail;
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = $value['price']/$value['qty'];
            $bill_detail->save();
        }

        Session::forget('cart');
        return redirect()->back()->with('thongbao','Đặt hàng thành công');
    }

    public function getLongin(){
        return view('pate.dangnhap');
    }

     public function getSingin(){
        return view('pate.dangki');
    }

    public function getSearch(Request $req){
        $product = Product::where('name','like','%'.$req->key.'%')
                            ->orWhere('unit_price',$req->key)
                            ->get();
        return view('pate.search',compact('product'));
    }

}
