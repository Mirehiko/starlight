<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Сеансы | Администрирование | Starlight</title>
    <?php include('/templates/css/all_styles.php');?>

    <link href="/templates/administratorComponents/header/header.css" rel="stylesheet">
    <link href="/views/administrator/listStyles.css" rel="stylesheet">
    

    <style type="text/css">

    </style>
    <script type="text/javascript">
//Изменение состояния
    $(document).ready(function(){
        $('table').delegate('.state-link', 'click', function(){
            var state = $(this).attr('state');
            if(state == 'print'){
                $(this).attr('state', 'keep');
                $(this).empty();
                $(this).addClass('state-link_keep');
                $(this).removeClass('state-link_print');
                $(this).append("<span class='state-link__state-icon'><i class='fa fa-times'></i></span>");
                state = "keep";
            }else{
                $(this).attr('state', 'print');
                $(this).empty();
                $(this).addClass('state-link_print');
                $(this).removeClass('state-link_keep');
                $(this).append("<span class='state-link__state-icon'><i class='fa fa-check-square-o'></i></span>");
                state = "print";
            }
            var link = $(this).attr('link');
            $.post(
                link,
                {
                    status: state
                },
                function(data){
                    //console.log(data);
                }
            );
            
        });
    });
    var sort  = 'title';
    var arrow = 'ASC';
//Сортировка по полям
    $(document).ready(function(){

        var n = true, f = false;
        $('th a').click(function(){
            var s = $(this).attr('sort');
            console.log(s);
            switch(s){
                case 'sort_title':{
                    if(n){
                        sort = 'title';
                        arrow = 'DESC';
                        n = false;
                    }else{
                        sort = 'title';
                        arrow = 'ASC';
                        n = true;
                    }
                    f = false;
                    break;
                }
                case 'sort_producer':{
                    if(f){
                        sort = 'producer';
                        arrow = 'DESC';
                        f = false;
                    }else{
                        sort = 'producer';
                        arrow = 'ASC';
                        f = true;
                    }
                    n = false;
                    break;
                }
                default:{
                    break;
                }
            }
            $.post(
                '/administrator/films',
                {
                    sort:  sort,
                    arrow: arrow
                },
                function(data){
                    $('.sort').remove();
                    $('#thead').after(data);
                }
            );
        });
    });
//удаление
    $(document).ready(function() {
        $('table').delegate(".check","change", function(){
            if($(this).prop("checked")){
                var element = $(this).val();
                //alert(element);
                $.post(
                    '/administrator/remove/seanse/'+$(this).val(),
                    {
                        sort:  sort,
                        arrow: arrow
                    },
                    function(data){
                    $('.sort').remove();
                    $('#thead').after(data);
                    }
                );
            } else{
                alert('Отпустил');
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

<div class='container' id='action-menu'>
    <div class='navbar navbar-default' role='navigation'>
        <div class='container'>
            <div class='collapse navbar-collapse' id='admin-responsive-menu'>
                <ul class='nav navbar-nav'>
                    <li class=''>
                        <a href="/administrator/add/seanse" >Добавить сеанс</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id='list-container' class='container'>
    <div class='table-responsive admin-content'>
        <table class="table table-hover content-table">
            <tr id='thead' class='thead-c'>
                <th class='l_column'></th>
                <th><a href='#' state='sort_date' data-toggle='dropdown'>Дата</a></th>
                <th><a href='#' sort='sort_begin' data-toggle='dropdown'>Начало</a></th>
                <th><a href='#' sort='sort_end' data-toggle='dropdown'>Окончание</a></th>
                <th><a href='#' sort='sort_film' data-toggle='dropdown'>Фильм</a></th>
                <th><a href='#' sort='sort_hall' data-toggle='dropdown'>Зал</a></th>
                <th><a href='#' data-toggle='dropdown'></a></th>
            </tr>
            <?php if($seanseList!='В базе нет записей'):?>
            <?php foreach ($seanseList as $sItem):?>
            <tr class='sort'>
                <td>
                    <div class="mycheckbox">
                        <label>
                            <input type="checkbox" class='check' value="<?php echo $sItem['id']?>">
                        </label>
                    </div>
                </td>
                <td><a href="/administrator/edit/film/<?php echo $sItem['id'];?>"><?php echo $sItem['s_date'];?></a></td>
                <td><a href="#" data-toggle='dropdown'><?php echo $sItem['b_time'];?></a></td>
                <td><a href="#" data-toggle='dropdown'><?php echo $sItem['e_time'];?></a></td>
                <?php 
                    foreach ($filmList as $fItem) {
                       if($sItem['s_film']==$fItem['id']){
                        echo "<td><a href='#' data-toggle='dropdown'>".$fItem['title']."</a></td>";
                       }
                    }
                ?>
                
                <td><a href="#" data-toggle='dropdown'><?php echo $sItem['s_hall'];?></a></td>
                
            </tr>
        <?php endforeach?>
        <?php endif?>
        </table>
    </div>
</div>

<!--Footer-->
<?php include('/templates/components/footer/footer.php');?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/Bootstrap/js/salvattore.min.js"></script>
<script src="/Bootstrap/js/bootstrap.js"></script>

</body>
</html>
