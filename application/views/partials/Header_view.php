

<!-- header
==================================================-->




<header>
    <a href="<?=base_url()?>index.php"><img class="logo" src="<?=base_url()?>res/images/logoH.png"></a>
</header>

<a href="#" class="nav-button"><i class="fa fa-bars" aria-hidden="true"></i></a>

<nav class="nav">

    <ul>

        <li class="nav-submenu"><a>话题</a>
            <ul>

                <?php
                //print "全部";
                echo sprintf (" <li><a href='%s'>%s</a></li>",base_url().'index.php/Article/topics/0',"全部");
                foreach($topics as $key=>$value)
                {

                    echo sprintf (" <li><a href='%s'>%s</a></li>",base_url().'index.php/Article/topics/'.$value['category_id'],$value['category_name']);
                }

                ?>
            </ul>
        </li>

        <li class="nav-submenu"><a>项目</a>
            <ul class="longer">
                <?


                echo sprintf("<li class='l2'>全部项目</li><div class='wrap2'><li><a href='%s'>全部项目</a></li></div>",base_url().'index.php/Article/projects/0');

                foreach($projects as $key=>$sub_project)
                {
                    echo "<div class='oneline'>";
                    echo sprintf("<div class='wrap1'><li class='l2'>%s</li></div>",$sub_project[0]);
                    echo "<div class='wrap2'>";

                    foreach($sub_project[1] as $key=>$value){

                        echo sprintf("<li><a href='%s'>%s</a></li>",base_url().'index.php/Article/projects/'.$value['category_id'],$value['category_name']);

                    }

                    echo "</div>";
                    echo "</div>";

                }
                ?>
            </ul>
        </li>
        <li class="nav-submenu"><a href="#">导师</a></li>
        <li class="nav-submenu"><a href="#">加入</a>
            <ul>
                <?php

                foreach($joins as $key=>$value)
                {

                    echo sprintf (" <li><a href='%s'>%s</a></li>",$value['category_id'],$value['category_name']);
                }

                ?>
            </ul>
        </li>

    </ul>
</nav>

<a href="#" class="nav-close">Close Menu</a>

<script src="<?=base_url()?>res/js/nav.jquery.min.js"></script>

<script>
    $('.nav').nav();
</script>

