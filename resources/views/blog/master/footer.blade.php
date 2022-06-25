<!--newslettre-->
<section class="newslettre">
    <div class="container-fluid">
        <div class="newslettre-width text-center">
            <div class="newslettre-info">
                <h5>Bir şeyler mi arıyorsun?</h5>
                <p> Blog yazılarında arayın... </p>
            </div>
            <form action="{{route('blog-home')}}" method="GET" class="newslettre-form">
                <div class="form-flex">
                    <div class="form-group">
                        <input type="text" name="s" class="form-control" autocomplete="off">
                    </div>
                    <button class="submit-btn" type="submit">Ara</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!--footer-->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="copyright">
                    <p>© Copyright {{date("Y")}}
                        <a href="#">{{$system_settings->title}}</a>, Tüm Hakları Saklıdır.</p>
                </div>
                <div class="back">
                    <a href="#" class="back-top">
                        <i class="arrow_up"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!--Search-form-->
<div class="search">
    <div class="container-fluid">
        <div class="search-width  text-center">
            <button type="button" class="close">
                <i class="icon_close"></i>
            </button>
            <form class="search-form" action="{{route('blog-home')}}" method="GET">
                <input type="search" name="s" placeholder="Blog yazısı arayın..">
                <button type="submit" class="search-btn">ara</button>
            </form>
        </div>
    </div>
</div>
<!--/-->



<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('blog')}}/assets/js/jquery-3.5.0.min.js"></script>
<script src="{{asset('blog')}}/assets/js/popper.min.js"></script>
<script src="{{asset('blog')}}/assets/js/bootstrap.min.js"></script>

<!-- JS Plugins  -->
<script src="{{asset('blog')}}/assets/js/ajax-contact.js"></script>
<script src="{{asset('blog')}}/assets/js/owl.carousel.min.js"></script>


<!-- JS main  -->
<script src="{{asset('blog')}}/assets/js/main.js"></script>


</body>


<!-- Mirrored from noonpost.netlify.app/html/template/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Jun 2022 15:21:43 GMT -->
</html>