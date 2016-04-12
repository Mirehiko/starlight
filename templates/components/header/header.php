<div class='navbar navbar-custom navbar-fixed-top' role='navigation' id='header_h'>
    <div class='container'>
        <div class='navbar-header'>
            <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#responsive-menu'>
                <span class='sr-only'>Открыть навигацию</span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
            </button>
            <a class='navbar-brand' href="/"><i class="fa fa-sun-o"></i>
            <!--<img src="images/w128h1281338911405sun.png" height="50px">-->
            </a>
        </div>
        <div class='collapse navbar-collapse' id='responsive-menu'>
            <ul class='nav navbar-nav'>
            	<li><a href="/films/">Фильмы</a></li>
            	<li><a href="/series/">Сериалы</a></li>
            	<li><a href="/anime/">Аниме</a></li>
                <li><a href="/contacts/">Контакты</a></li>
                <li><a href="/about/">О нас</a></li>
                <!--<li><a href="#">О кинотеатре</a></li>-->
            </ul>
            <?php include('/templates/moduls/autocomplete/autocomplete.php'); ?>
        </div>
    </div>
</div>

<div id='header_c'>
    <div class='container'>
        <div class='logo'>
            <a href='/' title='Рассветный - онлайн кинотеатр'></a>
        </div>
        <div id='user_info'>

        <?php
        if(isset($_SESSION['user'])){
            $autorized=true;
        }else{
            $autorized=false;
        }
        if($autorized==true){
            #Вид для авторизованного пользователя
            echo "
            <span class='intro intro-name'>
                Добро пожаловать<br>
                <a href='/user/".$user['id']."'>
                <b>".$user['username']."</b>
                </a>
            </span>
            <span class='avatar'>
                <img src='".$user['avatar']."' alt='".$user['username']."'>
            </span>
            <span class='menu menu-u'>
                <a href='/user/".$user['id']."'>Мой профиль</a>
                <a href='/user/logout/'>Выйти <i class='fa fa-sign-out'></i></a>
            </span>
            ";
        }else {
            #Вид для неавторизованного пользователя
            echo "
            <span class='intro intro-form'>
                <input class='form-autorization' type='text' placeholder='Логин'>
                <input class='form-autorization f-a-p' type='password' placeholder='Пароль'>
                <a href='/user/login' id='f-a-b' class='btn btn-custom '>Войти</a>
            </span>
            <span class='menu menu-a'>
                <a href='/user/register'>Регистрация</a>
            </span>
            ";
        }
        ?>

        </div>
    </div>
</div>
<div id='header_b'></div>