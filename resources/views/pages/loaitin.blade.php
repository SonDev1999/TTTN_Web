@extends('layout.index')
@section('content')
<div class="container">
    <div class="row">
       @include('layout.menu')
        <div class="col-md-9 ">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#337AB7; color:white;">
                    <h4><b>{{$loaitin->Ten}}</b></h4>
                </div>
                @foreach ($tintuc as $tt)
                    
               
                <div class="row-item row">
                    <div class="col-md-3">

                        <a href="detail.html">
                            <br>
                            <img width="200px" height="200px" class="img-responsive" src="tintuc/{{$tt->Hinh}}" alt="">
                        </a>
                    </div>

                    <div class="col-md-9">
                        <h3>{{$tt->TieuDe}}</h3>
                        <p>{{$tt->MoTa}}</p>
                        <a class="btn btn-primary"  href="tintuc/{{$tt->id}}"> Xem Thêm <span class="glyphicon glyphicon-chevron-right"></span></a>
                    </div>
                    <div class="break"></div>
                </div>
                @endforeach
             
                <!-- Pagination -->
              
                <!-- /.row -->
                <div class="row text-center">
                    
                             {{$tintuc->links()}}
   
        </div>
            </div>
        </div> 

    </div>

</div>
@endsection