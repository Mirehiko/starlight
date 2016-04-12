<?php
	if(isset($_POST['queryString'])){
		$connect=mysql_connect('localhost','root','') or die(mysql_error());
		mysql_select_db('movie_house',$connect);
		mysql_query('set names utf8');

		//$str=iconv('из какой','в какую',$_POST['queryString']);//преобразование кодировки
		$string=$_POST['queryString'];

		$query=mysql_query("select * from films where title LIKE '%".$string."%';") or die(mysql_error());
		if(mysql_num_rows($query)>0){
			echo "<ul class='nav'>";
			$i=0;
			while ($data=mysql_fetch_array($query)) {
				echo "<li><a class='get_f_id' f_id='".$data['id']."' f_long='".$data['f_long']."' data-toggle='dropdown' href='#'>".$data['title']."</a></li>";// 
				$i++;
			}
			echo "</ul>";
		}
	}
?>