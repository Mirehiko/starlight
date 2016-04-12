<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Добавление | Годы | Администрирование | Starlight</title>
    <?php include('/templates/css/all_styles.php');?>

    <link href="/templates/administratorComponents/header/header.css" rel="stylesheet">
    <script src="/templates/administratorComponents/imageupload/imageupload.js."></script>
    <style type="text/css">
    /*Общие стили*/
        body{
            background-image: none;
            background-color: rgba(96, 125, 139, 0.3);
        }
        .edit-content{
            padding-top: 15px;
            height: 300px;
            margin-bottom: 20px;
        }
        .edit-content__div{
            background-color: #fff;
            padding-top: 15px;
            padding-bottom: 15px;
            min-height: 150px;
        }
        .edit-content p{
            padding-top: 15px;
            margin: 0;
            font-family: 'NeoSansCyr-Medium', sans-serif;
            color: #3b5167;
        }
        .col-md-12__input{
            width: 150px;
            display: inline-block;
        }
        .col-md-12__btn{
            display: inline-block;
            border-radius: 6px;
            padding: 0 14px;
            height: 40px;
            width: auto;
            margin: 0 10px 0 10px;
            line-height: 40px;
            color: white;
            background-color: #e84c3d;
            vertical-align: middle;
            text-shadow: 1px 1px 0 rgba(0,0,0,0.24);
            text-decoration: none;
        }
        .col-md-12__btn:hover{
            color: #fff;
            background-color: #434855;
        }
    </style>
    <script type="text/javascript">
    /*Добавление данных*/
        $(document).ready(function() {
            $(".updateItem").click(function () {

                var href = $(this).attr('data');
                var year = $('#year').val();

                $.post(
                    href,
                    {
                        year:        year
                    },
                    function(data){
                        if(data=="Запись успешно добавлена!"){
                            console.log(data);
                            //alert(data);
                            $('#year').val("");
                        }else{
                            console.log(data);
                            //alert(data);
                        }
                    }
                );
            });
        });
    //Только цифры
        $(document).ready(function() {
            $("#year").keydown(function(event) {
                // Разрешаем: backspace, delete, tab и escape
                if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || 
                     // Разрешаем: Ctrl+A
                    (event.keyCode == 65 && event.ctrlKey === true) || 
                     // Разрешаем: home, end, влево, вправо
                    (event.keyCode >= 35 && event.keyCode <= 39)) {
                         // Ничего не делаем
                         return;
                }
                else {
                    // Обеждаемся, что это цифра, и останавливаем событие keypress
                    if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                        event.preventDefault(); 
                    }   
                }
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
    <div class='edit-content__div'>
        <div class='col-md-4'></div>
        <div class='col-md-4'>
            <div class='row'>
            <div class='col-md-12'>
                <p class=''>Введите год:</p>
                <input id='year' name='year' class='col-md-12__input form-control' type='text' value="">
                <button data="/administrator/create/year" class='btn updateItem col-md-12__btn'>Добавить</button>
            </div>
            </div>
        </div>
        <div class='col-md-4'></div>
    </div>
</div>

<!--Footer-->
<?php include('/templates/components/footer/footer.php');?>



</body>
</html>
