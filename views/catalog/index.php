<!DOCTYPE html>
<html lang="ru">
<head>
<title>Каталог | Starlight Online</title>
    <?php include('/templates/css/all_styles.php');?>

    <style type="text/css">

        .label-new{
            height: 100px;
            margin-left: 30px;
            opacity: 0.8;
            position: absolute;
        }
        .label-type{
            height: 80px;
            position: absolute;
            opacity: 0.8;
            top: 265px;
            left: 30px;
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
    <div class='color-right col-md-10'>
        <?php foreach ($latestFilms as $filmItem):?>
            <div class='col-xs-12 col-sm-6 col-md-4'>
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
</div>

<!--Footer-->
<?php include('/templates/components/footer/footer.php');?>


<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/Bootstrap/js/salvattore.min.js"></script>
<script src="/Bootstrap/js/bootstrap.js"></script>

</body>
</html>
