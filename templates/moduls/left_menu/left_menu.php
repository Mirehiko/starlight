<div class='left_menu'>
    <ul id="accordion">
        <li><a href="/">Главная</a></li>
        <li><a href="/catalog/">Каталог</a></li>
        <li class='dropdown'>
            <a href="#" class='dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>По жанрам</a>
            <ul class='submenu'>
            <?php foreach ($genres as $genreItem):?>
                <li>
                <a href="/genre/<?php echo $genreItem['id'];?>" class="<?php if($genreItem['id']==$genreId){ echo 'genre_selected';}?>">
                <?php echo $genreItem['name'];?>
                </a>
                </li>
                <?php 
                    if($genreItem['id']==$genreId){
                        echo "<script>$('#accordion ul:eq(0)').show();</script>";
                    }
                ?>
            <?php endforeach?>

            </ul>
        </li>
        <li class='dropdown'>
            <a href="#" class='dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>По годам</a>
            <ul class='submenu'>
            <?php foreach ($years as $yearItem):?>
                <li>
                <a href="/year/<?php echo $yearItem['id'];?>" class="<?php if($yearItem['id']==$year){ echo 'genre_selected';}?>">
                <?php echo $yearItem['year'];?>
                </a>
                </li>
                <?php 
                    if($yearItem['id']==$year){
                        echo "<script>$('#accordion ul:eq(1)').show();</script>";
                    }
                ?>
            <?php endforeach?>
            </ul>
        </li>
    </ul>
    <!--<ul id="accordion1">
        <li><a href="/">Главная</a></li>
        <li><a href="/catalog/">Каталог</a></li>
    </ul>-->
</div>