<?php

class SeansesController{

	public function actionGetsomelist(){
        $s_date = $_POST['s_date'];
        $s_hall = $_POST['s_hall'];
        $seanses = Seanse::getSeansesListByDateAndHall($s_date, $s_hall);
	}
}
?>