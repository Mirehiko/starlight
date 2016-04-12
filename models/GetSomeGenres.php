<?php

class GetSomeGenres {

    public static function getSomeGenresList($id)
    {

        $db = Db::getConnection();

        $genreList = array();

        $result = $db->query("SELECT * FROM genres WHERE id=any(SELECT id_genre FROM relationfg WHERE id_film='$id')
         ORDER BY name");
                //. 'ORDER BY sort_order ASC');

        $i = 0;
        while ($row = $result->fetch()) {
            $genreList[$i]['id'] = $row['id'];
            $genreList[$i]['name'] = $row['name'];
            $i++;
        }

        return $genreList;
    }

}