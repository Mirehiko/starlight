<?php
include_once '../models/User.php';
class Db{
    public static function getConnection(){
        $paramsPath = '../config/db_params.php';
        $params = include($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn,$params['user'],$params['password']);
        return $db;
    }
}

$name='';
$email='';
$password='';
$repassword='';

$n=false;
$e=false;
$p=false;
$r=false;

if(isset($_POST['send_login'])){
    
    $name=$_POST['send_login'];
    $email=$_POST['send_email'];
    $password=$_POST['send_pass'];
    $repassword=$_POST['send_repass'];

 	$db = Db::getConnection();

    echo "<script>
    	$('#login-ok').text('');
    	$('#login-error').text('');
    	$('#email-ok').text('');
    	$('#email-error').text('');
    	$('#password-ok').text('');
    	$('#password-error').text('');
    	$('#repassword-ok').text('');
    	$('#repassword-error').text('');
    ";
    #Проверка существования имени пользователя
    	$sql = "SELECT username FROM users WHERE username=:name";
    	$result=$db->prepare($sql);
    	$result->bindParam(':name',$name,PDO::PARAM_STR);
    	$result->execute();
    	if($result->fetchColumn()){
    		echo "$('#login-error').text('Имя занято!');";
    		$n=false;
    	}else if(strlen($name)<2){
    		echo "$('#login-error').text('Слишком короткое имя!');";
    		$n=false;
    	}else {
    		echo "$('#login-ok').text('Имя свободно!');";
    		$n=true;
    	}
    #Проверка существования email
        $sql = "SELECT email FROM users WHERE email=:email";
        $result=$db->prepare($sql);
        $result->bindParam(':email',$email,PDO::PARAM_STR);
        $result->execute();
    	if(filter_var($email,FILTER_VALIDATE_EMAIL)){
	    	if($result->fetchColumn()){
	    		echo "$('#email-error').text('Этот email уже используется!');";
	    		$e=false;
	    	}else {
	    		$e=true;
	    		//echo "$('#email-ok').text('ok');";
	    	}
    	}else{
    		echo "$('#email-error').text('Неправильный вид email');";
    		$e=false;
    	}
    #Проверка пароля
    	if($password==""){
    		echo "$('#password-error').text('Введите пароль!');";
    		$p=false;
    	}else if(strlen($password)<6){
    		echo "$('#password-error').text('Пароль должен быть длиной не менее 6 символов!');";
    		$p=false;
    	}else {
    		//echo "$('#password-ok').text('ок');";
    		$p=true;
    	}

    	if(($repassword=="" && $password=="") || strlen($password)<6){
    		echo "$('#repassword-ok').text('');";
    		$r=false;
    	}else if($repassword==$password){
    		//echo "$('#repassword-error').text('ok');";
    		$r=true;
    	} else{
    		echo "$('#repassword-error').text('Пароли не совпадают!');";
    		$r=false;
    	}
if($n==true && $e==true && $p==true && $r==true){
    $result=User::register($name,$email,$password);
    echo "alert('Вы зарегистрированы');";
}  
    echo "</script>";


}


?>