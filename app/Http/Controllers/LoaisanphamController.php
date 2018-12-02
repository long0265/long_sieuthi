<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductType;

class LoaisanphamController extends Controller
{
    public function getDanhsach(){
    	$loaisanpham = ProductType::all();
    	return view('admin.loaisanpham.danhsach',['loaisanpham'=>$loaisanpham]);
    }

    public function getXoa($id){
        $loaisanpham = ProductType::find($id);
        $loaisanpham->delete();
        unlink('source/image/product/'.$loaisanpham->image);
        return redirect('admin/loaisanpham/danhsach')->with('thongbao','xóa thành công');
    }

    public function getSua($id){
    	$loaisanpham = ProductType::find($id);
    	return view('admin.loaisanpham.sua',['loaisanpham'=>$loaisanpham]);
    }

    public function postSua(Request $req,$id){
        $loaisanpham = ProductType::find($id);
        $this->validate($req,
            [
                'loaisp' => 'required|min:5|max:100',
                'noidung' => 'required'
            ],
            [
                'loaisp.required'=>'bạn chưa nhập loại sản phẩm',
                'loaisp.min'=>'nhập trên 5 ký tự',
                'loaisp.max'=>'quá nhiều ký tự',
                // 'loaisp.unique'=>'loại bánh đã có',
                'noidung.required'=>'bạn chưa nhập nội dung'
                
            ]);
        $loaisanpham->name = $req->loaisp;
        $loaisanpham->description = $req->noidung;
        $file = $req->file('hinh');
        $tenhinh = $file->getClientOriginalName();
        // echo $tenhinh;
        $file->move('source/image/product',$tenhinh);
        unlink('source/image/product/'.$loaisanpham->image);
        $loaisanpham->image = $tenhinh;
        $loaisanpham->save();
        return redirect('admin/loaisanpham/sua/'.$id)->with('thongbao','sửa loại sản phẩm thành công');
    }

    public function getThem(){
    	return view('admin.loaisanpham.them');
    }


    public function postThem(Request $req){
    	$this->validate($req,
    		[
    			'loaisp' => 'required|min:5|max:100',
    			'noidung' => 'required'
    		],
    		[
    			'loaisp.required'=>'bạn chưa nhập loại sản phẩm',
    			'loaisp.min'=>'nhập trên 5 ký tự',
    			'loaisp.max'=>'quá nhiều ký tự',
    			// 'loaisp.unique'=>'loại bánh đã có',
    			'noidung.required'=>'bạn chưa nhập nội dung'
    			
    		]);
    	$loaisanpham = new ProductType;
    	$loaisanpham->name = $req->loaisp;
    	$loaisanpham->description = $req->noidung;
    	$file = $req->file('hinh');
    	$tenhinh = $file->getClientOriginalName();
        // echo $tenhinh;
    	$file->move('source/image/product',$tenhinh);
    	$loaisanpham->image = $tenhinh;
    	$loaisanpham->save();
    	return redirect('admin/loaisanpham/them')->with('thongbao','thêm loại sản phẩm thành công');
    }
}
