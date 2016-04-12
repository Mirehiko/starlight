<?php

class Freedom {

    public static function getFreedomsList()
    {

        $db = Db::getConnection();

        $freedomList = array();

        $result = $db->query('SELECT * FROM freedoms ORDER BY name DESC');
                //. 'ORDER BY sort_order ASC');

        $i = 0;
        while ($row = $result->fetch()) {
            $freedomList[$i]['id'] = $row['id'];
            $freedomList[$i]['name'] = $row['name'];
            $i++;
        }

        return $freedomList;
    }

}