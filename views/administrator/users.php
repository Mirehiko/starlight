<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Пользователи | Администрирование | Starlight</title>
    <?php include('/templates/css/all_styles.php');?>

    <link href="/templates/administratorComponents/header/header.css" rel="stylesheet">
    <script src=""></script>

    <link href="/views/administrator/listStyles.css" rel="stylesheet">
    <style type="text/css">

    </style>
    <script type="text/javascript">
    var sort  = 'username';
    var arrow = 'ASC';
//Сортировка по полям
    $(document).ready(function(){

        var n = true, f = false, e = false;
        $('th a').click(function(){
            var s = $(this).attr('sort');
            console.log(s);
            switch(s){
                case 'sort_name':{
                    if(n){
                        sort = 'username';
                        arrow = 'DESC';
                        n = false;
                    }else{
                        sort = 'username';
                        arrow = 'ASC';
                        n = true;
                    }
                    f = false; e = false;
                    break;
                }
                case 'sort_free':{
                    if(f){
                        sort = 'freedom';
                        arrow = 'DESC';
                        f = false;
                    }else{
                        sort = 'freedom';
                        arrow = 'ASC';
                        f = true;
                    }
                    n = false; e = false;
                    break;
                }
                case 'sort_email':{
                    if(e){
                        sort = 'email';
                        arrow = 'DESC';
                        e = false;
                    }else{
                        sort = 'email';
                        arrow = 'ASC';
                        e = true;
                    }
                    f = false; n = false;
                    break;
                }
                case 'sort_pass':{
                    break;
                }
                default:{
                    break;
                }
            }
            $.post(
                '/administrator/users',
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
//Удаление пользователя
    $(document).ready(function() {
        $('table').delegate(".check","change", function(){
            if($(this).prop("checked")){
                var element = $(this).val();
                $.post(
                    '/administrator/remove/user/'+$(this).val(),
                    {
                        sort:  sort,
                        arrow: arrow
                    },
                    function(data){
                        $('.sort').remove();
                        $('#thead').after(data);
                        console.log(data);
                    }
                );
            } else{
                //alert('Отпустил');
            }

        });
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
                        <a href="/administrator/add/user" >Добавить</a>
                    </li>
                    <li class=''>
                        <a href="/administrator/edit/user" >Изменить</a>
                    </li>
                    <li class=''>
                        <a href="#" >Удалить</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id='list-container' class='container '>
    <div class='table-responsive admin-content'>
        <table id='tablehead' class="table table-hover content-table">
            <tr id='thead' class='thead-c'>
                <th>
                    <!--<div id='selectAll' class="mycheckbox">
                        <label>
                            <input type="checkbox">
                        </label>
                    </div>-->
                </th>
                <th><a href="#" sort='sort_name' data-toggle='dropdown'>Имя пользователя</a></th>
                <th><a href="#" sort='sort_free' data-toggle='dropdown'>Категория</a></th>
                <th><a href="#" sort='sort_email' data-toggle='dropdown'>Email</a></th>
                <th><a href="#" sort='sort_pass' data-toggle='dropdown'>Пароль</a></th>
                <th class="remove-column"><a href='#' data-toggle='dropdown'>Удалить</th>
            </tr>
        <!--</table>
        <table id='sort' class="table table-hover content-table">-->
            <?php foreach ($userList as $userItem):?>
                <tr class='sort'>
                    <td>
                        <div class="mycheckbox">
                            <label>
                                <input type="checkbox" class='check' value="<?php echo $userItem['id']?>">
                            </label>
                        </div>
                    </td>
                    <!--<td><a href='#'><?php //echo $userItem['id'];?></a></td>-->
                    <td>
                        <a href="/administrator/edit/user/<?php echo $userItem['id'];?>">
                        <?php echo $userItem['username'];?>
                        </a>
                    </td>
                    <td><a href='#' data-toggle='dropdown'>
                        <?php foreach ($freedoms as $freeItem):?>
                            <?php
                                if($freeItem['id'] == $userItem['freedom']){
                                    echo $freeItem['name'];
                                }
                            ?>
                        <?php endforeach?>
                    </a></td>
                    <td><a href='#' data-toggle='dropdown'><?php echo $userItem['email'];?></a></td>
                    <td><a href='#' data-toggle='dropdown'><?php echo $userItem['password'];?></a></td>
                    <td class='remove-column'>
                        <a href='#' link='/administrator/remove/user/<?php echo $userItem['id'];?>' data-toggle='dropdown' class='remove-record'><i class='fa fa-trash'></i></a>
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
