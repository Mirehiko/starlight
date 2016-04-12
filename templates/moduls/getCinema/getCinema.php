<div class='cinemaFilm'>
    <div><p class='block-title'>Сегодня в кинотеатре</p></div>
    <?php 
    	for($i=0;$i<5;$i++){

    		echo "
		    <div class='cinemaFilmItem'>
			    <div><a class='c-f-tiltle' href='/films/".$randomFilm['id']."'>".$randomFilm['title']."</a></div>
		    </div>
    		";
    	}
    ?>
</div>