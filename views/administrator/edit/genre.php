<!DOCTYPE html>
<html lang="ru">
<head>

    <?php include('/templates/css/all_styles.php');?>

    <link href="/templates/administratorComponents/header/header.css" rel="stylesheet">
    <script src="/templates/administratorComponents/imageupload/imageupload.js."></script>

    <link href="/views/administrator/adminstyle.css" rel="stylesheet">
    <style type="text/css">
        .updateItem {
            margin-top: 15px;
            width: 200px;
        }
    </style>
    <script type="text/javascript">
    /*Добавление данных*/
        $(document).ready(function() {
            $(".updateItem").click(function () {

                var href = $(this).attr('data');
                var name = $('#genre').val();
                var content = $('.edit-description').val();
                $.post(
                    href,
                    {
                        name:    name,
                        content:  content
                    },
                    function(data){
                        if(data=="Запись успешно обновлена!"){
                            console.log(data);
                            //alert(data);
                            /*$('#genre').val("");
                            $('.edit-description').val("");*/
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
                <p class=''>Название жанра:</p>
                <input id='genre' name='genre' class='col-md-12__input form-control' type='text' value="<?php echo $genre['name']?>">
                <p class=''>Описание:</p>
                <textarea class='form-control edit-description'><?php echo $genre['content']?></textarea>
                <button data="/administrator/update/Genre/<?php echo $genre['id']?>" class='btn updateItem btn-more'>Изменить</button>
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
