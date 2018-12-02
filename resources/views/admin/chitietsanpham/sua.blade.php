@extends('admin/adminLayout/masterLayout')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản phẩm
                            <small>{{$chitietsanpham->name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif
                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="admin/chitietsanpham/sua/{{$chitietsanpham->id}}" method="POST" enctype="multipart/form-data">                           
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>Loại sản phẩm</label>
                                <select class="form-control" name="loaisanpham">
                                @foreach($loaisanpham as $sp)
                                    <option 
                                    @if($chitietsanpham->id_type == $sp->id)
                                        {{"selected"}}
                                    @endif
                                    value="{{$sp->id}}">{{$sp->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sản phẩm</label>
                                <input class="form-control" name="sp" placeholder="Nhập tên bánh" value="{{$chitietsanpham->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="demo" name="noidung" class="form-control ckeditor" rows="3" >{{$chitietsanpham->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Đơn giá</label>
                                <input class="form-control" name="dongia" placeholder="Nhập đơn giá" value="{{$chitietsanpham->unit_price}}" />
                            </div>
                            <div class="form-group">
                                <label>Giá khuyến mãi</label>
                                <input class="form-control" name="giakm" placeholder="Nhập giá khuyến mãi" value="{{$chitietsanpham->promotion_price}}" />
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <p>
                                <img src="source/image/product/{{$chitietsanpham->image}}" >
                                </p>
                                <input type="file" name="hinh" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>unit</label>
                                <input class="form-control" name="unit" placeholder="cái/hộp" value="{{$chitietsanpham->unit}}" />
                            </div>
                            <div class="form-group">
                                <label>Sản phẩm mới:</label>
                                <label class="radio-inline">
                                    <input name="new" value="0" 
                                    @if($chitietsanpham->new == 0)
                                        {{"checked"}}
                                    @endif
                                    type="radio">cũ
                                </label>
                                <label class="radio-inline">
                                    <input name="new" value="1" 
                                    @if($chitietsanpham->new == 1)
                                        {{"checked"}}
                                    @endif
                                    type="radio">mới
                                </label>
                            </div>
                            <p></p>                       
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
</div>
@endsection