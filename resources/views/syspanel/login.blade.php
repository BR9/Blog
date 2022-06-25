<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>Blog</title>

    <!-- Generics -->
    <link rel="icon" href="{{asset('syspanel')}}/assets/images/favicon/favicon-32.png" sizes="32x32">
    <link rel="icon" href="{{asset('syspanel')}}/assets/images/favicon/favicon-128.png" sizes="128x128">
    <link rel="icon" href="{{asset('syspanel')}}/assets/images/favicon/favicon-192.png" sizes="192x192">

    <!-- Android -->
    <link rel="shortcut icon" href="{{asset('syspanel')}}/assets/images/favicon/favicon-196.png" sizes="196x196">

    <!-- iOS -->
    <link rel="apple-touch-icon" href="{{asset('syspanel')}}/assets/images/favicon/favicon-152.png" sizes="152x152">
    <link rel="apple-touch-icon" href="{{asset('syspanel')}}/assets/images/favicon/favicon-167.png" sizes="167x167">
    <link rel="apple-touch-icon" href="{{asset('syspanel')}}/assets/images/favicon/favicon-180.png" sizes="180x180">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('syspanel')}}/assets/css/style.css" />
</head>

<body>

<div class="container flex items-center justify-center mt-20 py-10">
    <div class="w-full md:w-1/2 xl:w-1/3">
        <div class="mx-5 md:mx-10">
            <h2 class="uppercase">Laravel Test-Case Blog v1</h2>
            <h4 class="uppercase">Kontrol Paneli</h4>
        </div>
        <form id="cform" class="card mt-5 p-5 md:p-10" method="POST">
            @csrf
            <div class="mb-5">
                <label class="label block mb-2" for="email">Email</label>
                <input id="email" name="email" type="text" class="form-control" placeholder="example@example.com">
            </div>
            <div class="mb-5">
                <label class="label block mb-2" for="password">Şifre</label>
                <label class="form-control-addon-within">
                    <input id="password" name="password" type="password" class="form-control border-none" placeholder="****">
                    <span class="flex items-center ltr:pr-4 rtl:pl-4">
                            <button type="button"
                                    class="btn btn-link text-gray-300 dark:text-gray-700 la la-eye text-xl leading-none"
                                    data-toggle="password-visibility"></button>
                        </span>
                </label>

            </div>

            <div id="_validation"></div>
            <br>

            <div class="flex items-center">
                <button type="button" onclick="login_core_form('{{route('login')}}');" class="btn btnSub btn_primary ltr:ml-auto rtl:mr-auto uppercase">Giriş Yap <i class='fa-solid fa-circle-notch fa-spin' style="display:none;margin-left:5px;"></i></button>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script src="{{asset('syspanel')}}/assets/js/vendor.js"></script>
<script src="{{asset('syspanel')}}/assets/js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('syspanel')}}/assets/js/core.js"></script>

</body>
</html>