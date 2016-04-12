<?php
class Admin_updatesController{

    #Изменение фильма
    public function actionFilm($id){
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
            
            $path = ROOT."/images/films_data/";

            $checkFilm = CheckData::checkFilm($id, $title, $producer, $year, $f_long);

            if($checkFilm){
                echo "Такой фильм уже существует!";
            } else {
                $idFilm = Film::updateFilm($id, $title, $producer, $f_long, $content, $short_content, $year, $poster, $is_series, $is_anime);
                if($idFilm){
                    //mkdir($path.$idFilm);

                    echo "Запись успешно обновлена!";
                }else {
                    echo "Ошибка обновления записи!";
                }
            }
        }
        return true;
    }
    #Изменение статуса фильма
    public function actionStatus($id){

        if($_POST['status']=='print'){
            $status = 1;
        }else{
            $status = 0;
        }
        echo "id: ".$id.", stat: ".$status;
        if(Film::changeStatus($id, $status)){
            echo "Статус изменен!";
        }

        return true;
    }
    #Изменение жанра
    public function actionGenre($id){
        if(isset($_POST['name'])){

            $name    = $_POST['name'];
            $content = $_POST['content'];

            $checkGenre = CheckData::checkGenre($id, $name);

            if($checkGenre){
                echo "Такой жанр уже существует!";
            }else {
                if(Genre::updateGenre($id, $name, $content)){
                    echo "Запись успешно обновлена!";
                }else {
                    echo "Ошибка обновления записи!";
                }
            }
        }
        return true;
    }
    #Изменение сеанса
    public function actionSeanse(){
        if(isset($_POST['name'])){

            $name    = $_POST['name'];
            $content = $_POST['content'];

            $checkGenre = CheckData::checkGenre($name);
            if($checkGenre){
                echo "Такой Сеанс уже существует!";
            }else {
                if(Seanse::createSeanse($name, $content)){
                    echo "Запись успешно обновлена!";
                }else {
                    echo "Ошибка обновления записи!";
                }
            }
        }
        return true;
    }
    #Изменение пользователя
    public function actionUser($id){
        if(isset($_POST['name'])){

            $name       = $_POST['name'];
            $email      = $_POST['email'];
            $password   = $_POST['password'];
            $repassword = $_POST['repassword'];
            $freedom    = $_POST['freedom'];
            $avatar    = $_POST['avatar'];

            $checkName     = CheckData::checkName($name, $id);
            $checkEmail    = CheckData::checkEmail($email, $id);
            $checkPassword = CheckData::checkPassword($password);

            
            if($checkName){
                echo $checkName;
            }else if($checkEmail){
                echo $checkEmail;
            }else if($checkPassword){
                echo $checkPassword;
            }else if($password != $repassword){
                echo "Пароли не совпадают!";
            }else {
                $user = User::updateUser($id, $name, $email, $password, $freedom, $avatar);
                echo $user;
            }
        }
        return true;
    }

}

?>