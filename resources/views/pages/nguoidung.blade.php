@section('title')
	Quản lý Thông tin Người Dùng
@endsection

@extends('layout.index')

@section('content')
<script src="admin_asset/dist/js/extra.js"></script>
<!-- Page Content -->
<div class="container">

	<!-- slider -->
	<div class="row carousel-holder">
		<div class="col-md-2">
		</div>
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Thông tin tài khoản</h4></div>
				<div class="panel-body">
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
					<form action="nguoidung" method="POST">
						{{ csrf_field() }}
						<div>
							<label>Tên Người Dùng</label>
							<input type="text" class="form-control" name="name" aria-describedby="basic-addon1" value="{{ $nguoidung->name }}">
						</div>
						<br>
						<div>
							<label>Địa Chỉ Email</label>
							<input type="email" class="form-control" name="email" aria-describedby="basic-addon1" value="{{ $nguoidung->email }}" 
							readonly
							>
						</div>
						<br>	
						<div class="form-group">
                            <input type="checkbox" name="changePassword" id="changePassword">
                            <label>Đổi mật khẩu</label>
                            <input disabled="" class="form-control password" name="password" type="password" placeholder="Nhập mật khẩu" />
                        </div>
                        <div class="form-group">
                            <label>Nhập lại Passwork</label>
                            <input  disabled="" class="form-control password" name="passwordAgain"  type="password" placeholder="Nhập lại mật khẩu" />
                        </div>
						<br>
						<button type="submit" class="btn btn-primary">Thực Hiện
						</button>

					</form>
				</div>
			</div>
		</div>
		<div class="col-md-2">
		</div>
	</div>
	<!-- end slide -->
</div>
@section('script')
    <script>
        $(document).ready(function(){
            $("#changePassword").change(function(){
                if($(this).is(":checked")){
                    $(".password").removeAttr('disabled');
                }else{
                    $(".password").attr('disabled','');
                }
            });
        });

    </script>
<!-- end Page Content -->
@endsection