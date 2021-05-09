@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if (count($errors)>0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $err )
                        {{$err}}<br>
                  @endforeach
                </div>
            @endif
            @if (session('thongbao'))
            <div class="alert alert-success">
                {{session('thongbao')}}
            </div>
            @endif
                <form action="admin/user/them" method="POST">
                     <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="form-group">
                        <label>Họ tên</label>
                        <input class="form-control" name="name" placeholder="Tên người dùng" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" type="email" placeholder="Địa chỉ email" />
                    </div>
                    <div class="form-group">
                        <label>Passwork</label>
                        <input class="form-control" name="password" type="password" placeholder="Nhập mật khẩu" />
                    </div>
                    <div class="form-group">
                        <label>Nhập lại Passwork</label>
                        <input class="form-control" name="passwordAgain"  type="password" placeholder="Nhập lại mật khẩu" />
                    </div>

                   
                    <div class="form-group">
                        <label>Quyền</label>
                        <label class="radio-inline">
                            <input name="quyen" value="1" checked="" type="radio">Admin
                        </label>
                        <label class="radio-inline">
                            <input name="quyen" value="0" type="radio">Thường
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Thêm</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection