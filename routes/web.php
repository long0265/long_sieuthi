<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});
Route::get('/',[
	'as' => 'trang-chu',
	'uses'=> 'PateController@getIndex'
]);
Route::get('loai-san-pham/{type}',[
	'as' => 'loaisanpham',
	'uses'=> 'PateController@getLoaiSP'
]);
Route::get('chi-tiet-san-pham/{id}',[
	'as' => 'chitietsanpham',
	'uses'=> 'PateController@getChitietSP'
]);
Route::get('lien-he',[
	'as' => 'lienhe',
	'uses'=> 'PateController@getLienHe'
]);
Route::get('gioi-thieu',[
	'as' => 'gioithieu',
	'uses'=> 'PateController@getGioiThieu'
]);

Route::get('add-to-cart/{id}',[
	'as' => 'themgiohang',
	'uses' => 'PateController@getAddtoCart'
]);

Route::get('del-cart/{id}',[
	'as' => 'xoagiohang',
	'uses' => 'PateController@getDelCart'
]);

Route::get('dat-hang',[
	'as' => 'dathang',
	'uses'=> 'PateController@getDatHang'
]);

Route::post('dat-hang',[
	'as' => 'dathang',
	'uses'=> 'PateController@postDatHang'
]);

Route::get('dang-nhap',[
	'as' => 'dangnhap',
	'uses' => 'PateController@getLongin'
]);

Route::get('dang-ki',[
	'as' => 'dangki',
	'uses' => 'PateController@getSingin'
]);

Route::get('search',[
	'as' => 'search',
	'uses' => 'PateController@getSearch'
]);

Route::get('admin/dangnhap',[
	'as' => 'admindangnhap',
	'uses' => 'NguoidungController@getdangnhapAdmin'
]);

Route::post('admin/dangnhap',[
	'as' => 'admindangnhap',
	'uses' => 'NguoidungController@postdangnhapAdmin'
]);

Route::get('admin/dangxuat',[
	'as' => 'admindangxuat',
	'uses' => 'NguoidungController@getdangxuatAdmin'
]);


Route::group(['prefix'=>'admin'],function(){
	Route::group(['prefix'=>'chitietsanpham'],function(){
		Route::get('danhsach',[
			'as' => 'danh-sach',
			'uses' => 'ChitietsanphamController@getDanhsach'
		]);

		Route::get('sua/{id}',[
			'as' => 'edit',
			'uses' => 'ChitietsanphamController@getSua'
		]);

		Route::post('sua/{id}',[
			'as' => 'edit',
			'uses' => 'ChitietsanphamController@postSua'
		]);

		Route::get('them',[
			'as' => 'add',
			'uses' => 'ChitietsanphamController@getThem'
		]);

		Route::post('them',[
			'as' => 'add',
			'uses' => 'ChitietsanphamController@postThem'
		]);	

		Route::get('xoa/{id}',[
			'as' => 'del',
			'uses' => 'ChitietsanphamController@getXoa'
		]);		
	});

	Route::group(['prefix'=>'loaisanpham'],function(){
		Route::get('danhsach',[
			'as' => 'danh-sach',
			'uses' => 'LoaisanphamController@getDanhsach'
		]);

		Route::get('sua/{id}',[
			'as' => 'edit',
			'uses' => 'LoaisanphamController@getSua'
		]);

		Route::post('sua/{id}',[
			'as' => 'edit',
			'uses' => 'LoaisanphamController@postSua'
		]);

		Route::get('them',[
			'as' => 'add',
			'uses' => 'LoaisanphamController@getThem'
		]);

		Route::post('them',[
			'as' => 'add',
			'uses' => 'LoaisanphamController@postThem'
		]);	

		Route::get('xoa/{id}',[
			'as' => 'del',
			'uses' => 'LoaisanphamController@getXoa'
		]);

	});

	Route::group(['prefix'=>'nguoidung'],function(){
		Route::get('danhsach',[
			'as' => 'danh-sach',
			'uses' => 'NguoidungController@getDanhsach'
		]);

		Route::get('sua/{id}',[
			'as' => 'edit',
			'uses' => 'NguoidungController@getSua'
		]);

		Route::post('sua/{id}',[
			'as' => 'edit',
			'uses' => 'NguoidungController@postSua'
		]);

		Route::get('them',[
			'as' => 'add',
			'uses' => 'NguoidungController@getThem'
		]);

		Route::post('them',[
			'as' => 'add',
			'uses' => 'NguoidungController@postThem'
		]);	

		Route::get('xoa/{id}',[
			'as' => 'del',
			'uses' => 'NguoidungController@getXoa'
		]);

	});
});



