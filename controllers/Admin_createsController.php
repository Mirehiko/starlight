<?php
class Admin_createsController{

    #Добавление фильма
    public function actionFilm(){
        if(isset($_POST['title'])){
            $title         = $_POST['title'];
            $producer      = $_POST['producer'];
            $year          = $_POST['year'];
            $f_long        = $_POST['f_long'];
            $content       = $_POST['content'];
            $poster        = $_POST['poster'];
            $is_series     = $_POST['is_series'];
            $is_anime      = $_POST['is_anime'];
            $short_content = substr($content,0,100);
            
            $was_array = false;
            if(isset($_POST['genArr'])){
                $relations = $_POST['genArr'];
                //удаляем лишние символы
                for($k=0;$k<count($relations);$k++){
                    $relations[$k] = trim($relations[$k]," \t\n\r\0\x0B");
                }
                $was_array = true;
            }

            $genres = Genre::getGenresList();

            $path = ROOT."/images/films_data/";

            $was_image='0';
            if(substr($poster, -1)==1){
                $was_image = '1';
            }


            $checkFilm = CheckData::checkFilm("",$title, $producer, $year, $f_long);
            if($checkFilm){
                echo "Такой фильм уже существует!";
            } else {
                $poster = substr($poster, 0, -1);
                //echo $poster;
                $idFilm = Film::createFilm($title, $producer, $f_long, $content, $short_content, $year, $poster, $is_series, $is_anime);
                if($idFilm){
                    mkdir($path.$idFilm);

                    if($was_array == true){
                        for($i=0;$i<count($relations);$i++){
                            foreach($genres as $gItem){
                                if($relations[$i]==$gItem['name']){
                                    RelationFG::createRow($idFilm, $gItem['id']);
                                }
                            }
                        }
                    }

                    if($was_image=='1'){
                        $poster = "/images/films_data/$idFilm/poster.jpg";
                        Film::updateFilm($idFilm, $title, $producer, $f_long, $content, $short_content, $year, $poster, $is_series, $is_anime);
                    }
                    echo "Запись успешно добавлена!".$was_image.$poster;
                }else {
                    echo "Ошибка вставки записи!";
                }
            }
        }
        return true;
    }
	#Добавление жанра
	public function actionGenre(){
        if(isset($_POST['name'])){

            $name    = $_POST['name'];
            $content = $_POST['content'];

            $checkGenre = CheckData::checkGenre("", $name);

            if($name == ""){
                echo "Имя жанра не должно быть пустым!";
            }else{
                if($checkGenre){
                    echo "Такой жанр уже существует!";
                }else {
                    if(Genre::createGenre($name, $content)){
                        echo "Запись успешно добавлена!";
                    }else {
                        echo "Ошибка вставки записи!";
                    }
                }
            }
        }
        return true;
	}
    #Добавление года - Complete
    public function actionYear(){
        if(isset($_POST['year'])){

            $year = $_POST['year'];

            $checkGenre = CheckData::checkYear($year);

            if($checkGenre){
                echo "Такая запись уже существует!";
            }else {
                if(Year::createYear($year)){
                    echo "Запись успешно добавлена!";
                }else {
                    echo "Ошибка вставки записи!";
                }
            }
        }
        return true;
    }
	#Добавление сеанса
	public function actionSeanse(){
        if(isset($_POST['s_date'])){

            $s_date = $_POST['s_date'];
            $b_time = $_POST['b_time'];
            $e_time = $_POST['e_time'];
            $s_film = $_POST['s_film'];
            $s_hall = $_POST['s_hall'];
            
            $checkSeanse = CheckData::checkSeanse($s_date, $b_time, $s_hall);
            if($checkSeanse){
                echo "Зал в это время занят!";
            }else {
                if(Seanse::createSeanse($s_date, $b_time, $e_time, $s_film, $s_hall)){
                    echo "Запись успешно добавлена!";
                }else {
                    echo "Ошибка вставки записи!";
                }
            }
        }
        return true;
	}
    #Добавление пользователя
    public function actionUser(){
        if(isset($_POST['name'])){

            $name       = $_POST['name'];
            $email      = $_POST['email'];
            $password   = $_POST['password'];
            $repassword = $_POST['repassword'];
            $freedom    = $_POST['freedom'];
            $avatar    = $_POST['avatar'];

            $checkName     = CheckData::checkName($name);
            $checkEmail    = CheckData::checkEmail($email);
            $checkPassword = CheckData::checkPassword($password);

            $was_image='0';
            if(substr($avatar, -1)==1){
                $was_image = '1';
            }
            $path = ROOT."/user_data/";
            if($checkName){
                echo $checkName;
            }else if($checkEmail){
                echo $checkEmail;
            }else if($checkPassword){
                echo $checkPassword;
            }else if($password != $repassword){
                echo "Пароли не совпадают!";
            }else {
                $avatar = substr($avatar, 0, -1);
                $userID = User::register($name, $email, $password, $freedom, $avatar);
                if($userID){
                    mkdir($path.$userID);
                }
                if($was_image=='1'){
                    $avatar = "/user_data/$userID/avatar.jpg";
                    User::updateUser($userID,$name, $email, $password, $freedom, $avatar);
                }
                echo "1$was_image".$avatar;
            }
        }
        return true;
    }

}

?>