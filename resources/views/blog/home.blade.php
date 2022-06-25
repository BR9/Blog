@extends('blog.template')
@section('page_title', 'Ana Sayfa')
@section('content')

    <!--grid-layout-->
    <section class="section pt-85">
        <div class="container-fluid">
            <div class="row justify-content-center">

                @if(count($blogs) <= 0)
                    <i class="fa-solid fa-blog" style="font-size:20px;"></i> <h5 style="line-height: 150px;margin-top:-56px;" class="text-center">Herhangi bir blog yazısı bulunamadı! <a style="text-decoration: underline;color:#f67280;" href="{{route('blog-home')}}">{{(!empty(Request::get('s'))) ? 'Geri Dön' : ''}}</a></h5>
                @endif


                @foreach($blogs as $p)

                    <div class="col-lg-4 col-md-6">
                        <!--Post-1-->
                        <div class="post-card">
                            <div class="post-card-image">
                                <a href="{{route('blog-detail', [$p->id])}}">
                                    <img src="{{asset('blog')}}/assets/img/blog/{{$p->blog_img}}" alt="{{$p->blog_title}}">
                                </a>
                            </div>
                            <div class="post-card-content">
                                <a href="{{route('blog-home')}}/?cat={{$p->category_id}}" class="categorie">{{$p->category_name}}</a>
                                <h5>
                                    <a href="{{route('blog-detail', [$p->id])}}">{{$p->blog_title}}</a>
                                </h5>
                                <p style="font-size:14px;">{!!substr(strip_tags($p->blog_content),0,100)!!}
                                </p> 
                                <div class="post-card-info">
                                    <ul class="list-inline">
                                        <li>
                                            <a href="#">
                                                <img src="{{asset('blog')}}/assets/img/user/{{$p->profile_photo_path}}" alt="{{$p->name}} {{$p->surname}}">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">{{$p->name}} {{$p->surname}}</a>
                                        </li>
                                        <li class="dot"></li>
                                        <li>{{date("d-m-Y", strtotime($p->created_at))}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--/-->
                    </div>

                @endforeach

                <style>

                    .pagination{justify-content: center;}

                </style>

                <!--pagination-->
                <div class="col-lg-12 ">
                    <ul class="list-inline">
                        @if($blogs->hasPages())

                            {{ $blogs->withQueryString()->links('pagination::bootstrap-4')  }}

                        @endif

                    </ul>

                    <!--/-->
                </div>
            </div>
        </div>
    </section>
    <!--/-->

@endsection