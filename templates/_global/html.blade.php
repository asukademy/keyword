{{-- Part of starter project. --}}
<!doctype html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <title>@yield('siteTitle', 'Google / Yahoo 關鍵字排名查詢')</title>

    <link rel="shortcut icon" type="image/x-icon" href="http://simular.co/templates/tz_jollyany_joomla/favicon.ico" />
    <meta name="generator" content="The Time Machine" />
    <meta property="og:image" content="http://i.imgur.com/evQv6pK.png"/>
    @yield('meta')

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ $uri['base.path'] }}media/css/acme/main.css" />
    @yield('style')

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    @yield('script')

</head>
<body style="margin-top: 75px;">
    @section('navbar')
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ $uri['base.path'] }}">Google / Yahoo 關鍵字排名查詢</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                     @section('nav')
                        <li class="active"><a href="{{ $uri['base.path'] }}">首頁</a></li>
                     @show
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    {{-- <li class="pull-right"><a href="{{ $uri['base.path'] }}admin">Admin</a></li> --}}
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
    @show

    @yield('body', 'Content')

    @section('copyright')
    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <hr />

                    <footer>
                        &copy; Powered by <a href="http://simular.co" target="_blank">Simular</a> {{ $datetime->format('Y') }}
                    </footer>
                </div>
            </div>
        </div>
    </div>
    @show
</body>
</html>
