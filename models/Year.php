<?php

class Year{
    //Получение списка годов
    public static function getYearsList($sort = 'year', $arrow = 'DESC'){

        $db = Db::getConnection();

        $yearList = array();
        $sql ="SELECT * FROM years ORDER BY $sort $arrow";

        $result = $db->query($sql);
                //. 'ORDER BY sort_order ASC');

        $i = 0;
        while ($row = $result->fetch()) {
            $yearList[$i]['id'] = $row['id'];
            $yearList[$i]['year'] = $row['year'];
            $i++;
        }

        return $yearList;
    }
    //Получение года по id
    public static function getYearById($id){
        if($id){
            $db = Db::getConnection();
            $sql = "SELECT * FROM years WHERE id=:id";

            $result = $db->prepare($sql);
            $result->bindParam(':id',$id,PDO::PARAM_INT);

            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();
        }
    }
    //Создание года
    public static function createYear($year){
        $db = Db::getConnection();

        $sql = "INSERT into years (year) VALUES(:year)";

        $result = $db->prepare($sql);
        $result->bindParam(':year', $year, PDO::PARAM_INT);

        return $result->execute();
    }
    //Удаление года
    public static function removeYear($id){
        if ($id) {                        
            $db = Db::getConnection();
            $sql = "DELETE FROM years WHERE id=:id";

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            
            return $result->execute();
        }
    }

}