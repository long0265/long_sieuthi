<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductType;
use App\Product;

class ChitietsanphamController extends Controller
{
    public function getDanhsach(){
    	$chitietsanpham = Product::all();
    	return view('admin.chitietsanpham.danhsach',['chitietsanpham'=>$chitietsanpham]);
    }

    public function getXoa($id){
        $chitietsanpham = Product::find($id);
        $chitietsanpham->delete();
        unlink('source/image/product/'.$chitietsanpham->image);
        return redirect('admin/chitietsanpham/danhsach')->with('thongbao','xóa thành công');
    }

    public function getSua($id){
    	$loaisanpham=ProductType::all();
    	$chitietsanpham = Product::find($id);
    	return view('admin.chitietsanpham.sua',['chitietsanpham'=>$chitietsanpham,'loaisanpham'=>$loaisanpham]);
    }

    public function postSua(Request $req,$id){
        $chitietsanpham = Product::find($id);
        $this->validate($req,
    		[
    			'sp' => 'required|min:5|max:100',
    			'noidung' => 'required',
    			'dongia' => 'required',
    			'giakm' => 'required',
    			'new' => 'required'
    		],
    		[
    			'sp.required'=>'bạn chưa nhập loại sản phẩm',
    			'sp.min'=>'nhập trên 5 ký tự',
    			'sp.max'=>'quá nhiều ký tự',
    			// 'sp.unique'=>'loại bánh đã có',
    			'noidung.required'=>'bạn chưa nhập nội dung',
    			'dongia.required'=>'bạn chưa nhập đơn giá',
    			'giakm.required'=>'bạn chưa nhập giá km',
    			'new.required'=>'bạn chưa nhập sản phẩm mới'
    			
    		]);
        $chitietsanpham->id_type = $req->loaisanpham;
    	$chitietsanpham->name = $req->sp;
    	$chitietsanpham->unit = $req->unit;
    	$chitietsanpham->description = $req->noidung;
    	$chitietsanpham->unit_price = $req->dongia;
    	$chitietsanpham->promotion_price = $req->giakm;
    	$chitietsanpham->new = $req->new;
    	$file = $req->file('hinh');
    	$tenhinh = $file->getClientOriginalName();
        // echo $tenhinh;
    	$file->move('source/image/product',$tenhinh);
    	unlink('source/image/product/'.$chitietsanpham->image);
    	$chitietsanpham->image = $tenhinh;
    	$chitietsanpham->save();
        return redirect('admin/chitietsanpham/sua/'.$id)->with('thongbao','sửa sản phẩm thành công');
    }

    public function getThem(){
    	$loaisanpham=ProductType::all();
    	return view('admin.chitietsanpham.them',['loaisanpham'=>$loaisanpham]);
    }


    public function postThem(Request $req){
    	$this->validate($req,
    		[
    			'sp' => 'required|min:5|max:100',
    			'noidung' => 'required',
    			'dongia' => 'required',
    			'giakm' => 'required',
    			'new' => 'required'
    		],
    		[
    			'sp.required'=>'bạn chưa nhập loại sản phẩm',
    			'sp.min'=>'nhập trên 5 ký tự',
    			'sp.max'=>'quá nhiều ký tự',
    			// 'sp.unique'=>'loại bánh đã có',
    			'noidung.required'=>'bạn chưa nhập nội dung',
    			'dongia.required'=>'bạn chưa nhập đơn giá',
    			'giakm.required'=>'bạn chưa nhập giá km',
    			'new.required'=>'bạn chưa nhập sản phẩm mới'
    			
    		]);
    	$chitietsanpham = new Product;
    	$chitietsanpham->id_type = $req->loaisanpham;
    	$chitietsanpham->name = $req->sp;
    	$chitietsanpham->unit = $req->unit;
    	$chitietsanpham->description = $req->noidung;
    	$chitietsanpham->unit_price = $req->dongia;
    	$chitietsanpham->promotion_price = $req->giakm;
    	$chitietsanpham->new = $req->new;
    	$file = $req->file('hinh');
    	$tenhinh = $file->getClientOriginalName();
        // echo $tenhinh;
    	$file->move('source/image/product',$tenhinh);
    	$chitietsanpham->image = $tenhinh;
    	$chitietsanpham->save();
    	return redirect('admin/chitietsanpham/them')->with('thongbao','thêm sản phẩm thành công');
    }
}
