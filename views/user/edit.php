<!DOCTYPE html>
<html lang="ru">
<head>
    <?php include('/templates/css/all_styles.php');?>

    <link href="/templates/moduls/avatar_upload/avatar_upload.css" rel="stylesheet">
    <script src="/views/user/imageupload.js"></script>


    <style type="text/css">
    /**/
        .big-img{
        	padding-left: 15px;
        	text-align: left;

        }
        .form-registration .btn-more{
            margin: 0 auto;
            color: #34495E;
            background-color: #EFEBDE;
            font-family: 'NeoSansCyr-Medium', sans-serif;
            border: 2px solid rgb(220, 220, 220);   
            text-shadow: none;         
        }
        .form-registration .btn-more:hover{
            background-color: #DCDCDC;
            border-color: rgba(115, 130, 144, 0.41);
        }
        .form-registration{
            display: block;
            width: auto;
        	text-align: left;
        	color: #34495e;
            background-color: #fff;
            font-family: 'NeoSansCyr-Regular', sans-serif;
        }
        .form-registration-input{
            display: block;
            width: 230px;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #34495e;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        }
        
        .registration_form{
        	word-wrap: break-word;
        	margin: 15px 0 15px;
            min-width: 260px;
        	border: none;
        	background-color: transparent;
        	padding: 15px;
            padding-bottom: 30px;
            min-height: 400px;
            background-color: white;
        }
        .registration_title{
            font-family: 'NeoSansCyr-Medium', sans-serif;
            color: #3b5167;
            text-align: left;
            padding-left: 15px;
            padding-bottom: 5px;
        }
        .errors{
            color: #e84c3d;
            font-size: 12px;
            padding-bottom: 5px
        }
        .success{
            color: green;
            font-size: 12px;
            padding-bottom: 5px;
        }
    </style>

    <script>
        $(document).ready(function () {
            $("#upload_image").imageUpload("/views/user/upload.php?path=<?php echo $avatar;?>", {
                uploadButtonText: "Загрузить фото",
                previewImageSize: 150,
                onSuccess: function (response) {
                    alert(response);
                }
            });
        });
        $(document).ready(function () {
            $('.div-img').delegate(".defaultImage","click", function(){
                $('#file-field').click();
            });
        });
        $(document).ready(function(){
            $('#register-btn').click(function(){
                $.post(
                    '/scripts/check_user_data.php',
                    //'#',
                    {
                        send_login:  $('#login').val(),
                        send_email:  $('#email').val(),
                        send_pass:   $('#password').val(),
                        send_repass: $('#repassword').val()
                    },
                    function(data){
                        $('#server_responce').empty();
                        $('#server_responce').append(data);
                    }
                );
            });
        });
    </script>
</head>
<body>
<!--Шапка-->
<header>
    <?php include('/templates/components/header/header.php');?>
</header>

<div id='content' class='container'>
    <div class='color-left col-xs-12 col-md-2'>
        <?php include('/templates/moduls/left_menu/left_menu.php');?>
        <?php include('/templates/moduls/randomFilm/randomFilm.php');?>
    </div>
    <div class='color-right col-xs-12 col-md-8'>
        <div class='col-xs-12 col-sm-6 col-md-12'>
            <div class='registration_form'>
                <div class='registration_title'>
                	<h4>Редактировать профиль</h4>
                </div>
                <div class='row'>
	                <div class='col-md-5 big-img'>
                    <?php include('/templates/moduls/avatar_upload/avatar_upload.php');?>
	                </div>
                    <div class='col-md-7 '>
                        <div class='form-registration'>
                            <b>Имя пользователя:</b>
                            <input id='login' class='form-registration-input'type='text' placeholder='Логин' value="<?php echo $name;?>">
                            <b id='login-ok' class='success'></b><b id='login-error' class='errors'></b>
                            <br>
                            <b>E-mail:</b>
                            <input id='email' class='form-registration-input'type='text' placeholder='vasya@mail.ru' value="<?php echo $email;?>">
                            <b id='email-ok' class='success'></b><b id='email-error' class='errors'></b>
                            <br>
                            <b>Пароль:</b>
                            <input id='password' class='form-registration-input'type='password' value="<?php echo $password;?>">
                            <b id='password-ok' class='success'></b><b id='password-error' class='errors'></b>
                            <br>
                            <b>Повторите пароль:</b>
                            <input id='repassword' class='form-registration-input'type='password' value="<?php echo $password;?>">
                            <b id='repassword-ok' class='success'></b><b id='repassword-error' class='errors'></b>
                            <br>
                            <input type="submit" id='register-btn' class='btn btn-more' value='Принять'></button>
                            <div id='server_responce'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Footer-->
<?php include('/templates/components/footer/footer.php');?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/Bootstrap/js/salvattore.min.js"></script>
<script src="/Bootstrap/js/bootstrap.js"></script>

</body>
</html>

