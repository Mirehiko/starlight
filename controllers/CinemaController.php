<?php

class CinemaController {
    //Главная страница
    public function actionIndex(){

        $userID = User::checkLogged();
        $user = User::getUserById($userID);
        
        //Список Жанров
        $genres = array();
        $genres = Genre::getGenresList();

        //Список дней(7 дней вперед)
        /*$days = array();
        $days = Day::getDaysList();*/

        //Список ближайших сеансов
        //$seasesList = Seanse::getSoonSeansesList();
 
 		//Случайный сеанс на сегодня(минимум 30мин до него)
        //$randomSeanse = Seanse::getRandomSeanse();

        $genreId='null';
        $day='today';
        require_once(ROOT . '/views/cinema/index.php');

        return true;
    }
    //страница о нас
    public function actionAbout(){

        $userID = User::checkLogged();
        $user = User::getUserById($userID);
        
        //Список Жанров
        /*$genres = array();
        $genres = Genre::getGenresList();*/

        //Список дней(7 дней вперед)
        $days = array();
        $days = Day::getDaysList();

        //Список ближайших сеансов
        $seasesList = Seanse::getSoonSeansesList();
 
 		//Случайный сеанс на сегодня(минимум 30мин до него)
        $randomSeanse = Seanse::getRandomSeanse();

        $genreId='null';
        $day='today';
        require_once(ROOT . '/views/cinema/about_us.php');

        return true;
    }
    //Страница контакты
    public function actionContacts(){

        $userID = User::checkLogged();
        $user = User::getUserById($userID);
        
        //Список Жанров
        $genres = array();
        $genres = Genre::getGenresList();

        //Список дней(7 дней вперед)
        /*$days = array();
        $days = Day::getDaysList();*/

        //Список ближайших сеансов
        $seasesList = Seanse::getSoonSeansesList();
 
 		//Случайный сеанс на сегодня(минимум 30мин до него)
        $randomSeanse = Seanse::getRandomSeanse();

        $genreId='null';
        $day='today';
        require_once(ROOT . '/views/cinema/contacts.php');

        return true;
    }
}