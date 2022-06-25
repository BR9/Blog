@extends('blog.template')
@section('page_title', $blog->blog_title)
@section('content')

    <section class="section pt-55 ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 mb-20">
                    <!--Post-single-->
                    <div class="post-single">
                        <div class="post-single-image" style="text-align:center;">
                            <img src="{{asset('blog')}}/assets/img/blog/{{$blog->blog_img}}" alt="{{$blog->blog_title}}" style="width:60%;">
                        </div>
                        <div class="post-single-content">
                            <a href="{{route('blog-home')}}/?cat={{$blog->category_id}}" class="categories">{{$blog->category_name}}</a>
                            <h4> {{$blog->blog_title}} </h4>
                            <div class="post-single-info">
                                <ul class="list-inline">
                                    <li><a href="#"><img src="assets/img/user/{{$blog->profile_photo_path}}" alt=""></a></li>
                                    <li><a href="#">{{$blog->name}} {{$blog->surname}}</a> </li>
                                    <li class="dot"></li>
                                    <li>{{date("d-m-Y", strtotime($blog->created_at))}}</li>
                                    <li class="dot"></li>
                                </ul>
                            </div>
                        </div>

                        <div class="post-single-body">

                            {!!$blog->blog_content!!}

                        </div>
                    </div> <!--/-->

                </div>
                <div class="col-lg-4 max-width">
                    <!--widget-author-->
                    <div class="widget">
                        <div class="widget-author">
                            <a href="#" class="image">
                                <img src="{{asset('blog')}}/assets/img/user/{{$blog->profile_photo_path}}" alt="{{$blog->name}} {{$blog->surname}}">
                            </a>
                            <h6>
                                <span>{{$blog->name}} {{$blog->surname}}</span>
                            </h6>
                        </div>
                    </div>
                    <!--/-->

                    <!--widget-latest-posts-->
                    <div class="widget ">
                        <div class="section-title">
                            <h5>Son Bloglar</h5>
                        </div>
                        <ul class="widget-latest-posts">

                            @foreach($last_blogs as $p)

                                <li class="last-post">
                                    <div class="image">
                                        <a href="{{route('blog-detail', [$p->id])}}">
                                            <img src="{{asset('blog')}}/assets/img/blog/{{$p->blog_img}}" alt="{{$p->blog_title}}">
                                        </a>
                                    </div>
                                    <div class="nb">1</div>
                                    <div class="content">
                                        <p><a href="{{route('blog-detail', [$p->id])}}">{{$p->blog_title}}</a></p>
                                        <small><span class="icon_clock_alt"></span> {{date("d-m-Y", strtotime($p->created_at))}}</small>
                                    </div>
                                </li>

                            @endforeach

                        </ul>
                    </div>
                    <!--/-->

                </div>
            </div>
        </div>
    </section>

    @csrf

    <script>
        // Initialize the agent at application startup.
        const fpPromise = import('https://openfpcdn.io/fingerprintjs/v3')
            .then(FingerprintJS => FingerprintJS.load())

        // Get the visitor identifier when you need it.
        fpPromise
            .then(fp => fp.get())
            .then(result => {
                // This is the visitor identifier:
                const visitorId = result.visitorId
                console.log(visitorId)

                var csrf    =   $('input[name=_token]').val();

                $.ajax({

                    type:'POST',
                    url:'{{route('visitorControl')}}',
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    },
                    data:'visitorId='+visitorId+'&blog={{Request::segment(2)}}',
                    success:function(data){

                        return true;

                    }

                });

            });


    </script>

@endsection