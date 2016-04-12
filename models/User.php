<?php

class User {
	#Регистрация нового пользователя
	public static function register($name, $email, $password, $freedom = 1, $avatar){
		$db=Db::getConnection();

		$sql="INSERT INTO users (username, email, password, freedom, avatar)
			  values (:name, :email, :password, :freedom, :avatar)";		
		
    	$result=$db->prepare($sql);
    	$result->bindParam(':name',$name,PDO::PARAM_STR);
    	$result->bindParam(':email',$email,PDO::PARAM_STR);
    	$result->bindParam(':password',$password,PDO::PARAM_STR);
        $result->bindParam(':avatar',$avatar,PDO::PARAM_STR);
    	$result->bindParam(':freedom',$freedom,PDO::PARAM_INT);
        if($result->execute()){
            #Возвращаем id только что добавленного пользователя
            return $db->lastInsertId();
        }
	}
	#Обновление данных пользователя
	public static function updateUser($id, $name, $email, $password, $freedom = 1, $avatar){
		$db=Db::getConnection();

		$sql="UPDATE 
				users
			  SET
			  	username = :name,
			    email    = :email,
			    password = :password,
			    freedom  = :freedom,
                avatar   = :avatar
			  WHERE id=:id";		
		
    	$result=$db->prepare($sql);
    	$result->bindParam(':name',$name,PDO::PARAM_STR);
    	$result->bindParam(':email',$email,PDO::PARAM_STR);
    	$result->bindParam(':password',$password,PDO::PARAM_STR);
    	$result->bindParam(':freedom',$freedom,PDO::PARAM_INT);
        $result->bindParam(':avatar',$avatar,PDO::PARAM_STR);
    	$result->bindParam(':id',$id,PDO::PARAM_INT);
    	if($result->execute()){
    		echo("Запись успешно обновлена!");
    	}else{
    		echo "Ошибка обновления записи!";
    	}
	}
    #Удаление пользователя
    public static function removeUser($id){
        if ($id) {                        
            $db = Db::getConnection();
            $sql = "DELETE FROM users WHERE id=:id";

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            
            return $result->execute();
        }
    }
	#Создание сессии пользователя
	public static function auth($userID){
		
		$_SESSION['user'] = $userID;
	}
	#Проверяем авторизован ли пользователь
	public static function checkLogged(){
		
		if(isset($_SESSION['user'])){
			return $_SESSION['user'];
		}

		//header("Location: /user/login");
	}
	#Получаем пользователя с указанным Id
	public static function getUserById($id){
		if($id){
			$db = Db::getConnection();
			$sql = "SELECT * FROM users WHERE id=:id";

			$result = $db->prepare($sql);
			$result->bindParam(':id',$id,PDO::PARAM_INT);

			$result->setFetchMode(PDO::FETCH_ASSOC);
			$result->execute();

			return $result->fetch();
		}
	}
	#Получение списка пользователей
    public static function getUserList($sort = 'username', $arrow = 'ASC'){

        /*$page = intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        $lim=self::SHOW_BY_DEFAULT;*/

        $db = Db::getConnection();            
        $users = array();
        //$zapros="SELECT * FROM users ORDER BY id ASC LIMIT $lim OFFSET $offset";
        $zapros="SELECT * FROM users ORDER BY $sort $arrow";
        $result = $db->query($zapros);

        $i = 0;
        while ($row = $result->fetch()) {
            $users[$i]['id'] = $row['id'];
            $users[$i]['username'] = $row['username'];
            $users[$i]['email'] = $row['email'];
            $users[$i]['password'] = $row['password'];
            $users[$i]['avatar'] = $row['avatar'];
            $users[$i]['freedom'] = $row['freedom'];
            $i++;
        }

        return $users;       
    }
}

?>