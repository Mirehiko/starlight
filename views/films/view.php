<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?php echo $film['title']; ?> | Starlight Online</title>
    <?php include('/templates/css/all_styles.php');?>

    <style type="text/css">
        .view_film_title{
        	font-family: 'NeoSansCyr-Medium', sans-serif;
        	color: #3b5167;
        	text-align: left;
        	padding-left: 15px;
        }
        .big-img{
        	padding-left: 30px;
        	text-align: left;
        }
        .big-img > .previewImage{
            box-shadow: 0 0 4px 0 rgba(60, 53, 37, 0.44);
        	padding: 0;
        }
        .details{
        	text-align: left;
        	color: #34495e;
        	padding-left: 0;
        }
        .details > span, .details a{
        	color: #e84c3d;
        	padding-left: 5px;
        }
        .film_con{
        	padding-left: 30px;
        	padding-right: 30px;
        	padding-top: 15px;
        	text-align: left;
        	color: #34495e;
        }
        #film_content{
        	word-wrap: break-word;
        	font-family: 'NeoSansCyr-Regular', sans-serif;
        	margin: 0 0 15px;
        	border: none;
        	background-color: transparent;
        	padding: 0;
        }
        .video_file{
            text-align: center;
            margin-bottom: 15px;
            margin-top: -15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            var video_playing = false;
            $('#movie').click(function(){
                if(video_playing == false){
                    this.play();
                    video_playing = true;
                }
                else {
                    this.pause();
                    video_playing = false;
                }
            });

        });
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
    <div class='color-right col-md-8'>
        <div class='col-xs-12 col-sm-6 col-md-12'>
            <div class='film_content'>
                <div class='view_film_title'>
                	<h4><?php echo $film['title']; ?></h4>
                </div>
                <div class='row'>
	                <div class='col-md-5 big-img'>
	                	<img class='previewImage' src="<?php echo $film['poster']; ?>" alt="">
	                </div>
	                <div class='col-md-7 details'>
	                	<b>Год:</b><span>
                            <?php foreach ($years as $yearItem):?>
                            <?php 
                                if($film['year']==$yearItem['id']){
                                    echo "<a href='/year/".$yearItem['id']."'>".$yearItem['year']."</a>";
                                } 
                            ?>
                            <?php endforeach?>
                        </span><br>
                        <b>Жанр:</b>
                        <?php foreach ($someGenres as $genreItem):?>
                        <?php
                            echo "<a href='/genre/".$genreItem['id']."'>".$genreItem['name']."</a>";
                        ?>
                        <?php endforeach?>
                        <br>
	                	<b>Продолжительность:</b><span><?php echo $film['f_long'] ?></span><br>
	                	<b>Режиссер:</b><span><a href='#'><?php echo $film['producer'] ?></a></span><br>
	                </div>
                </div>
                <div class='film_con row'>
                	<b>Описание:</b>
                	<pre id='film_content'><?php echo $film['content']; ?></pre>
                    <div class='video_file'>
                        <video id='movie' width="400" height="300" controls="controls" poster="/images/">
                           <source src="video/duel.ogv" type='video/ogg; codecs="theora, vorbis"'>
                           <source src="/images/films_data/16/[AniDub]_Sword_Art_Online _II_[01]_[720p_x264_Aac]_[JAM_NikaLenina].mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
                           <source src="video/duel.webm" type='video/webm; codecs="vp8, vorbis"'>
                           Тег video не поддерживается вашим браузером. 
                           <a href="/images/films_data/16/[AniDub]_Sword_Art_Online _II_[01]_[720p_x264_Aac]_[JAM_NikaLenina].mp4">Скачайте видео</a>.
                        </video> 
                    </div>

                </div>
            </div>
        </div>
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

