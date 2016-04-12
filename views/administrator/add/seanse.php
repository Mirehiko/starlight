<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Добавление | Сеансы | Администрирование | Starlight</title>
    <?php //include('/templates/css/all_styles.php');?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    
    <!-- Bootstrap -->
    

    <link href="/Bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="/Bootstrap/css/style.css" rel="stylesheet">
    <link href="/Bootstrap/css/font-awesome.css" rel="stylesheet">
    <script src="/Bootstrap/js/bootstrap.js"></script>

    <link href="/templates/components/header/header.css" rel="stylesheet">
    <link href="/templates/css/main.css" rel="stylesheet">
    <link href="/templates/components/footer/footer.css" rel="stylesheet">

    <link href="/templates/moduls/autocomplete/autocomplete.css" rel="stylesheet">
    <script src="/templates/administratorComponents/autocomplete/autocomplete.js"></script>

    <script type="text/javascript" src="/templates/moduls/datepicker/js/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="/templates/moduls/datepicker/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/templates/moduls/datepicker/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="/templates/moduls/datepicker/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/templates/moduls/datepicker/css/bootstrap-datetimepicker.min.css" />

    <link href="/templates/administratorComponents/header/header.css" rel="stylesheet">

    <link href="/views/administrator/adminstyle.css" rel="stylesheet">
    <style type="text/css">
    /**/
        #searchButton{
            display: none;
        }
        #searchField{
            background-color: #FFF;
            border-color: #CCC;
            color: #3b5167;

        }
        #autocomplete{
            z-index: 3;
            background-color: rgb(0, 150, 136);
        }
        #autocomplete a:hover{
            background-color: #0B8075;
        }
        .navbar-right{
            float: none !important;
            margin: 0;
            padding: 0 0 0 15px;
        }
        .s_text{
            padding-left: 15px;
        }
        .updateItem{
            margin-top: 15px;
            width: 200px;
        }
        .btn-more{
            background-color: #009688;
            margin-top: 30px;
        }
        .btn-more:hover{
            background-color: #0B635A;
            color: white;
        }
        .warp{
            margin-left: -15px;
        }
        #seansesList .text-center{
            height: 90px;
        }
        #seansesList{
            margin-top: 20px;
        }

        .process{
            font-family: 'NeoSansCyr-Medium', sans-serif;
            color: #3B5167;
            background-color: #FFC25D;
            padding: 12px;
            border-radius: 2px;
            display: inline-block;
            margin: 2px;
        }
        .free{
            font-family: 'NeoSansCyr-Medium', sans-serif;
            color: #3B5167;
            background-color: #eee;
            padding: 12px;
            border-radius: 2px;
            display: inline-block;
            margin: 2px;
        }
        .my-alert{
            padding: 7px;
            margin-top: 32px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-close {
            margin-right: 5px;
            float: right;
        }
        .alert-success > .alert-close:hover{
            color: #03BB03;
        }
        .alert-danger > .alert-close:hover{
            color: red;
        }
    </style>
    <script type="text/javascript">

        /*Выбор зала*/
        var selected_year='';
        var time_lost = $('#s_time_lost').val();

        var film_id = "";
        var film_title = "";
        var film_long = "";
        var canWrite = false;

        $(document).ready(function(){
            $('.edit-year').click(function(){
                selected_year=$(this).val();
                console.log(selected_year);
                $('#s_date').click();
            });
            $('.edit-year').click();
            $('.get_f_id').click();
        });

        $(document).ready(function(){
            $('#s_date').click(function(){
                var date = $('#s_date').val();
                var hall = selected_year;
                time_lost = $('#s_time_lost').val();

                //console.log(date+","+hall);
                if(date!="" && hall!= ""){
                    $.post('/administrator/add/seanse',
                        {
                            s_date: date,
                            s_hall: hall
                        },
                        function(data){
                            $('#seansesList').empty();
                            $('#seansesList').append(data);
                        }
                    );
                }
            });
            $('.input-group-addon').click(function(){
                $('#s_date').click();
            });
        });

        $(document).ready(function () {
            $('div').click(function(){
                $('#autocomplete').hide();
            });
            $('a').click(function(){
                $('#autocomplete').hide();
            });

            $('#seansesList').delegate('.text-center > .free', 'click', function(){
                $('#s_time').val(this.text);
                calculate(film_long);
                checkTime($(this));
            });
            $('#seansesList').delegate('.text-center > .process', 'click', function(){
                $('#s_time').val(this.text);
                calculate(film_long);
                checkTime($(this));
            });

            $('#autocomplete').delegate('.get_f_id', 'click', function(){
                $('#searchField').val($(this).text());
                $('#searchField').attr('gotID', $(this).attr('f_id'));
                //Задаем время окончания
                film_id = $(this).attr('f_id');
                film_title = $(this).text();
                film_long = $(this).attr('f_long');

                calculate(film_long);
            });
            function calculate(end){
                //Задаем время окончания
                var t_begin = $('#s_time').val();
                
                var m1 = CountMinutes(t_begin);
                var m2 = CountMinutes(end);

                var tm = m1+m2;

                var hh = tm/60|0;
                var mm = tm%60;

                if(hh >= 24)
                    hh = hh - 24;
                if(hh < 10)
                    hh="0"+hh;

                $('#s_time_lost').val(hh+':'+mm);
                time_lost = $('#s_time_lost').val();
            }
            function checkTime(elem){
                $('.free').css('backgroundColor', '#EEE');
                $('.process').css('backgroundColor', '#FFC25D');

                var t_begin = elem.text();
                var t_end = $('#s_time_lost').val();
                var t1 = CountMinutes(t_begin);
                var t2 = CountMinutes(t_end);

                var booked = $('.process');
                var hasRed = false;

                var all = $('.text-center > a');
                if(elem.hasClass("free")){
                    elem.css('backgroundColor','green');
                }
                for(var i=0; i < all.length-1; i++){
                    var b = CountMinutes(all[i].text);
                    var e = CountMinutes(all[i+1].text);
                    var check1 = false;
                    for(j=t1;j<t2-30;j=j+30){
                        if(j>=b && j<=e){
                            if(all[i+1].className=="free"){
                                all[i+1].style.backgroundColor = "green";
                            }else{
                                all[i+1].style.backgroundColor = "red";
                                $('#error').removeClass('hide');
                                $('#completeing').addClass('hide');
                                hasRed = true;
                                canWrite = false;
                            }
                        }
                    }
                }
                if(hasRed==false){
                    $('#completeing').removeClass('hide');
                    $('#error').addClass('hide');
                    canWrite = true;
                }
            }
            function CountMinutes(string){
                var hh = string.slice(0,2);
                var mm = string.slice(3,6);
                total_min = Number(hh*60)+Number(mm);
                return total_min;
            }
        });
    /*Добавление данных*/
        $(document).ready(function () {
            $(".updateItem").click(function () {
                if(canWrite == true){
                    var s_date = $('#s_date').val();
                    var b_time = $('#s_time').val();
                    var e_time = $('#s_time_lost').val();

                    var s_film = $('#searchField').attr('gotID');
                    var s_hall = selected_year;

                    var href = $(this).attr("data");
                    //alert('Данные могут быть добавлены');
                    //console.log('date:'+s_date+'time:'+s_time+'id:'+s_film+'hall:'+s_hall);
                    $.post(
                        href,
                        {
                            s_date: s_date,
                            b_time: b_time,
                            e_time: e_time,
                            s_film: s_film,
                            s_hall: s_hall,
                        },
                        function(data){
                            if(data=="Такой сеанс уже существует!"){
                                //$(".alert-text").empty();

                            }else{
                                alert(data);
                                //location.reload();
                            }
                        }
                    );
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
    <div class='edit-content'>
        <div class='content-row '>
            <h3>Добавление сеанса</h3>
        </div>
        <div class='row'>
        <div class='content-row '>
            <div class='col-md-1'></div>
            <div class='col-md-2'>
                <p class=''>Дата сеанса:</p>
                <div class="form-group">
                    <div class="input-group date" id="datetimepicker1">
                        <input id='s_date' type="text" class="form-control" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>  
                <script type="text/javascript">
                    $(function () {
                        $('#datetimepicker1').datetimepicker(
                            {pickTime: false, language: 'ru'}
                        );
                        $("#datetimepicker1").data("DateTimePicker").setMinDate($('#datetimepicker1').data("DateTimePicker").getDate());
                    });
                </script>
            </div>
            <div class='col-md-2'>
                <p class=''>Зал:</p>
                <select class="form-control edit-year">
                    <?php foreach ($halls as $hallItem):?>
                        <?php 
                            echo "<option value='".$hallItem['id']."'>".$hallItem['number']."</option>";
                        ?>
                    <?php endforeach?>
                </select>
            </div>
            <div class='col-md-1'></div>
            <div class='col-md-2'>
                <div class="form-group">
                    <p>Время начала:</p>
                    <div class="input-group date" id="datetimepicker2">
                        <input id='s_time' type="text" class="form-control"  disabled='true'/>
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>  
                <script type="text/javascript">
                    $(function () {
                        $('#datetimepicker2').datetimepicker(
                            {pickDate: false, language: 'ru'}
                        );
                        //$("#datetimepicker2").data("DateTimePicker").setMinDate($('#datetimepicker2').data("DateTimePicker").getDate());
                    });
                </script>
            </div>
            <div class='col-md-2'>
                <div class="form-group">
                    <p>Время окончания:</p>
                    <div class="input-group date" id="datetimepicker3">
                        <input id='s_time_lost' type="text" class="form-control" disabled="true" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-info"></span>
                        </span>
                    </div>
                </div>  
            </div>
            <div class='col-md-2'></div>
        </div>
        </div>

        <div class='row' height='50px'></div>

        <div class='row'>
            <div class='col-md-1'></div>
            <div class='col-md-4'>
                <div class='warp'>
                    <p class='s_text'>Фильм:</p>
                    <?php include('/templates/moduls/autocomplete/autocomplete.php'); ?>
                </div>
            </div>
            <div class='col-md-4'>
                <div id='completeing' class="my-alert alert-success hide">
                    <span class='alert-text'>Вы можете назначить сеанс на это время</span>
                    <span class='alert-close'><i class='fa fa-times'></i></span>
                </div>
                <div id='error' class="my-alert alert-danger hide">
                    <span class='alert-text'>Вы не можете назначить сеанс на это время</span>
                    <span class='alert-close'><i class='fa fa-times'></i></span>
                </div>
            </div>
        </div>
        <div id='seansesList' class='row'>
        </div>
        <div class='row'>
            <nav class='text-center'>
                <button data="/administrator/create/seanse" class='btn btn-more updateItem'>Добавить</button>
            </nav>
        </div>
    </div>
</div>

<!--Footer-->
<?php include('/templates/components/footer/footer.php');?>



</body>
</html>
