<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Список годов | Администрирование | Starlight</title>
    <?php include('/templates/css/all_styles.php');?>

    <link href="/templates/administratorComponents/header/header.css" rel="stylesheet">
    <script src=""></script>

    <link href="/views/administrator/listStyles.css" rel="stylesheet">
    <style type="text/css">
    </style>
    <script type="text/javascript">
    var sort  = 'year';
    var arrow = 'ASC';
//Сортировка по полям
    $(document).ready(function(){

        var n = true;
        $('th a').click(function(){

            if(n){
                sort = 'year';
                arrow = 'ASC';
                n = false;
            }else{
                sort = 'year';
                arrow = 'DESC';
                n = true;
            }
            $.post(
                '/administrator/years',
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
//Удаление года
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
                        <a href="/administrator/add/year">Добавить</a>
                    </li>
                    <li class=''>
                        <a href="#" data-toggle='dropdown' >Удалить</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id='list-container' class='container '>
	<div class='table-responsive admin-content'>
        <table class="table table-hover content-table">
            <tr id='thead' class='thead-c'>
                <th class='l_column'></th>
                <th><a href='#' data-toggle='dropdown'>Год</a></th>
                <th class="remove-column"><a href='#' data-toggle='dropdown'>Удалить</th>
            </tr>
            <?php foreach ($yearList as $yearItem):?>
                <tr class='sort'>
                    <td class='l_column'>
                        <div class="mycheckbox">
                            <label>
                                <input type="checkbox" class='check' value="<?php echo $yearItem['id']?>">
                            </label>
                        </div>
                    </td>
                    <td class=''>
                        <a href='#' data-toggle='dropdown'><?php echo $yearItem['year'];?></a>
                    </td>
                    <td class='remove-column'>
                        <a href='#' link='/administrator/remove/Year/<?php echo $yearItem['id'];?>' data-toggle='dropdown' class='remove-record'><i class='fa fa-trash'></i></a>
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
