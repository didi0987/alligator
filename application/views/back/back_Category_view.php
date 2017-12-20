<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Hello World 后台</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>res/css/back_list.css">
    <link rel="stylesheet" href="<?php echo base_url();?>res/css/back_main.css">

    <!--jQuery Library baidu CDN -->
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>

</head>

<body>
<h1><?=$l1_name?></h1>
<button id="add"><i class="fa fa-plus" aria-hidden="true"></i> 新增 </button>
<table class="responstable">
  <tr>
      <th>分类编号</th>
    <th>分类名称</th>

    <th>操作</th>
  </tr>
    <?php foreach($cates as $cate) { ?>
    <tr>
        <td>
           <?=$cate['category_id']?>
        </td>
        <td>
            <input class="category" value="<?=$cate['category_name']; ?>"></p>
        </td>

        <td>
            <a href="<?=base_url()?>index.php/back_Category/edit_panel/<?=$cate['category_id']?>"><i class="fa fa-pencil" aria-hidden="true"></i> 修改 </a>
            <a href="<?=base_url()?>index.php/back_Category/edit_panel/<?=$cate['category_id']?>"><i class="fa fa-trash-o" aria-hidden="true"></i> 删除 </a>
            <a href="<?=base_url()?>index.php/back_Category/edit_panel/<?=$cate['category_id']?>"><i class="fa fa-expand" aria-hidden="true"></i> 展开 </a>
        </td>

    </tr>
<?php } ?>


</table>
<script src='http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js'></script>


</body>
</html>
<script>
    function switch_dispay(article_id){

        var url='<?=base_url()?>index.php/back_Home/switch_display/'+article_id;
        $.post( url).success(function( data ) {
            window.location.reload();
        });


    }

</script>