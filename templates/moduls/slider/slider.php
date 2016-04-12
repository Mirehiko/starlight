	<div id='slider-box' class='container hidden-xs'>
		<h4 id='news_title'>НОВОЕ <b>ЗА НЕДЕЛЮ</b></h4>
		<div class='row col-md-12' id='con-slides'>
		<div class="viewport">
		    <ul class="slidewrapper" data-current="0">
		    	<?php $i=1; ?>
		        <?php foreach ($latestFilms as $filmItem):?>
		        	<?php 
		    			echo "
					        <li class='slide slide-".$i."'>
					            <div class='slider-item'>
					            	<a href='/films/".$filmItem['id']."'>
					            		<img class='img ' height='222' width='166' src='".$filmItem['poster']."' alt=''>
					            	</a>
					            	<a href='/films/".$filmItem['id']."' class='a_title'>
					            		<acronym title='".$filmItem['title']."'>".$filmItem['title']."</acronym>
					            	</a>
					            </div>
					        </li>
		    			";
		    			$i++;
		        	?>
		            
		        <?php endforeach?>
		    </ul>
	    <a href="javascript: void(0)" id="prev_slide" class="arrows"><span class='glyphicon glyphicon-chevron-left'></span></a>
	    <a href="javascript: void(0)" id="next_slide" class="arrows"><span class='glyphicon glyphicon-chevron-right'></span></a>
		</div>
		</div>
	</div>