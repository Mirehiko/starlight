<?php

class Film {

    const SHOW_BY_DEFAULT = 12;
    #Выборка последних (12) фильмов
    public static function getLatestFilms($count = self::SHOW_BY_DEFAULT){
        $count = intval($count);
        $db = Db::getConnection();
        $filmList = array();

        $result = $db->query('SELECT id, title, poster, short_content, is_new, is_series FROM films '
                . 'WHERE status = "1"'
                . 'ORDER BY id DESC '                
                . 'LIMIT ' . $count);

        $i = 0;
        while ($row = $result->fetch()) {
            $filmList[$i]['id'] = $row['id'];
            $filmList[$i]['title'] = $row['title'];
            $filmList[$i]['short_content'] = $row['short_content'];
            $filmList[$i]['is_series'] = $row['is_series'];
            $filmList[$i]['poster'] = $row['poster'];
            $filmList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $filmList;
    }
    #Получение списка фильмов
    public static function getFilmList($sort = 'id', $arrow = 'ASC'){

        /*$page = intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        $lim=self::SHOW_BY_DEFAULT;*/

        $db = Db::getConnection();            
        $films = array();
        //$zapros="SELECT * FROM films ORDER BY id ASC LIMIT $lim OFFSET $offset";
        $zapros="SELECT * FROM films ORDER BY $sort $arrow";
        $result = $db->query($zapros);

        $i = 0;
        while ($row = $result->fetch()) {
            $films[$i]['id'] = $row['id'];
            $films[$i]['title'] = $row['title'];
            $films[$i]['short_content'] = $row['short_content'];
            $films[$i]['poster'] = $row['poster'];
            $films[$i]['producer'] = $row['producer'];
            $films[$i]['is_new'] = $row['is_new'];
            $films[$i]['status'] = $row['status'];
            $films[$i]['is_series'] = $row['is_series'];
            $films[$i]['is_anime'] = $row['is_anime'];
            $i++;
        }

        return $films;       
    }
    #Выборка фильмов по жанру
    public static function getFilmsListByGenre($genreId = false, $page = 1){
        if ($genreId) {

            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
            $lim=self::SHOW_BY_DEFAULT;

            $db = Db::getConnection();            
            $films = array();
            $zapros="SELECT id, title, short_content, poster, is_new FROM films 
                    WHERE status = '1' AND id = ANY(SELECT id_film FROM relationfg WHERE id_genre = '$genreId') 
                    ORDER BY id ASC 
                    LIMIT $lim OFFSET $offset";
            $result = $db->query($zapros);

            $i = 0;
            while ($row = $result->fetch()) {
                $films[$i]['id'] = $row['id'];
                $films[$i]['title'] = $row['title'];
                $films[$i]['short_content'] = $row['short_content'];
                $films[$i]['poster'] = $row['poster'];
                $films[$i]['is_new'] = $row['is_new'];
                $i++;
            }

            return $films;       
        }
    }
    #Выборка фильмов по году
    public static function getFilmsListByYear($year = false, $page = 1){
        if ($year) {

            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
            $lim=self::SHOW_BY_DEFAULT;

            $db = Db::getConnection();            
            $films = array();
            $zapros = "SELECT id, title, short_content, poster, is_new FROM films 
                       WHERE status = '1' AND year = '$year' 
                       ORDER BY id DESC 
                       LIMIT $lim OFFSET $offset";
            $result = $db->query($zapros);

            $i = 0;
            while ($row = $result->fetch()) {
                $films[$i]['id'] = $row['id'];
                $films[$i]['title'] = $row['title'];
                $films[$i]['short_content'] = $row['short_content'];
                $films[$i]['poster'] = $row['poster'];
                $films[$i]['is_new'] = $row['is_new'];
                $i++;
            }
            
            return $films;       
        }
    }
    #Выбор фильма по Id
    public static function getFilmById($id){
        $id = intval($id);

        if ($id) {                        
            $db = Db::getConnection();
            
            $result = $db->query('SELECT * FROM films WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }
    }
    #Подсчет фильмов в указанном жанре
    public static function getTotalFilmsInGenre($genreId){
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = "SELECT count(id) AS count FROM films WHERE status='1' AND id = ANY(SELECT id_film FROM relationfg WHERE id_genre=:genreid)";//:genreId
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':genreid', $genreId, PDO::PARAM_INT);//:genreId
        // Выполнение коменды
        $result->execute();
        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }
    #Подсчет фильмов в указанном году
    public static function getTotalFilmsInYear($yearId){
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = "SELECT count(id) AS count FROM films WHERE status='1' AND year=:yearid)";//:genreId
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':yearid', $yearId, PDO::PARAM_INT);//:genreId
        // Выполнение коменды
        $result->execute();
        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }
    #Получение случайного фильма
    public static function getRandomFilm(){
        //$id = intval($id);
        $db = Db::getConnection();
        $get=true;
        //$sql = "SELECT COUNT(*) AS count FROM films WHERE status='1'";
        $sql = "SELECT id AS count FROM films WHERE status='1' ORDER BY id DESC LIMIT 1";
        while($get){
            $result = $db->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $row = $result->fetch();
            $total = $row['count'];

            $id = rand(1,$total);
            $check = "SELECT * FROM films WHERE status='1' AND id=$id";
            $res = $db->query($check);
            $res->setFetchMode(PDO::FETCH_ASSOC);
            $r = $res->fetch();
            
            if($r){
                $get = false;
            }
        }
        if ($id) {                        
            $result = $db->query('SELECT * FROM films WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }
    }

    #Список рекомендуемых фильмов
    public static function getRecommendedFilms(){
        $db = Db::getConnection();

        $filmsList = array();

        $result = $db->query('SELECT id, title, short_content, poster, is_new FROM films '
                . 'WHERE status = "1" AND is_recommended = "1"'
                . 'ORDER BY id DESC ');

        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['title'] = $row['title'];
            $productsList[$i]['poster'] = $row['poster'];
            $productsList[$i]['short_content'] = $row['short_content'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $filmsList;
    }


    #Добавление фильма в базу
    public static function createFilm($title,$producer,$f_long,$content,$short_content,$year, $poster, $is_series, $is_anime){ 
           
        $db = Db::getConnection();
        $sql = "INSERT into films
                (title, short_content, content, producer, f_long, year, poster, is_series, is_anime)
                VALUES (:title, :short_content, :content, :producer, :f_long, :year, :poster, :is_series, :is_anime)";

        $result = $db->prepare($sql);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':short_content', $short_content, PDO::PARAM_STR);
        $result->bindParam(':content', $content, PDO::PARAM_STR);
        $result->bindParam(':producer', $producer, PDO::PARAM_STR);
        $result->bindParam(':f_long', $f_long, PDO::PARAM_STR);
        $result->bindParam(':year', $year, PDO::PARAM_INT);
        $result->bindParam(':poster', $poster, PDO::PARAM_STR);
        $result->bindParam(':is_series', $is_series, PDO::PARAM_INT);
        $result->bindParam(':is_anime', $is_anime, PDO::PARAM_INT);
        if($result->execute()){
            #Возвращаем id только что добавленного фильма
            return $db->lastInsertId();
        }
    }
    #Обновление данных в выбранном фильме
    public static function updateFilm($id,$title,$producer,$f_long,$content,$short_content,$year, $poster, $is_series, $is_anime){
        if ($id) {    
                              
            $db = Db::getConnection();
            $sql = "UPDATE 
                        films 
                    SET 
                        title = :title, 
                        producer = :producer,
                        content = :content,
                        short_content = :short_content,
                        f_long = :f_long,
                        year = :year,
                        poster = :poster,
                        is_anime = :is_anime,
                        is_series = :is_series
                    WHERE id = :id";
            
            $result = $db->prepare($sql);

            $result->bindParam(':id', $id);
            $result->bindParam(':title', $title);
            $result->bindParam(':short_content', $short_content);
            $result->bindParam(':content', $content);
            $result->bindParam(':producer', $producer);
            $result->bindParam(':f_long', $f_long);
            $result->bindParam(':year', $year);
            $result->bindParam(':poster', $poster, PDO::PARAM_STR);
            $result->bindParam(':is_series', $is_series, PDO::PARAM_INT);
            $result->bindParam(':is_anime', $is_anime, PDO::PARAM_INT);

            return $result->execute();
        }
    }
    public static function changeStatus($id, $status){
        if ($id) {    
                              
            $db = Db::getConnection();
            $sql = "UPDATE 
                        films 
                    SET 
                        status = :status
                    WHERE id = :id";
            
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id);
            $result->bindParam(':status', $status);

            return $result->execute();
        }
    }
    #Удаление фильма
    public static function removeFilm($id){
        if ($id) {                        
            $db = Db::getConnection();
            $sql = "DELETE FROM films WHERE id=:id";

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            
            return $result->execute();
        }
    }
    #Удаление папки фильма
    public static function removeDirectory($dir) {
        /*if ($objs = glob($dir."/*")) {
            echo $objs;
            foreach($objs as $obj) {
                if(is_dir($obj)){
                    
                }else{
                    unlink($obj);
                }
            }
        }
        rmdir($dir);*/
    }
}
