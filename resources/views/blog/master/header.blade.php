<!doctype html>
<html lang="en">
<head>

    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- favicon -->
    <link rel="icon" sizes="16x16" href="{{asset('blog')}}/assets/img/favicon.png">

    <!-- Title -->
    <title> {{$system_settings->title}} | @yield('page_title')</title>

    <meta name="description" content="{{$system_settings->description}}" />


    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">

    <!-- CSS Plugins -->
    <link rel="stylesheet" href="{{asset('blog')}}/assets/css/all.css">
    <link rel="stylesheet" href="{{asset('blog')}}/assets/css/elegant-font-icons.css">
    <link rel="stylesheet" href="{{asset('blog')}}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('blog')}}/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- main style -->
    <link rel="stylesheet" href="{{asset('blog')}}/assets/css/style.css">
    <link rel="stylesheet" href="{{asset('blog')}}/assets/css/custom.css">

    {!!$system_settings->analytics!!}

</head>
<body>