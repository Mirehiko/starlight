<?php

class AdministratorController{
	#Главная страница администратора
	public function actionIndex(){

        require_once(ROOT . '/views/administrator/index.php');

        return true;
	}

##Работа с фильмами: 
	#Отображение списка фильмов
	public function actionFilms(){
		if(isset($_POST['sort'])){
			$sort  = $_POST['sort'];
			$arrow = $_POST['arrow'];
			$filmList = Film::getFilmList($sort, $arrow);
            foreach ($filmList as $filmItem){
            	echo "
	        	<tr class='sort'>
	        		<td>
						<div class='mycheckbox'>
							<label>
								<input type='checkbox' class='check' value='".$filmItem['id']."'>
							</label>
						</div>
	        		</td>
	                <td>
	                <div class='btn-toolbar'>
                    <div class='btn-group'>";
                    if($filmItem['status'] == 1){
                    	echo "
                        <button link='/administrator/change/film_status/".$filmItem['id']."' class='btn state-link state-link_print' state='print' data-toggle='dropdown' title='Публикуется'>
                            <span class='state-link__state-icon'><i class='fa fa-check-square-o'></i></span>
                        </button>
                        ";
                    }else{
                    	echo "
                        <button link='/administrator/change/film_status/".$filmItem['id']."' class='btn state-link state-link_keep' state='keep' data-toggle='dropdown' title='Не публикуется'>
                            <span class='state-link__state-icon'><i class='fa fa-square-o'></i></span>
                        </button>
                        ";
                    }echo "
                        <a href='/administrator/edit/film/".$filmItem['id']."' class='btn edit' title='Редактировать'>
                            <span class=''><i class='fa fa-pencil-square-o'></i></span>
                        </a>
                    </div>
                    </div>
	                </td>
	        		<td><a href='/administrator/edit/film/".$filmItem['id']."'>".$filmItem['title']."</a></td>
	        		<td><a href='#' data-toggle='dropdown'>".$filmItem['producer']."</a></td>";
                    if($filmItem['is_series']==1){
                        if($filmItem['is_anime']==1)
                            echo "<td><a href='#'' data-toggle='dropdown'>Аниме сериал</a></td>";
                        else
                            echo "<td><a href='#'' data-toggle='dropdown'>Сериал</a></td>";
                    }else{
                        if($filmItem['is_anime']==1)
                            echo "<td><a href='#'' data-toggle='dropdown'>Аниме фильм</a></td>";
                        else
                            echo "<td><a href='#'' data-toggle='dropdown'>Фильм</a></td>";
                    }
	                //<td><a href='/administrator/films/remove/".$filmItem['id']."' data-toggle='dropdown'>Удалить</a></td>
	        	echo "
	                <td class='remove-column'>
	                    <a href='#' data-toggle='dropdown' class='remove-record'><i class='fa fa-trash'></i></a>
	                </td>
	        	</tr>
            	";
            }
		}else{
			$filmList = Film::getFilmList();
	        require_once(ROOT . '/views/administrator/films.php');
		}


        return true;
	}
	#Переход на страницу добавления фильмов
	public function actionCreatefilm(){

        $years = Year::getYearsList();
        $genres = Genre::getGenresList();

        //$genArray = array();

        require_once(ROOT . '/views/administrator/add/film.php');

        return true;
	}
	#Переход на страницу редактирования фильмов
	public function actionEditfilm($filmID){
        
        $years = Year::getYearsList();
        $genres = Genre::getGenresList();

        $relationsfg = RelationFG::getFilmRelations($filmID);

		$film = Film::getFilmById($filmID);
		$poster = $film['poster'];

        require_once(ROOT . '/views/administrator/edit/film.php');

        return true;
	}
##Работа с жанрами: 
	#Отображение списка жанров
	public function actionGenres(){
		if(isset($_POST['sort'])){
			$sort  = $_POST['sort'];
			$arrow = $_POST['arrow'];

			$genreList = Genre::getGenresList($sort, $arrow);
            foreach ($genreList as $genreItem){
                echo "
				<tr class='sort'>
                    <td class='l_column'>
                        <div class='mycheckbox'>
                            <label>
                                <input type='checkbox' class='check' value='".$genreItem['id']."'>
                            </label>
                        </div>
                    </td>
                    <td class=''>
                        <a href='/administrator/edit/Genre/".$genreItem['id']."'>".$genreItem['name']."</a>
                    </td>
                    <td><p class='content'>".$genreItem['content']."</p></td>
                    <td class='remove-column'>
                        <a href='#' link='/administrator/remove/Genre/".$genreItem['id']."' data-toggle='dropdown' class='remove-record'><i class='fa fa-trash'></i></a>
                    </td>
                </tr>
                ";
            }
		}else{
			$genreList = Genre::getGenresList();
	        require_once(ROOT . '/views/administrator/genres.php');
		}
        return true;
	}
	#Переход на страницу добавления жанров
	public function actionCreategenre(){
		
        require_once(ROOT . '/views/administrator/add/genre.php');

        return true;
	}
	#Переход на страницу редактирования жанров
	public function actionEditgenre($id){
		
		$genre = Genre::getGenreById($id);

        require_once(ROOT . '/views/administrator/edit/genre.php');

        return true;
	}
##Работа с годами: Функциональность - Complete!, Наведение красоты - В процессе   
	#Отображение списка годов
	public function actionYears(){

		if(isset($_POST['sort'])){
			$sort  = $_POST['sort'];
			$arrow = $_POST['arrow'];

			$yearList = Year::getYearsList($sort, $arrow);

            foreach ($yearList as $yearItem){
            	echo "
                <tr class='sort'>
                    <td class='l_column'>
                        <div class='mycheckbox'>
                            <label>
                                <input type='checkbox' class='check' value='".$yearItem['id']."'>
                            </label>
                        </div>
                    </td>
                    <td class=''>
                        <a href='#' data-toggle='dropdown'>".$yearItem['year']."</a>
                    </td>
                    <td class='remove-column'>
                        <a href='#' link='/administrator/remove/Year/".$yearItem['id']."' data-toggle='dropdown' class='remove-record'><i class='fa fa-trash'></i></a>
                    </td>
                </tr>
            	";
            }
		}else{
			$yearList = Year::getYearsList();
	        require_once(ROOT . '/views/administrator/years.php');
		}

        return true;
	}
	#Переход на страницу добавления годов
	public function actionCreateyear(){
		
        require_once(ROOT . '/views/administrator/add/year.php');

        return true;
	}
##Работа с сеансами: 
	#Отображение списка сеансов
	public function actionSeanses(){

		$seanseList = Seanse::getSeansesList();

        require_once(ROOT . '/views/administrator/seanses.php');

        return true;
	}
	#Переход на страницу добавления сеансов
	public function actionCreateseanse(){
		$halls = Hall::getHallList();

		if(isset($_POST['s_date'])){
	        $s_date = $_POST['s_date'];
	        $s_hall = $_POST['s_hall'];
	        $seanses = Seanse::getSeansesListByDateAndHall($s_date, $s_hall);
	        if($seanses!="В базе нет записей"){
	        	echo "<nav id='' class='text-center'>";

	        	$hour=8; $min='00';
	        	$was_time=false;
	        	$i=0;
				while($hour<22){
					$time = "";
					if($hour<10){
						$time = "0".$hour.":".$min;
					}else{
						$time = $hour.":".$min;
					}

			        foreach($seanses as $sItem){
			        	if($sItem['b_time']<=$time && $time<=$sItem['e_time']){
			        		$was_time=true;
				        	if($hour<10){
				        		echo "<a class='process' href='#' data-toggle='dropdown'>0$hour:$min</a>";
				        	}else{
				        		echo "<a class='process' href='#' data-toggle='dropdown'>$hour:$min</a>";
				        	}
			        	}
			        }
			        if($was_time == false){
			        	if($hour<10){
			        		echo "<a class='free' href='#' data-toggle='dropdown'>0$hour:$min</a>";
			        	}else{
			        		echo "<a class='free' href='#' data-toggle='dropdown'>$hour:$min</a>";
			        	}
			        }else{
			        	$was_time=false;
			        }
			        if($hour.':'.$min=='14:30'){echo '<br>';}
					if($min=='00'){
						$min='30';
					}else{
						$min='00';
					}
					if($i==1){
						$hour++;
						$i=0;
					}else{
						$i++;
					}
				}
		        echo "</nav>";
	        }
		}else{
			require_once(ROOT . '/views/administrator/add/seanse.php');
		}
		
        
        return true;
	}
	#Переход на страницу редактирования сеансов
	public function actionEditseanse($id){
		
		$seanse = Seanse::getSeanseById($id);

        require_once(ROOT . '/views/administrator/edit/seanse.php');

        return true;
	}
##Работа с пользователями: 
	#Отображение спика пользователей
	public function actionUsers(){

		$freedoms = Freedom::getFreedomsList();

		if(isset($_POST['sort'])){
			$sort  = $_POST['sort'];
			$arrow = $_POST['arrow'];

			$userList = User::getUserList($sort, $arrow);
			foreach ($userList as $userItem){
				echo "
                <tr class='sort'>
                    <td>
                        <div class='mycheckbox'>
                            <label>
                                <input type='checkbox' class='check' value='".$userItem['id']."'>
                            </label>
                        </div>
                    </td>
                    <td>
                        <a href='/administrator/edit/user/".$userItem['id']."'>
                        	".$userItem['username']."
                        </a>
                    </td>
                    <td><a href='#' data-toggle='dropdown'>";
                        foreach ($freedoms as $freeItem){
                            if($freeItem['id'] == $userItem['freedom']){
                                echo $freeItem['name'];
                            }
                        }
                    echo "</a></td>
                    <td><a href='#' data-toggle='dropdown'>".$userItem['email']."</a></td>
                    <td><a href='#' data-toggle='dropdown'>".$userItem['password']."</a></td>
                    <td class='remove-column'>
                        <a href='#' link='/administrator/remove/user/".$userItem['id']."' data-toggle='dropdown' class='remove-record'><i class='fa fa-trash'></i></a>
                    </td>
                </tr>
				";
			}

		}else{
			$userList = User::getUserList();

	        require_once(ROOT . '/views/administrator/users.php');
		}

        return true;
	}
	#Переход на страницу добавления пользователей
	public function actionCreateuser(){
		
		$freedoms = Freedom::getFreedomsList();

        require_once(ROOT . '/views/administrator/add/user.php');

        return true;
	}
	#Переход на страницу редактирования пользователей
	public function actionEdituser($userID){

		$freedoms = Freedom::getFreedomsList();
		$user = User::getUserById($userID);
		$avatar = $user['avatar'];
        require_once(ROOT . '/views/administrator/edit/user.php');

        return true;
	}

##Работа с добавлением/удалением жанров
	#Добавление жанра к фильму
	public function actionAddgenre(){
		if(isset($_POST['filmID']) && isset($_POST['genreID'])){
			RelationFG::createRow($_POST['filmID'],$_POST['genreID']);
			echo "Данные успешно добавлены!";
		}
	}
	#Удаление жанра у фильма
	public function actionRemovegenre(){
			echo $_POST['filmID'];
			echo $_POST['genreID'];
		if(isset($_POST['filmID']) && isset($_POST['genreID'])){

			RelationFG::removeRow($_POST['filmID'],$_POST['genreID']);
			echo "Данные успешно удалены!";
		}
	}
##
	
}

?>