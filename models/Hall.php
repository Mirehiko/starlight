<?php

class Hall {

    public static function getHallList(){

        $db = Db::getConnection();

        $hallList = array();
        $sql ="SELECT * FROM halls ORDER BY number ASC";

        $result = $db->query($sql);
                //. 'ORDER BY sort_order ASC');

        $i = 0;
        while ($row = $result->fetch()) {
            $hallList[$i]['id'] = $row['id'];
            $hallList[$i]['number'] = $row['number'];
            $i++;
        }

        return $hallList;
    }

}