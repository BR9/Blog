<!--loading -->
<div class="loading">
    <div class="circle"></div>
</div>
<!--/-->

<!-- Navigation-->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <!--logo-->
        <div class="logo">
            <a href="{{route('blog-home')}}">
                <img src="{{asset('blog')}}/assets/img/logo/{{$system_settings->logo}}" alt="{{$system_settings->title}}" class="logo-dark">
            </a>
        </div>
        <!--/-->

        <!--navbar-collapse-->
        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav ml-auto mr-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('blog-home')}}" > Ana Sayfa </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Kategoriler
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                        @foreach($categories as $c)

                            @if($c->sid <= 0)

                                @php $sub_category   =   DB::table('categories')->select('id','category_name')->where('sid', $c->id)->get(); @endphp

                                @if(count($sub_category) > 0)

                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">{{$c->category_name}}</a>
                                        <ul class="dropdown-menu" style="margin-top:-28px;line-height: 33px;">

                                            @foreach($sub_category as $s)

                                                <li><a class="dropdown-item" href="{{route('blog-home')}}/?cat={{$s->id}}">{{$s->category_name}}</a></li>

                                            @endforeach

                                        </ul>
                                    </li>

                                @else
                                    <li><a class="dropdown-item" href="{{route('blog-home')}}/?cat={{$c->id}}">{{$c->category_name}}</a></li>
                                @endif

                            @endif

                        @endforeach

                    </ul>
                </li>


            </ul>
        </div>
        <!--/-->

        <!--navbar-right-->
        <div class="navbar-right ml-auto">

            <div class="social-icones">
                <ul class="list-inline">
                    <li>
                        <a href="https://www.facebook.com/brfuat">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/brfuat">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.twitter.com/brfuat">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="search-icon">
                <i class="icon_search"></i>
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</nav>
<!--/-->
