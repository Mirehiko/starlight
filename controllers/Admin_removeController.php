<?php
class Admin_removeController{

    #нужно еще удалить смежные записи с жанрами и сеансами
    public function actionFilm($id){
        $film = Film::getFilmById($id);
        $dir = rtrim(ROOT.$film['poster'],'/poster.jpg');
        /*if(Film::removeDirectory($dir)){

        }*/
        if(Film::removeFilm($id)){
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
        }
        return true;
    }
	#Удаление жанра, дописать удаление смежных записей
	public function actionGenre($id){
		
        if(Genre::removeGenre($id)){
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
            //echo "Жанр успешно удален!";
        }
        return true;
	}
    #Удаление года, дописать изменение смежных записей
    public function actionYear($id){
        
        if(Year::removeYear($id)){
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
            //echo "Запись успешно удалена!";
        }
        return true;
    }
	#Удаление сеанса
	public function actionSeanse($id){
		
        if(Seanse::removeSeanse($id)){
            echo "Сеанс успешно удален!";
        }
        return true;
	}
    #Удаление пользователя
    public function actionUser($id){
        //Удаление папки с файлами
        //Удаление из БД
        if(User::removeUser($id)){
            $sort  = $_POST['sort'];
            $arrow = $_POST['arrow'];

            $userList = User::getUserList($sort, $arrow);
            $freedoms = Freedom::getFreedomsList();
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
            //echo "Пользователь успешно удален!";
        }
        return true;
    }

}

?>