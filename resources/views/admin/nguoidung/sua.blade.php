@extends('admin/adminLayout/masterLayout')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Người dùng
                            <small>{{$nguoidung->name}}</small>
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
                        <form action="admin/nguoidung/sua/{{$nguoidung->id}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <div class="form-group">
                                <label>Tên user</label>
                                <input class="form-control" name="name" placeholder="Nhập tên" value="{{$nguoidung->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Nhập email" value="{{$nguoidung->email}}" />
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" name="matkhau1" placeholder="Nhập lại mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Quyền hạn:</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" 
                                    @if($nguoidung->quyen == 0)
                                    {{"checked"}}
                                    @endif
                                    type="radio">Thường
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1"
                                    @if($nguoidung->quyen == 1)
                                    {{"checked"}}
                                    @endif
                                    type="radio">Admin
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