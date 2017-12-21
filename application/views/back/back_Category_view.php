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
<h1><?=$level?> 级分类: <?=$l1_name?></h1>
<button id="add_btn" onclick="add_section()"><i class="fa fa-plus" aria-hidden="true"></i> 新增 </button>
<div id="add_section" style="display: none;">
<div>
    <input id="add" class="category" value=""></p>
    <!--add($level+1)  +1 indicate category added should be next level to the current category-->
    <button onclick="add(<?=$level+1?>)"><i class="fa fa-plus" aria-hidden="true"></i> 添加 </button></div>

</div>
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
            <input id='category_name<?=$cate['category_id']?>' class="category" value="<?=$cate['category_name']; ?>"></p>
        </td>

        <td>
            <span id="update" onclick="update(<?=$cate['category_id']?>)"><i class="fa fa-pencil" aria-hidden="true"></i> 修改 </span>
            <span id="update" onclick="remove(<?=$cate['category_id']?>)"><i class="fa fa-pencil" aria-hidden="true"></i> 删除 </span>
            <!-- Level 3 category should not be expended-->
            <?php if($level<2){?>
            <span><a href="<?=base_url()?>index.php/back_Category/category1/<?=$cate['category_id']?>"><i class="fa fa-expand" aria-hidden="true"></i> 展开 </a></span>
            <?}?>
        </td>

    </tr>
<?php } ?>


</table>
<script src='http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js'></script>


</body>
</html>
<script>
    function update(cid){

        var url='<?=base_url()?>index.php/back_Category/change/'+cid;
        var category_name=$('#category_name'+cid).val();
        $.post( url,{'category_name':category_name}).success(function( data ) {
            window.location.reload();
        });

    }
    function remove(cid){

        var url='<?=base_url()?>index.php/back_Category/delete/'+cid;
        //var category_name=$('#category_name'+cid).val();
        $.post( url).success(function( data ) {
            window.location.reload();
        });
    }

    function add(level){

        var url='<?=base_url()?>index.php/back_Category/add/'+<?=$cid ?>;
        var category_name=$('#add').val();
        $.post( url,{'category_name':category_name,'level':level}).success(function( data ) {
            window.location.reload();
        });
    }

    function add_section(){
        $('#add_section').css('display','block');
    }
</script>