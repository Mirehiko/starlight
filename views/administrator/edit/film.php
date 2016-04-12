<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?php echo $film['title'];?> | Редактирование | Фильмы | Администрирование | Starlight</title>
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
        .adj-set{
            margin-top: 15px;
        }
        .adj-set .check{
            vertical-align: text-bottom;
        }
    </style>
    <script type="text/javascript">

    /*'genres[]': genArr*/
    /*Добавление жанров*/
        var genArr=[];
        var neededID="";
        $(document).ready(function(){
            $('.selectGen').click(function(){
                var atr=$(this).text();
                var exbtn=false;
                var i=0;
                $('.attached-genre').each(function(){
                        console.log(i);
                        i++;
                    var g=$(this).text();
                    var gt=g.slice(0,g.length-1);
                    //console.log(gt);
                    if(gt==atr){
                        exbtn=true;
                    }
                });
                if(exbtn==false){

                    var item = "<button type='button' class='btn btn-default attached-genre' gbtnid='"+$(this).attr('iddata')+"'>"+$(this).text()+" <i class='fa fa-times'></i></button>";
                    $('#genreList').after(item);
                    genArr.push($(this).text());
                    var id = '<?php echo $filmID;?>';
                    //console.log($(this).attr('iddata'));
                    $.post(
                        '/administrator/films/addgenres',
                        {
                            genreID: $(this).attr('iddata'),
                            filmID:  id
                        },
                        function(data){
                            
                        }
                    );
                }

            });
            $('.btn-group').delegate('.attached-genre', 'click',function(){
                var g=$(this).text();
                g=g.slice(0, -1);
                for(var i=0;i<genArr.length;i++){
                    console.log(genArr[i]);
                    if(genArr[i]==g){
                        genArr.splice(i,1);
                    }
                }
                $(this).remove();
                var id = '<?php echo $filmID;?>';
                $.post(
                    '/administrator/films/removegenres',
                    {
                        genreID: $(this).attr('gbtnid'),
                        filmID:  id
                    },
                    function(data){
                        //alert(data);
                    }
                );
            });
        });
    /*Выбор года*/
        var selected_year='';
        $(document).ready(function(){
            $('.edit-year').click(function(){
                selected_year=$(this).val();
            });
            $('.edit-year').click();
        });
        var path = '<?php echo $poster?>';
    /*Загрузка изображения*/
        var u = "/templates/administratorComponents/imageupload/upload.php?path=";
        var default_image = "/images/default/poster.jpg";
        var path_to_film = "<?php echo $poster?>";
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
                var id = '<?php echo $filmID;?>';
                var title = $('#title').val();
                var producer = $('#producer').val();
                var long = $('#long').val();
                var content = $('.edit-description').val();

                var is_anime = 0, is_series = 0;
    
                if($('#is-series').prop("checked")){
                    is_series = 1;
                } else{
                    is_series = 0;
                }
                if($('#is-anime').prop("checked")){
                    is_anime = 1;
                } else{
                    is_anime = 0;
                }

                if(img_attached == true){
                    path = path_to_film;
                }else if(path_to_film == default_image){
                    path = default_image;
                }else{
                    path = path_to_film;
                }
                
                console.log(path);
                $.post(
                    href,
                    {
                        id:       id,
                        title:    title,
                        producer: producer,
                        f_long:   long,
                        content:  content,
                        year:     selected_year,
                        poster:   path,
                        is_anime:   is_anime,
                        is_series:  is_series
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
                    if($poster=='/images/default/poster.jpg'){
                        echo "<img src='/images/default/poster.jpg' class='edit-poster' alt=''>";
                    }else{
                        echo "<img src='$poster' class='edit-poster' alt=''>";
                    }
                ?>
            </div>
            <div id="upload_image"></div>
            <div class='col-md-12'>
                <div class='adj-set'>
                    <label>
                        Сериал:
                        <?php
                            if($film['is_series']==1){
                                echo "<input type='checkbox' class='check' id='is-series' value='' checked='checked'>";
                            }else{
                                echo "<input type='checkbox' class='check' id='is-series' value=''>";
                            }
                        ?>
                    </label>
                    <label>
                        Аниме:
                        <?php
                            if($film['is_anime']==1){
                                echo "<input type='checkbox' class='check' id='is-anime' value='' checked='checked'>";
                            }else{
                                echo "<input type='checkbox' class='check' id='is-anime' value=''>";
                            }
                        ?>                        
                    </label>
                </div>
            </div>
        </div>
        <div class='col-md-7'>
            <div class='row'>
            <div class='col-md-7'>
                <p class=''>Название:</p>
                <input id='title' name='title' class='form-control' type='text' value="<?php echo $film['title'];?>">
                <p class=''>Жанры:</p>
                <div class='btn-group'>
                    <button type='button' class='btn btn-default disabled' id='genreList'>></button>
                    <?php 
                        foreach($relationsfg as $relItem){
                            foreach($genres as $genItem){
                            
                                if($genItem['id']==$relItem['id_genre']){
                                    echo "
                                    <script>
                                        $(document).ready(function(){
                                        var item = \"<button type='button' class='btn btn-default attached-genre' gbtnid='".$genItem['id']."'>".$genItem['name']." <i class='fa fa-times'></i></button>\";
                                        $('#genreList').after(item);
                                        genArr.push($(this).text());
                                        });
                                    </script>";
                                }
                            }
                        }
                    ?>
                    <button id='addGenreBtn' type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <i class='fa fa-plus'></i>
                    </button>
                    <ul class='dropdown-menu pull-right'>
                        <?php foreach ($genres as $genreItem):?>
                        <li>
                            <a href='#tab' class='selectGen' iddata="<?php echo $genreItem['id'];?>">
                                <?php echo $genreItem['name'];?>
                            </a>
                        </li>
                        <?php endforeach?>
                    </ul>
                </div>

                <p class=''>Режиссер:</p>
                <input id='producer' name='producer' class='form-control producer' type='text' value="<?php echo $film['producer'];?>">

                <p class=''>Дата:</p>
                <select class="form-control edit-year">
                    <?php foreach ($years as $yearItem):?>
                        <?php 
                            if($film['year']==$yearItem['id']){
                                echo "<option selected value='".$yearItem['id']."'>".$yearItem['year']."</option>";
                            }else{
                                echo "<<option value='".$yearItem['id']."'>".$yearItem['year']."</option>";
                            }
                        ?>
                    <?php endforeach?>
                </select>

                <p class=''>Продолжительность:</p>
                <input id='long' name='long' class='form-control long' type='text' value="<?php echo $film['f_long'];?>">
            </div>
            </div>
            <p class=''>Описание:</p>
            <textarea class='form-control edit-description'><?php echo $film['content'];?></textarea>

            <button data="/administrator/update/film/<?php echo $film['id'];?>" class='btn btn-more updateItem'>Изменить</button>

        </div>
        <div class='col-md-2'></div>
    </div>
</div>

<!--Footer-->
<?php include('/templates/components/footer/footer.php');?>

</body>
</html>
