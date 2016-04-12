<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Добавление | Фильмы | Администрирование | Starlight</title>
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
        .adj-set{
            margin-top: 15px;
        }
        .adj-set .check{
            vertical-align: text-bottom;
        }
    </style>
    <script type="text/javascript">

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
                }

            });
            $('.btn-group').delegate('.attached-genre', 'click', function(){
                var g=$(this).text();
                g=g.slice(0, -1);
                for(var i=0;i<genArr.length;i++){
                    console.log(genArr[i]);
                    if(genArr[i]==g){
                        genArr.splice(i,1);
                    }
                }
                $(this).remove();
            });
        });
    /*Выбор года*/
        var selected_year='';
        $(document).ready(function(){
            $('.edit-year').click(function(){
                selected_year=$(this).val();
                console.log(selected_year);
            });
            $('.edit-year').click();
        });
    var def_img = '/images/default/poster.jpg';
    var film_folder="";
    var default_image = def_img + "0";
    var u = "/templates/administratorComponents/imageupload/upload.php?path=";
    var path = u;
    var click=0;
    var img_attached=false;
    var path_to_film="";
    /*Загрузка изображения*/
        $(document).ready(function () {
            $("#upload_image").imageUpload( path, {
                uploadButtonText: "Загрузить фото",
                previewImageSize: 100,
                onSuccess: function (response) {
                    console.log(response);
                }
            });
    /*Добавление данных*/
            $(".updateItem").click(function () {
                var href = $(this).attr('data');
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
                    default_image = def_img + "1";
                }

                $.post(
                    href,
                    {
                        title:      title,
                        producer:   producer,
                        f_long:     long,
                        content:    content,
                        year:       selected_year,
                        poster:     default_image,
                        'genArr[]':      genArr,
                        is_anime:   is_anime,
                        is_series:  is_series
                    },
                    function(data){
                        if(data=="Такой фильм уже существует!"){
                            alert(data);
                        }else{
                            console.log(data);
                            var puti = data.substring(26);
                            console.log("puti:"+puti);
                            film_folder = puti;
                            console.log("film_folder:"+film_folder);
                            var was_image = data.charAt(25);
                            console.log("was_image:"+was_image);
                            if(was_image==1){
                                path = path + film_folder;
                                $('#load-img').click();
                            }else{
                                console.log('Изображение не выбрано');
                            }                        
                            location.reload();
                        }
                    }
                );
            });
        });

        $(document).ready(function () {
            $('.div-img').delegate(".edit-poster","click", function(){
                $('#file-field').click();
                click++;
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
                <img src="/images/default/poster.jpg"  class='edit-poster' alt=''>
            </div>
            <div id="upload_image"></div>
            <div class='col-md-12'>
                <div class='adj-set'>
                    <label>
                        Сериал:
                        <input type="checkbox" class='check' id='is-series' value=''>
                    </label>
                    <label>
                        Аниме:
                        <input type="checkbox" class='check' id='is-anime' value=''>
                    </label>
                </div>
            </div>
        </div>
        <div class='col-md-7'>
            <div class='row'>
            <div class='col-md-7'>
                <p class=''>Название:</p>
                <input id='title' name='title' class='form-control' type='text' value="">
                <p class=''>Жанры:</p>
                <div class='btn-group'>
                    <button type='button' class='btn btn-default disabled' id='genreList'>></button>
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
                <input id='producer' name='producer' class='form-control producer' type='text' value="">

                <p class=''>Дата:</p>
                <select class="form-control edit-year">
                    <?php foreach ($years as $yearItem):?>
                        <?php 
                            echo "<option value='".$yearItem['id']."'>".$yearItem['year']."</option>";
                        ?>
                    <?php endforeach?>
                </select>

                <p class=''>Продолжительность:</p>
                <input id='long' name='long' class='form-control long' type='text' value="">
            </div>
            </div>
            <p class=''>Описание:</p>
            <textarea class='form-control edit-description'></textarea>

            <button data="/administrator/create/film" class='btn btn-more updateItem'>Добавить</button>

        </div>
        <div class='col-md-2'></div>
    </div>
</div>

<!--Footer-->
<?php include('/templates/components/footer/footer.php');?>



</body>
</html>
