<!DOCTYPE html>
<html lang="ru">
<head>
<title><?php echo $user['username'];?> | Редактирование | Фильмы | Администрирование | Starlight</title>
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
    </style>
    <script type="text/javascript">
    /*Выбор прав доступа*/
        var freedom='';
        $(document).ready(function(){
            $('.edit-freedom').click(function(){
                freedom=$(this).val();
                console.log(freedom);
            });
            $('.edit-freedom').click();
        });
    /*Загрузка изображения*/
        var u = "/templates/administratorComponents/imageupload/upload.php?path=";
        var default_image = "/images/default/avatar.jpg";
        var path_to_film = "<?php echo $avatar?>";
        var img_attached=false;

        var path = u;
        console.log(path);

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
            });
        });
    /*Обновление данных*/
        $(document).ready(function() {
            $(".updateItem").click(function () {
                var href = $(this).attr('data');
                var id = '<?php echo $userID;?>';
                var name = $('#name').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var repassword = $('#repassword').val();

                var loadimg = "";
                console.log("send"+path);
                if(img_attached == true){
                    if(path_to_film == default_image){
                        path_to_film = "/user_data/"+id+"/avatar.jpg";
                    }
                    path = u + path_to_film;
                    loadimg = path_to_film;
                    $('#load-img').click();
                }else {
                    if(path_to_film == default_image){
                        loadimg = default_image;
                    }else{
                        loadimg = path_to_film;
                    }
                }
                $.post(
                    href,
                    {
                        id:          id,
                        name:        name,
                        email:       email,
                        password:    password,
                        repassword:  repassword,
                        freedom:     freedom,
                        avatar:      loadimg
                    },
                    function(data){
                        console.log(data);
                        location.reload();
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
                <?php
                    if($avatar=='/images/default/avatar.jpg'){
                        echo "<img src='/images/default/avatar.jpg' class='edit-poster' alt=''>";
                    }else{
                        echo "<img src='$avatar' class='edit-poster' alt=''>";
                    }
                ?>
            </div>
            <div id="upload_image"></div>
        </div>
        <div class='col-md-7'>
            <div class='row'>
            <div class='col-md-7'>
                <p class=''>Имя пользователя (Логин):</p>
                <input id='name' name='name' class='form-control' type='text' value="<?php echo $user['username'];?>">
                <p class=''>Email:</p>
                <input id='email' name='email' class='form-control producer' type='text' value="<?php echo $user['email'];?>">

                <p class=''>Пароль:</p>
                <input id='password' name='password' class='form-control producer' type='text' value="<?php echo $user['password'];?>">
                <p class=''>Повторите пароль:</p>
                <input id='repassword' name='repassword' class='form-control producer' type='password' value="<?php echo $user['password'];?>">

                <p class=''>Уровень доступа:</p>
                <select class="form-control edit-freedom">
                    <?php foreach ($freedoms as $freeItem):?>
                        <?php 
                            if($freeItem['id'] == $user['freedom']){
                                echo "<option selected value='".$freeItem['id']."'>".$freeItem['name']."</option>";
                            } else{
                                echo "<option value='".$freeItem['id']."'>".$freeItem['name']."</option>";
                            }
                        ?>
                    <?php endforeach?>
                </select>
            </div>
            </div>

            <button data="/administrator/update/user/<?php echo $user['id'];?>" class='btn btn-more updateItem'>Изменить</button>

        </div>
        <div class='col-md-2'></div>
    </div>
</div>

<!--Footer-->
<?php include('/templates/components/footer/footer.php');?>



</body>
</html>
