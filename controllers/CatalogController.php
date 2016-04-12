<?php
/*include_once ROOT . '/models/Year.php';
include_once ROOT . '/models/Genre.php';
include_once ROOT . '/models/Film.php';
include_once ROOT . '/models/RelationFG.php';
include_once ROOT . '/components/Pagination.php';*/

class CatalogController {
    //Показываем все фильмы
    public function actionIndex() {

        $userID = User::checkLogged();

        $user = User::getUserById($userID);

        $genres = array();
        $genres = Genre::getGenresList();

        $latestFilms = array();
        $latestFilms = Film::getLatestFilms(12);
        
        $randomFilm = Film::getRandomFilm();
        
        $relations = array();
        $relations = RelationFG::getRelationsList();

        $years = array();
        $years = Year::getYearsList();

        $genreId='null';
        $year='null';
        require_once(ROOT . '/views/catalog/index.php');

        return true;
    }
    //Показываем фильмы по жанру
    public function actionGenre($genreId, $page = 1) {

        $userID = User::checkLogged();

        $user = User::getUserById($userID);

        $genres = array();
        $genres = Genre::getGenresList();
        
        $years = array();
        $years = Year::getYearsList();


        $relations = array();
        $relations = RelationFG::getRelationsList();

        $total = Film::getTotalFilmsInGenre($genreId);
        $pagination =new Pagination($total, $page, Film::SHOW_BY_DEFAULT, 'page-');
        
        $randomFilm = Film::getRandomFilm();
        
        $genreFilms = array();
        $genreFilms = Film::getFilmsListByGenre($genreId, $page);
       
        $year='null';
        require_once(ROOT . '/views/catalog/genre.php');

        return true;
    }
    //Показываем фильмы по году
    public function actionYear($year, $page = 1) {

        $userID = User::checkLogged();

        $user = User::getUserById($userID);
        
        $randomFilm = Film::getRandomFilm();
        
        $genres = array();
        $genres = Genre::getGenresList();
        
        $years = array();
        $years = Year::getYearsList();

        $relations = array();
        $relations = RelationFG::getRelationsList();

        $total = Film::getTotalFilmsInYear($year);
        $pagination =new Pagination($total, $page, Film::SHOW_BY_DEFAULT, 'page-');

        $yearFilms = array();
        $yearFilms = Film::getFilmsListByYear($year, $page);
       
        $genreId='null';
        require_once(ROOT . '/views/catalog/year.php');

        return true;
    }

}
