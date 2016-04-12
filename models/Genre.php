<?php

class Genre {

    #Получение списка жанров
    public static function getGenresList($sort = 'name', $arrow = 'ASC'){

        $db = Db::getConnection();

        $genreList = array();

        $sql = "SELECT * FROM genres ORDER BY $sort $arrow";
        $result = $db->query($sql);
                //. 'ORDER BY sort_order ASC');

        $i = 0;
        while ($row = $result->fetch()) {
            $genreList[$i]['id'] = $row['id'];
            $genreList[$i]['name'] = $row['name'];
            $genreList[$i]['content'] = $row['content'];
            $i++;
        }

        return $genreList;
    }
    
    #Получение жанра по id
    public static function getGenreById($id){
        if($id){
            $db = Db::getConnection();
            $sql = "SELECT * FROM genres WHERE id=:id";

            $result = $db->prepare($sql);
            $result->bindParam(':id',$id,PDO::PARAM_INT);

            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();
        }
    }
    #Добавление жанра в БД
    public static function createGenre($name, $content){
        $db = Db::getConnection();

        $sql = "INSERT into genres (name, content) VALUES(:name, :content)";

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':content', $content, PDO::PARAM_STR);

        return $result->execute();
    }
    #Изменение жанра
    public static function updateGenre($id, $name, $content){
        if ($id) {    
                              
            $db = Db::getConnection();
            $sql = "UPDATE 
                        genres 
                    SET 
                        name = :name, 
                        content = :content
                    WHERE id = :id";
            
            $result = $db->prepare($sql);

            $result->bindParam(':id', $id);
            $result->bindParam(':name', $name);
            $result->bindParam(':content', $content);

            return $result->execute();
        }
    }
    #Удаление жанра
    public static function removeGenre($id){
        if ($id) {                        
            $db = Db::getConnection();
            $sql = "DELETE FROM genres WHERE id=:id";

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            
            return $result->execute();
        }
    }
}