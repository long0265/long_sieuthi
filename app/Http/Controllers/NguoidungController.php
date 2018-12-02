<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\User;

class NguoidungController extends Controller
{
    public function getDanhsach(){
    	$nguoidung = User::all();
    	return view('admin.nguoidung.danhsach',['nguoidung'=>$nguoidung]);
    }

    public function getThem(){
    	return view('admin.nguoidung.them');
    }


    public function postThem(Request $req){
    	$this->validate($req,
    		[
    			'name' => 'required|min:2|max:20',
    			'email' => 'required|email',
    			'password' => 'required|min:5|max:20',
    			'matkhau1' => 'required|same:password'
    		],
    		[
    			'name.required'=>'bạn chưa nhập tên',
    			'name.min'=>'nhập trên 2 ký tự',
    			'name.max'=>'quá nhiều ký tự',	
    			'email.required'=>'bạn chưa nhập email',
    			'email.email'=>'bạn chưa đúng định dạng email',
    			'password.required'=>'bạn chưa nhập mật khẩu',
    			'password.min'=>'nhập trên 5 ký tự',
    			'password.max'=>'nhập dưới 20 ký tự',
    			'matkhau1.required'=>'bạn chưa nhập lại mật khẩu',
    			'matkhau1.same'=>'mật khẩu sai',
    		]);
    	$nguoidung = new User;
    	$nguoidung->name = $req->name;
    	$nguoidung->email = $req->email;
    	$nguoidung->password = bcrypt($req->password);
    	$nguoidung->quyen = $req->quyen;
    	$nguoidung->save();
    	return redirect('admin/nguoidung/them')->with('thongbao','thêm người dùng thành công');
    }

    public function getXoa($id){
        $nguoidung = User::find($id);
        $nguoidung->delete();
        return redirect('admin/nguoidung/danhsach')->with('thongbao','xóa thành công');
    }

    public function getSua($id){
    	$nguoidung = User::find($id);
    	return view('admin.nguoidung.sua',['nguoidung'=>$nguoidung]);
    }

    public function postSua(Request $req,$id){
        $nguoidung = User::find($id);
        $this->validate($req,
    		[
    			'name' => 'required|min:2|max:20',
    			'email' => 'required|email',
    			'password' => 'required|min:5|max:20',
    			'matkhau1' => 'required|same:password'
    		],
    		[
    			'name.required'=>'bạn chưa nhập tên',
    			'name.min'=>'nhập trên 2 ký tự',
    			'name.max'=>'quá nhiều ký tự',	
    			'email.required'=>'bạn chưa nhập email',
    			'email.email'=>'bạn chưa đúng định dạng email',
    			'password.required'=>'bạn chưa nhập mật khẩu',
    			'password.min'=>'nhập trên 5 ký tự',
    			'password.max'=>'nhập dưới 20 ký tự',
    			'matkhau1.required'=>'bạn chưa nhập lại mật khẩu',
    			'matkhau1.same'=>'mật khẩu sai',
    		]);
    	$nguoidung->name = $req->name;
    	$nguoidung->email = $req->email;
    	$nguoidung->password = bcrypt($req->password);
    	$nguoidung->quyen = $req->quyen;
    	$nguoidung->save();
        return redirect('admin/nguoidung/sua/'.$id)->with('thongbao','sửa người dùng thành công');
    }

    public function getdangnhapAdmin(){
    	return view('admin.login');
    }

    public function postdangnhapAdmin(Request $req){
    	$this->validate($req,
    		[
    			'email' => 'required',
    			'password' => 'required|min:5|max:20'
    		],
    		[
    			'email.required'=>'bạn chưa nhập email',
    			'password.required'=>'bạn chưa nhập mật khẩu',
    			'password.min'=>'nhập trên 5 ký tự',
    			'password.max'=>'nhập dưới 20 ký tự'
    		]);
    	if(Auth::attempt(['email'=>$req->email,'password'=>$req->password]))
    		{
    			return redirect('admin/loaisanpham/danhsach');
    		}
    	else
    		{
    			return redirect('admin/dangnhap')->with('thongbao','đăng nhập không thành công');
    		}
    }

    public function getdangxuatAdmin(){
    	Auth::logout();
    	return redirect('admin/dangnhap');
    }
}
