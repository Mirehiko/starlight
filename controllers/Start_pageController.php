<?php
/*include_once ROOT . '/models/Year.php';
include_once ROOT . '/models/Genre.php';
include_once ROOT . '/models/Film.php';*/

class Start_pageController
{
    //Главная страница
    public function actionIndex(){

        $userID = User::checkLogged();

        $user = User::getUserById($userID);
        
        $genres = array();
        $genres = Genre::getGenresList();

        $years = array();
        $years = Year::getYearsList();

        $latestFilms = array();
        $latestFilms = Film::getLatestFilms(12);
        
        $randomFilm = Film::getRandomFilm();

        $genreId='null';
        $year='null';
        require_once(ROOT . '/views/start_page/index.php');

        return true;
    }
    //страница о нас
    public function actionAbout(){

        $userID = User::checkLogged();

        $user = User::getUserById($userID);
        
        $genres = array();
        $genres = Genre::getGenresList();

        $years = array();
        $years = Year::getYearsList();

        $latestFilms = array();
        $latestFilms = Film::getLatestFilms(12);
        
        $randomFilm = Film::getRandomFilm();

        $genreId='null';
        $year='null';
        require_once(ROOT . '/views/about_us.php');

        return true;
    }
    //Страница контакты
    public function actionContacts(){

        $userID = User::checkLogged();

        $user = User::getUserById($userID);
        
        $genres = array();
        $genres = Genre::getGenresList();

        $years = array();
        $years = Year::getYearsList();

        $latestFilms = array();
        $latestFilms = Film::getLatestFilms(12);
        
        $randomFilm = Film::getRandomFilm();

        $genreId='null';
        $year='null';
        require_once(ROOT . '/views/contacts.php');

        return true;
    }

}
