<?php
/*include_once ROOT . '/models/Year.php';
include_once ROOT . '/models/Genre.php';
include_once ROOT . '/models/GetSomeGenres.php';
include_once ROOT . '/models/Film.php';
include_once ROOT . '/models/RelationFG.php';*/

class FilmController {
    //Показываем выбранный фильм
    public function actionView($filmId) {

        $userID = User::checkLogged();

        $user = User::getUserById($userID);

        $genres = array();
        $genres = Genre::getGenresList();

        $someGenres = array();
        $someGenres = GetSomeGenres::getSomeGenresList($filmId);

        $years = array();
        $years = Year::getYearsList();

        $relations = array();
        $relations = RelationFG::getRelationsList();
        
        $randomFilm = Film::getRandomFilm();
        
        $film = Film::getFilmById($filmId);
        $genreId='null';
        $year='null';
        require_once(ROOT . '/views/films/view.php');

        return true;
    }
    public function actionCreate(){

        $years = Year::getYearsList();
        $genres = Genre::getGenresList();

        $title =         $_POST['title'];
        $genresList =    $_POST['genresArr'];
        $producer =      $_POST['producer'];
        $year =          $_POST['year'];
        $f_long =        $_POST['f_long'];
        $content =       $_POST['content'];
        $short_content = substr($content, 0,98);


        $id_of_inserted_film = Film::createFilm($title,$producer,$f_long,$content,$short_content,$year);
        if($id_of_inserted_film){
            for($r=0;$r<count($genresList);$r++){
                RelationFG::createRow($id_of_inserted_film,$genres[$r]);
            }
            echo "Данные успешно добавлены!";
            //header("Location: /administrator/add/movie");
        }
        return true;
    }
    public function actionEdit($filmID){

        $film = Film::getFilmById($filmID);
        $relationsfg = RelationFG::getFilmRelations($filmID);
        
        $years = Year::getYearsList();
        $genres = Genre::getGenresList();

        $poster = $film['poster'];
        
        require_once(ROOT . '/views/administrator/edit/film.php');

        return true;
    }


}
