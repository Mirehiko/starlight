<?php

class Db{
	public static function getConnection(){
		$paramsPath = ROOT.'/config/db_params.php';
		$params = include($paramsPath);

		$dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
		//$dsn = "mysql:host={$params['host']};port='3306'; dbname={$params['dbname']}";
		$db = new PDO($dsn,$params['user'],$params['password']);
		return $db;
	}
}
?>