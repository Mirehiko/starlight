<!DOCTYPE html>
<html lang="ru">
<head>

    <?php include('/templates/css/all_styles.php');?>

    <link href="/templates/moduls/slider/slider.css" rel="stylesheet">
    <script src="/templates/moduls/slider/slider.js"></script>


    <style type="text/css">
    /**/
        .content-div{
            background-color: rgba(0, 0, 0, .075);
            padding-top: 15px;
            min-height: 700px;
        }
        .background-div{
            background-color: #FFF;
            min-height: 600px;
            margin-top: 15px;
        }
        .content-h{
            font-size: 18px;
            color: #434855;
            font-family: 'NeoSansCyr-Medium', sans-serif;
            padding: 15px;
            margin: 0;
        }
        .content-c{
            display: block;
            text-overflow: ellipsis;
            padding:  0 20px 20px 15px;
        }
    </style>
    <script type="text/javascript">

    </script>
</head>
<body>
<!--Шапка-->
<header>
    <?php include('/templates/components/header/header.php');?>
</header>

<div id='content' class='container'>
    <div class='color-left col-md-2'>
        <?php include('/templates/moduls/left_menu/left_menu.php');?>
        <?php include('/templates/moduls/randomFilm/randomFilm.php');?>
    </div>
    <div class='content-div col-md-8'>
        <div class='col-xs-12'>
            <div class='background-div '>
                <div class='content-h'>Контакты</div>
                <div class='content-c'>
                    asldkjasldkjdfldfjlkajsdkf alsdkf asdfka sdflaksdfj a
                    asdlkjfa sdasdlfkjasdlf asdlfasdf aldfa sdflasdf asdfals a
                    asdf asdf asdflasdfka sdflasdfj asldfkasjdfl asdfkas dfalsdfk 
                    asdflka dfasdlfkajsdjflaskdf asdlfkasdlfaksdfas dflaskdf 
                    asdfl asdflasdkf asldfa sdflasdf asdflasdfkasl  asdlf asdf 
                    als fasld fasd fas df sdlf asdlf asdf asdlf asdf asdf asdf 
                    asdlfkasjdf lasdfklas dflaksdf alsdkf asldfk asdlfkasdjf
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-2'>
        <?php include('/templates/moduls/getCinema/getCinema.php');?>
        <p>Сделать рейтинг и выводить популярные фильмы.</p>
        <?php include('/templates/moduls/left_menu/left_menu.php');?>
    </div>
</div>

<!--Footer-->
<?php include('/templates/components/footer/footer.php');?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/Bootstrap/js/salvattore.min.js"></script>
<script src="/Bootstrap/js/bootstrap.js"></script>

</body>
</html>
