<?php

class CabinetController{
    
    public function actionIndex(){

        $userID = User::checkLogged();

        $user = User::getUserById($userID);
        $avatar = $user['avatar'];
        $genres = array();
        $genres = Genre::getGenresList();

        $years = array();
        $years = Year::getYearsList();
        
        $randomFilm = Film::getRandomFilm();
        
        $genreId='null';
        $year='null';

        require_once(ROOT . '/views/user/index.php');

        return true;
    }
    public function actionEdit(){

        $userID = User::checkLogged();
        $user = User::getUserById($userID);
        
        $randomFilm = Film::getRandomFilm();
        
        $name = $user['username'];
        $email = $user['email'];
        $password = $user['password'];
        $avatar = $user['avatar'];

        $error_name = "";
        $error_email = "";
        $error_password = "";

        $genres = array();
        $genres = Genre::getGenresList();

        $years = array();
        $years = Year::getYearsList();

        $genreId='null';
        $year='null';
        
        if(isset($_POST['submit'])){

            $name = $_POST['login'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $avatar = $_POST['avatar'];

            $error_name = User::checkReName($userID, $name);
            $error_email = User::checkReEmail($userID, $email);
            $error_pass = User::checkPassword($password);

            
        }

        require_once(ROOT . '/views/user/edit.php');

        return true;
    }
}

?>