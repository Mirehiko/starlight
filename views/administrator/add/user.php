<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Добавление | Пользователи | Администрирование | Starlight</title>
    <?php include('/templates/css/all_styles.php');?>

    <link href="/templates/administratorComponents/header/header.css" rel="stylesheet">
    <script src="/templates/administratorComponents/imageupload/imageupload.js."></script>

    <link href="/views/administrator/adminstyle.css" rel="stylesheet">
    <style type="text/css">
    /**/
        .updateItem{
            margin-top: 15px;
            width: 200px;
        }
        #upload_image{
            display: none;
        }

    </style>
    <script type="text/javascript">
    /*Выбор прав доступа*/
        var freedom='';
        $(document).ready(function(){
            $('.edit-year').click(function(){
                freedom=$(this).val();
                console.log(freedom);
            });
            $('.edit-year').click();
        });

    var def_img = '/images/default/avatar.jpg';
    var user_folder="";
    var default_image = def_img + "0";
    var u = "/templates/administratorComponents/imageupload/upload.php?path=";
    var path = u;
    var path_to_film='';
    var click=0;
    var img_attached=false;
    /*Загрузка изображения*/
        $(document).ready(function () {
            $("#upload_image").imageUpload( path, {
                uploadButtonText: "Загрузить фото",
                previewImageSize: 100,
                onSuccess: function (response) {
                    console.log(response);
                }
            });
        });
        $(document).ready(function () {
            $('.div-img').delegate(".edit-poster","click", function(){
                $('#file-field').click();
                click++;
            });
        });
    /*Добавление данных*/
        $(document).ready(function() {
            $(".updateItem").click(function () {
                var href = $(this).attr('data');
                var name = $('#name').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var repassword = $('#repassword').val();

                if(img_attached == true){
                    default_image = def_img + "1";
                }
                
                $.post(
                    href,
                    {
                        name:        name,
                        email:       email,
                        password:    password,
                        repassword:  repassword,
                        freedom:     freedom,
                        avatar:      default_image
                    },
                    function(data){
                        var success = data.charAt(25);
                        if(success == 1){
                            console.log('Пользователь успешно добавлен!');
                            //var puti = data.substring(30);
                            var was_image = data.charAt(26);
                            if(was_image == 1){
                                film_folder = data.substring(27);
                                console.log('Крепим картинку...');
                                path = path + film_folder;
                                $('#load-img').click();
                            }else{
                                console.log('Картинка по умолчанию');
                            }
                            location.reload();
                        }else{
                            console.log(data);
                        }
                    }
                );
            });
        });
    </script>
</head>
<body>
<!--Шапка-->
<header>
    <?php include('/templates/administratorComponents/header/header.php');?>
</header>


<div class='container edit-content'>
    <div class='edit-content'>
        <div class='col-md-1'></div>
        <div class='col-md-2'>
            <div class='div-img'>
                <img src="/images/default/avatar.jpg"  class='edit-poster' alt=''>
            </div>
            <div id="upload_image"></div>
        </div>
        <div class='col-md-7'>
            <div class='row'>
            <div class='col-md-7'>
                <p class=''>Имя пользователя (Логин):</p>
                <input id='name' name='name' class='form-control' type='text' value="">
                <p class=''>Email:</p>
                <input id='email' name='email' class='form-control producer' type='text' value="">

                <p class=''>Пароль:</p>
                <input id='password' name='password' class='form-control producer' type='password' value="">
                <p class=''>Повторите пароль:</p>
                <input id='repassword' name='repassword' class='form-control producer' type='password' value="">

                <p class=''>Уровень доступа:</p>
                <select class="form-control edit-year">
                    <?php foreach ($freedoms as $freeItem):?>
                        <?php 
                            echo "<option value='".$freeItem['id']."'>".$freeItem['name']."</option>";
                        ?>
                    <?php endforeach?>
                </select>
            </div>
            </div>

            <button data="/administrator/create/user" class='btn btn-more updateItem'>Добавить</button>

        </div>
        <div class='col-md-2'></div>
    </div>
</div>

<!--Footer-->
<?php include('/templates/components/footer/footer.php');?>



</body>
</html>
