<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/styles.css">
    <title>@section('title') AstroBank @show</title>
</head>

<body>
    <header class="header header_bg">
        <div class="wrapper wrapper_default">
            <div class="header__content">
                <div class="header__logo">
                    <a href="/home">
                        <img src="/images/astroBank.png" alt="">
                    </a>
                    <div class="header__data current-date">
                        <span></span>
                    </div>
                </div>
                <div class="header__navbar">
                    <a href="/dashboard">
                        <img src="/images/home.gif" alt="">
                    </a>
                    <a href="#">
                        <img src="/images/sitemap1.gif" alt="">
                    </a>
                    <a href="#" class="logout-btn"><img src="/images/exit.gif" alt=""></a>
                </div>

            </div>
            <!-- <span style="color:white; font-size: 10px; margin-bottom: 5px">{{date('Y-m-d H:i:s')}}</span> -->
        </div>

        <script
                src="https://code.jquery.com/jquery-3.4.1.min.js"
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
                crossorigin="anonymous"></script>

        <script src="/js/my.js"></script>

    </header>
    <main class="main main_bg" id="vue-app" v-blockui="preloaders.page">
        <div class="wrapper wrapper_default">
            <div class="wrapper__content">
                @include('parts.mainmenu')
                @yield('content')
            </div>
        </div>
    </main>

    <script src="/js/select2.full.min.js"></script>
    <script src="/js/main.js"></script>


    @yield('scripts')

    

    

</body>
</html>