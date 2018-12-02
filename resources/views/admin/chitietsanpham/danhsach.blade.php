@extends('admin/adminLayout/masterLayout')
@section('content')
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại sản phẩm
                            <small>danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>ID type</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Unit price</th>
                                <th>Promotion price</th>
                                <th>Image</th>
                                <th>Unit</th>
                                <th>New</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($chitietsanpham as $lsp)
                            <tr class="odd gradeX" align="center">
                                <td>{{$lsp->id}}</td>
                                <td width="70px">{{$lsp->id_type}}</td>
                                <td>{{$lsp->name}}</td>
                                <td width="200px">{{$lsp->description}}</td>
                                <td>{{$lsp->unit_price}}</td>
                                <td>{{$lsp->promotion_price}}</td>
                                <td><img width="200px" height="150px" src="source/image/product/{{$lsp->image}}" alt=""></td>
                                <td>{{$lsp->unit}}</td>
                                <td>{{$lsp->new}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/chitietsanpham/xoa/{{$lsp->id}}">Xóa</a></td>
                                <td width="70px" class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/chitietsanpham/sua/{{$lsp->id}}">Sửa</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection