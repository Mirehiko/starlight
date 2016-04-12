<?php

class CheckData{

    #Проверка существования фильма
    public static function checkFilm($id = "", $title, $producer, $year, $f_long){
        if($id == ""){
            $db = Db::getConnection();
            $sql = "SELECT title FROM films WHERE title=:title AND producer=:producer AND year=:year AND f_long=:f_long";

            $result=$db->prepare($sql);
            $result->bindParam(':title',$title,PDO::PARAM_STR);
            $result->bindParam(':producer',$producer,PDO::PARAM_STR);
            $result->bindParam(':year',$year,PDO::PARAM_STR);
            $result->bindParam(':f_long',$f_long,PDO::PARAM_STR);
            $result->execute();
        }else {
            $db = Db::getConnection();
            $sql = "SELECT title FROM films WHERE title=:title AND producer=:producer AND year=:year AND f_long=:f_long AND id!= :id";

            $result=$db->prepare($sql);
            $result->bindParam(':title',$title,PDO::PARAM_STR);
            $result->bindParam(':producer',$producer,PDO::PARAM_STR);
            $result->bindParam(':year',$year,PDO::PARAM_STR);
            $result->bindParam(':f_long',$f_long,PDO::PARAM_STR);
            $result->bindParam(':id',$id,PDO::PARAM_INT);
            $result->execute();
        }


        return $result->fetchColumn();
    }
    #Проверка существования жанра
    public static function checkGenre($id = "", $name){
        if($id == ""){
            $sql = "SELECT name FROM genres WHERE name=:name";
        }else {
            $sql = "SELECT name FROM genres WHERE name=:name AND id!= :id";
        }
        $db = Db::getConnection();


        $result=$db->prepare($sql);
        $result->bindParam(':name',$name,PDO::PARAM_STR);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->execute();
        return $result->fetchColumn();
    }
    #Проверка существования года
    public static function checkYear($year){
        
        $db = Db::getConnection();
        $sql = "SELECT id FROM years WHERE year=:year";

        $result=$db->prepare($sql);
        $result->bindParam(':year',$year,PDO::PARAM_INT);
        $result->execute();

        return $result->fetchColumn();
    }
    #Проверка существования сеанса
    public static function checkSeanse($s_date, $s_time, /*$s_film,*/ $s_hall){

        $db   = Db::getConnection();
        //$film = Film::getFilmById($s_film);
        //$long = $film['f_long'];
        //выбрать фильмы которые входят в диапазон указанного времени + продолжительность фильма
        $sql  = "SELECT id FROM seanses WHERE s_date=:s_date AND s_hall=:s_hall AND s_time=:s_time ";

        $result=$db->prepare($sql);
        $result->bindParam(':s_date', $s_date, PDO::PARAM_STR);
        $result->bindParam(':s_time', $s_time, PDO::PARAM_STR);
        //$result->bindParam(':s_film', $s_film, PDO::PARAM_INT);
        $result->bindParam(':s_hall', $s_hall, PDO::PARAM_INT);

        $result->execute();
        return $result->fetchColumn();
    }
    #Проверка существования имени пользователя
    public static function checkName($name, $id = ""){
        
        $db = Db::getConnection();

        if($id == ""){
            $sql = "SELECT username FROM users WHERE username=:name";
            $result=$db->prepare($sql);
            $result->bindParam(':name',$name,PDO::PARAM_STR);
            $result->execute();
        }else {
            $sql = "SELECT username FROM users WHERE username = :name AND id != :id";
            $result = $db->prepare($sql);
            $result->bindParam(':name', $name, PDO::PARAM_STR);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->execute();
        }

        if($result->fetchColumn()){
            return "Имя занято!";
        }else if(strlen($name)<2){
            return "Слишком короткое имя!";
        }else {
            return "";
        }
    }
    #Проверка существования email 
    public static function checkEmail($email, $id = ""){
        if($email!=""){
            $db = Db::getConnection();
            if($id == ""){
                $sql = "SELECT email FROM users WHERE email=:email";
                $result=$db->prepare($sql);
                $result->bindParam(':email',$email,PDO::PARAM_STR);
                $result->execute();
            }else {
                $sql = "SELECT email FROM users WHERE email = :email AND id != :id";
                $result = $db->prepare($sql);
                $result->bindParam(':email', $email, PDO::PARAM_STR);
                $result->bindParam(':id', $id, PDO::PARAM_INT);
                $result->execute();
            }

            if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                if($result->fetchColumn()){
                    return "Этот email уже используется!";
                }else {
                    return "";
                }
            }else{
                return "Неправильный вид email";
            }
        }else{
            echo "Введите email!";
        }
    }
    #Проверка правильности пароля
    public static function checkPassword($password){
        if($password==""){
            return "Введите пароль!";
        }else if(strlen($password)<6){
            return "Пароль должен быть длиной не менее 6 символов!";
        }else {
            return "";
        }
    }
}