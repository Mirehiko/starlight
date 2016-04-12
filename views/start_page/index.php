<!DOCTYPE html>
<html lang="ru">
<head>
<title>Starlight Online</title>
    <?php include('/templates/css/all_styles.php');?>

    <link href="/templates/moduls/slider/slider.css" rel="stylesheet">
    <script src="/templates/moduls/slider/slider.js"></script>


    <style type="text/css">
    /**/

    </style>
    <script type="text/javascript">

    </script>
</head>
<body>
<!--Шапка-->
<header>
    <?php include('/templates/components/header/header.php');?>
</header>

<?php include('/templates/moduls/slider/slider.php');?>

<div id='content' class='container'>
    <div class='color-left col-md-2'>
        <?php include('/templates/moduls/left_menu/left_menu.php');?>
        <?php include('/templates/moduls/randomFilm/randomFilm.php');?>
    </div>
    <div class='color-right col-md-8'>
        <?php foreach ($latestFilms as $filmItem):?>
            <div class='col-xs-12 col-sm-6 col-md-6'>
                <div class='film_content'>
                    <a href="/films/<?php echo $filmItem['id']; ?>">
                    <div class=''>
                        <?php if($filmItem['is_new']==0){echo "<img class='label-new' src='/images/new.png' alt=''>";}?>
                        <?php if($filmItem['is_series']==0){echo "<img class='label-type' src='/images/movie.png' alt=''>";}?>
                    </div>
                    <div>
                        <img class='previewImage' src="<?php echo $filmItem['poster']; ?>" alt="">
                    </div>
                        
                    </a>
                    <div class='film_title'>
                        <a href="/films/<?php echo $filmItem['id']; ?>">
                            <acronym title="<?php echo $filmItem['title']; ?>"><?php echo $filmItem['title']; ?></acronym>
                        </a>
                    </div>
                    <div class='film_c'><p><?php echo $filmItem['short_content']; ?></p></div>
                    <a href="/films/<?php echo $filmItem['id']; ?>" class='btn btn-more'>Подробнее <i class='fa fa-arrow-right'></i></a>
                </div>
            </div>
        <?php endforeach?>
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
