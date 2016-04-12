<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Фильмы | Администрирование | Starlight</title>
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

        var n = false, f = false, t = false, s = true;
        $('th a').click(function(){
            var str = $(this).attr('sort');
            console.log(str);
            switch(str){
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
                    t = false;
                    s = false;
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
                    t = false;
                    s = false;
                    break;
                }
                case 'sort_type':{
                    if(t){
                        sort = 'is_series';
                        arrow = 'DESC';
                        t = false;
                    }else{
                        sort = 'is_series';
                        arrow = 'ASC';
                        t = true;
                    }
                    f = false;
                    n = false;
                    s = false;
                    break;
                }
                case 'sort_state':{
                    if(s){
                        sort = 'status';
                        arrow = 'DESC';
                        s = false;
                    }else{
                        sort = 'status';
                        arrow = 'ASC';
                        s = true;
                    }
                    f = false;
                    t = false;
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
        $('table').delegate(".remove-record","click", function(){
        	var element = $(this).attr('link');
            console.log(element);
            if(confirm("Вы точно хотите удалить запись?")){
                $.post(
                    element,
                    {
                        sort:  sort,
                        arrow: arrow
                    },
                    function(data){
                    $('.sort').remove();
                    $('#thead').after(data);
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

<div class='container' id='action-menu'>
    <div class='navbar navbar-default' role='navigation'>
        <div class='container'>
            <div class='collapse navbar-collapse' id='admin-responsive-menu'>
                <ul class='nav navbar-nav'>
                    <li class=''>
                        <a href="/administrator/add/film" >Добавить фильм</a>
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
                <th><a href='#' sort='sort_state' data-toggle='dropdown'>Состояние</a></th>
                <th><a href='#' sort='sort_title' data-toggle='dropdown'>Фильм</a></th>
                <th><a href='#' sort='sort_producer' data-toggle='dropdown'>Режиссер</a></th>
                <th><a href='#' sort='sort_type' data-toggle='dropdown'>Тип</a></th>
                <th class="remove-column"><a href='#' data-toggle='dropdown'>Удалить</th>
            </tr>
            <?php foreach ($filmList as $filmItem):?>
        	<tr class='sort'>
        		<td>
					<div class="mycheckbox">
						<label>
							<input type="checkbox" class='check' value="<?php echo $filmItem['id']?>">
						</label>
					</div>
        		</td>
                <td>
                    <div class='btn-toolbar'>
                    <div class='btn-group'>
                    <?php 
                    if($filmItem['status'] == 1){
                        echo "
                        <button link='/administrator/change/film_status/".$filmItem['id']."' class='btn state-link state-link_print' state='print' data-toggle='dropdown' title='Публикуется'>
                            <span class='state-link__state-icon'><i class='fa fa-check-square-o'></i></span>
                        </button>
                        ";
                    }else{
                        echo "
                        <button link='/administrator/change/film_status/".$filmItem['id']."' class='btn state-link state-link_keep' state='keep' data-toggle='dropdown' title='Не публикуется'>
                            <span class='state-link__state-icon'><i class='fa fa-square-o'></i></span>
                        </button>
                        ";
                    }
                    ?>
                        <a href='/administrator/edit/film/<?php echo $filmItem['id'];?>' class='btn edit' title='Редактировать'>
                            <span class=''><i class='fa fa-pencil-square-o'></i></span>
                        </a>
                    </div>
                    </div>
                </td>
        		<td><a href="/administrator/edit/film/<?php echo $filmItem['id'];?>"><?php echo $filmItem['title'];?></a></td>
        		<td><a href="#" data-toggle='dropdown'><?php echo $filmItem['producer'];?></a></td>
                <?php 
                    if($filmItem['is_series']==1){
                        if($filmItem['is_anime']==1)
                            echo "<td><a href='#'' data-toggle='dropdown'>Аниме сериал</a></td>";
                        else
                            echo "<td><a href='#'' data-toggle='dropdown'>Сериал</a></td>";
                    }else{
                        if($filmItem['is_anime']==1)
                            echo "<td><a href='#'' data-toggle='dropdown'>Аниме фильм</a></td>";
                        else
                            echo "<td><a href='#'' data-toggle='dropdown'>Фильм</a></td>";
                    }
                ?>
                <td class='remove-column'>
                    <a href='#' link='/administrator/remove/film/<?php echo $filmItem['id'];?>' data-toggle='dropdown' class='remove-record'><i class='fa fa-trash'></i></a>
                </td>
        	</tr>
            <?php endforeach?>
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
