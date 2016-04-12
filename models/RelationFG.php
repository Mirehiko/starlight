<?php

class RelationFG {

    public static function getRelationsList(){

        $db = Db::getConnection();

        $relationsList = array();

        $result = $db->query('SELECT * FROM relationfg');
                //. 'ORDER BY sort_order ASC');

        $i = 0;
        while ($row = $result->fetch()) {
            $relationsList[$i]['id'] = $row['id'];
            $relationsList[$i]['id_genre'] = $row['id_genre'];
            $relationsList[$i]['id_film'] = $row['id_film'];
            $i++;
        }

        return $relationsList;
    }
    public static function getFilmRelations($id){
        $id = intval($id);

        $relationsList = array();
        
        if ($id) {                        
            $db = Db::getConnection();
            
            $result = $db->query('SELECT * FROM relationfg WHERE id_film=' . $id);
            $i = 0;
            while ($row = $result->fetch()) {
                $relationsList[$i]['id'] = $row['id'];
                $relationsList[$i]['id_genre'] = $row['id_genre'];
                $relationsList[$i]['id_film'] = $row['id_film'];
                $i++;
            }

            return $relationsList;
        }
    }
    public static function getRelationsByGenreId($id){
        $id = intval($id);

        if ($id) {                        
            $db = Db::getConnection();
            
            $result = $db->query('SELECT * FROM relationfg WHERE id_genre=' . $id);
            $i = 0;
            while ($row = $result->fetch()) {
                $relationsList[$i]['id'] = $row['id'];
                $relationsList[$i]['id_genre'] = $row['id_genre'];
                $relationsList[$i]['id_film'] = $row['id_film'];
                $i++;
            }

            return $relationsList;
        }
    }    

    //нужно еще добавить проверку на существование записей
    public static function createRow($id_film,$id_genre){
        $db = Db::getConnection();
        $sql = "INSERT into relationfg (id_film,id_genre) VALUES (:id_film, :id_genre)";

        $result = $db->prepare($sql);
        $result->bindParam(':id_film', $id_film, PDO::PARAM_INT);
        $result->bindParam(':id_genre', $id_genre, PDO::PARAM_INT);

        return $result->execute();
    }


    public static function removeRow($id_film,$id_genre){
            $db = Db::getConnection();
            $sql = "DELETE FROM relationfg WHERE id_film=:id_film AND id_genre=:id_genre";

            $result = $db->prepare($sql);
            $result->bindParam(':id_film', $id_film, PDO::PARAM_INT);
            $result->bindParam(':id_genre', $id_genre, PDO::PARAM_INT);
            
            return $result->execute();
    }

}