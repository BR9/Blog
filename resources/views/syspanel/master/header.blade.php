<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title> {{$system_settings->title}} - @yield('page_title')</title>

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


    <link rel="stylesheet" href="{{asset('syspanel')}}/assets/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>
<body>