<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Главная - Health and Eating</title>
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="stylesheet" type="text/css" href="/css/front.css">
</head>

<body>
    <div id="wrapper">
        <div id="header" class="row">
            <div class="col-12">
                <div class="header-in">
                    <div class="logo">
                        <a href="/"><img src="/img/logo.png" alt="Health and Eating" title="Перейти на главную"></a>
                    </div>
                    <ul class="menu1">
                        <li><a <?php if ( $_SERVER['REQUEST_URI'] === "/" ){echo "class='act-menu1'";} ?> href="/">Главная</a></li>
                        <!-- <li><a href="/shop">Магазин</a></li> -->
                        <li> <a <?php if ( $_SERVER['REQUEST_URI'] === "/about" ){echo "class='act-menu1'";} ?> href="/about">О нас</a></li>
                        @if(Auth::check())
                            <li><a <?php if ( $_SERVER['REQUEST_URI'] === "/profile" ) {echo "class='act-menu1'";} ?> href="/profile">Мой профиль</a></li>  
                            <li><a <?php if ( $_SERVER['REQUEST_URI'] === "/logout" ) {echo "class='act-menu1'";} ?> href="/logout">Выйти</a></li> 
                        @else   
                            <li><a <?php if ( $_SERVER['REQUEST_URI'] === "/register" ){echo "class='act-menu1'";} ?> href="/register">Регистрация</a></li>
                            <li><a <?php if ( $_SERVER['REQUEST_URI'] === "/login" ){echo "class='act-menu1'";} ?> href="/login">Войти</a></li>
                        @endif    
                    </ul>
                </div>
            </div>
        </div>

        <!-- CONTENT FULL-->
        <div id="fullcontent" class="row">

         <!-- ВАЛИДАЦИЯ -->
        <!-- <div class="container"> 
            <div class="row">
               <div class="col-md-12">
                   @if(session('status'))
                        <div class="alert alert-info">
                            {{-- session('status') --}}
                        </div>
                    @endif
               </div>
            </div>
        </div>   -->  

            @yield('content')

        </div>
        <div id="footer" class="row">
            <div class="col-12">
                <div class="footer-in">
                    <p>Health and Eating © 2018</p>
                </div>
            </div>
        </div>
    </div>
<!-- <script src="/js/front.js"></script>  -->   
</body>

</html>