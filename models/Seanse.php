<?php

class Seanse {

    public static function getSeansesList(){

        $db = Db::getConnection();

        $seansesList = array();
        $sql = "SELECT * FROM seanses ORDER BY b_time ASC";
        $result = $db->query('SELECT * FROM seanses ORDER BY b_time ASC');
                //. 'ORDER BY sort_order ASC');
        if($result){
            $i = 0;
            while ($row = $result->fetch()) {
                $seansesList[$i]['id'] = $row['id'];
                $seansesList[$i]['s_date'] = $row['s_date'];
                $seansesList[$i]['b_time'] = $row['b_time'];
                $seansesList[$i]['s_film'] = $row['s_film'];
                $seansesList[$i]['s_hall'] = $row['s_hall'];
                $seansesList[$i]['e_time'] = $row['e_time'];
                $i++;
            }
            return $seansesList;
        }else{
            return "В базе нет записей";
        }
        
    }
    public static function getSeansesListByDateAndHall($s_date, $s_hall){

        /*$page = intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        $lim=self::SHOW_BY_DEFAULT;*/

        $db = Db::getConnection();
        $seansesList = array();

        $zapros = "SELECT * FROM seanses WHERE s_date='$s_date' AND s_hall=$s_hall ORDER BY b_time ASC";
        $result = $db->query($zapros);


        if($result){
            $i = 0;
            while ($row = $result->fetch()) {
                $seansesList[$i]['id'] = $row['id'];
                $seansesList[$i]['s_date'] = $row['s_date'];
                $seansesList[$i]['b_time'] = $row['b_time'];
                $seansesList[$i]['s_film'] = $row['s_film'];
                $seansesList[$i]['s_hall'] = $row['s_hall'];
                $seansesList[$i]['e_time'] = $row['e_time'];
                $i++;
            }
            return $seansesList;
        }else{
            return "В базе нет записей";
        }
        
    }
    public static function getSeansesListByDateAndTime($s_date, $b_time){

        /*$page = intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        $lim=self::SHOW_BY_DEFAULT;*/

        $db = Db::getConnection();
        $seansesList = array();

        $zapros = "SELECT * FROM seanses WHERE s_date='$s_date' AND b_time>$b_time ORDER BY b_time ASC";
        $result = $db->query($zapros);


        if($result){
            $i = 0;
            while ($row = $result->fetch()) {
                $seansesList[$i]['id'] = $row['id'];
                $seansesList[$i]['s_date'] = $row['s_date'];
                $seansesList[$i]['b_time'] = $row['b_time'];
                $seansesList[$i]['s_film'] = $row['s_film'];
                $seansesList[$i]['s_hall'] = $row['s_hall'];
                $seansesList[$i]['e_time'] = $row['e_time'];
                $i++;
            }
            return $seansesList;
        }else{
            return "В базе нет записей";
        }
        
    }

    #Добавление сеанса в базу
    public static function createSeanse($s_date, $b_time, $e_time, $s_film, $s_hall){ 
           
        $db = Db::getConnection();
        $sql = "INSERT into seanses
                (s_date, b_time, e_time, s_film, s_hall)
                VALUES (:s_date, :b_time, :e_time, :s_film, :s_hall)";

        $result = $db->prepare($sql);
        $result->bindParam(':s_date', $s_date, PDO::PARAM_STR);
        $result->bindParam(':b_time', $b_time, PDO::PARAM_STR);
        $result->bindParam(':e_time', $e_time, PDO::PARAM_STR);
        $result->bindParam(':s_film', $s_film, PDO::PARAM_INT);
        $result->bindParam(':s_hall', $s_hall, PDO::PARAM_INT);
        if($result->execute()){
            #Возвращаем id только что добавленного фильма
            return $db->lastInsertId();
        }
    }
}