<?php

class UserController {

    public function actionRegister(){
        $genres = array();
        $genres = Genre::getGenresList();

        $years = array();
        $years = Year::getYearsList();

        $genreId='null';
        $year='null';

        $name='';
        $email='';
        $password='';
        $repassword='';
        
        $randomFilm = Film::getRandomFilm();

        require_once(ROOT."/views/user/register.php");

        return true;
    }
    //Вход пользователя на сайт
    public function actionLogin(){
        
        $randomFilm = Film::getRandomFilm();
        
        $name='';
        $password='';

        $error_log_or_pass="";
        $error_pass="";


        if(isset($_POST['submit'])){
            $name = $_POST['login'];
            $password = $_POST['password'];

            $error_pass = User::checkPassword($password);
            $userID = User::checkUserData($name,$password);


            if($userID==false){
                #Если данные неправильные
                $error_log_or_pass="Неверное имя пользователя или пароль!";
            }else{
                #Запоминаем пользователя
                User::auth($userID);
                header("Location: /user/$userID");
            }
        }
        require_once(ROOT . '/views/user/login.php');
    }
    //Выход пользователя с сайта
    public function actionLogout(){
        unset($_SESSION['user']);
        header("Location: /");
    }

}