@extends('layout.index')
@section('content')

<div class="container">
    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-9">

            <!-- Blog Post -->

            <!-- Title -->
            <h1>{{$tintuc->TieuDe}}</h1>

            <!-- Author -->
           

            <!-- Preview Image -->
            <img class="img-responsive" src="tintuc/{{$tintuc->Hinh}}" alt="">

            <!-- Date/Time -->
           
            <hr>

            <!-- Post Content -->
            <p class="lead"> 
                {!! $tintuc->MoTa !!}
            </p>
            <hr>
            <p class="lead"> 
                {!! $tintuc->NoiDung !!}
            </p>
            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            @if (Auth::user())
            <div class="well">
                @if (session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
                @endif
                <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                <form action="comment/{{$tintuc->id}}" method="POST" role="form">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"  />
                    <div class="form-group">
                        <textarea class="form-control" name="NoiDung"  rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
            </div>

            <hr>
            @endif
            <!-- Posted Comments -->

            <!-- Comment -->
            @foreach ($tintuc->comment as $cm)
                
            
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$cm->user->name}}
                        <small>{{$cm->created_at}}</small>
                    </h4>
                    {{$cm->NoiDung}}
                </div>
            </div>
            @endforeach

          

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin liên quan</b></div>
                <div class="panel-body">
                @foreach ($tinlienquan as $tt )
                       
                   
                    <!-- item -->
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                            <a href="tintuc/{{$tt->id}}">
                                <img class="img-responsive" src="tintuc/{{$tt->Hinh}}" alt="">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <a href="tintuc/{{$tt->id}}"><b>{{$tt->TieuDe}}</b></a>
                        </div>
                        <p style="padding-left:5px">{{$tt->MoTa}}</p>
                        <div class="break"></div>
                    </div>
                    <!-- end item -->
                @endforeach
                    <!-- item -->
                   
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin nổi bật</b></div>
                <div class="panel-body">
                @foreach ($tinnoibat as $tt )
                    <!-- item -->
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                            <a href="tintuc/{{$tt->id}}">
                                <img class="img-responsive" src="tintuc/{{$tt->Hinh}}" alt="">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <a href="tintuc/{{$tt->id}}"><b>{{$tt->TieuDe}}</b></a>
                        </div>
                        <p style="padding-left:5px">{{$tt->MoTa}}</p>
                        <div class="break"></div>
                    </div>
                    <!-- end item -->

                    @endforeach
                    <!-- end item -->
                </div>
            </div>
            
        </div>

    </div>
    <!-- /.row -->
</div>
@endsection