<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Hello World 后台</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>res/css/back_list.css">

    <!--jQuery Library baidu CDN -->
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
  
</head>

<body>
<h1>文章列表</h1>
<table class="responstable">
  
  <tr>
    <th>文章编号</th>
    <th>文章标题</th>
    <th>发布日期</th>
      <th>上次修改日期</th>
      <th>是否显示</th>
    <th>操作</th>
  </tr>

    <?php foreach($metas as $meta) { ?>
        <tr>
        <td>
            <?=$meta['article_id']; ?></p>
        </td>
            <td>
                <?=$meta['content_title']; ?></p>
            </td>
            <td>
                <?=$meta['article_createDate']; ?></p>
            </td>
            <td>
                <?=$meta['article_lastUpdateDate']; ?></p>
            </td>
            <td>
                <?  if($meta['article_display']){echo "是";} else{ echo "否";} ?></p>
            </td>
            <td>
                <a href="<?=base_url()?>index.php/back_Home/edit_panel/<?=$meta['article_id']?>"><i class="fa fa-pencil" aria-hidden="true"></i> 修改 </a>
                <?php if($meta['article_display']==1){?>
                    <span id="switch_display" onclick="switch_dispay(<?=$meta['article_id']?>)"><i class="fa fa-eye-slash" aria-hidden="true"></i> 隐藏 </span>
                <?} else {?>
                    <span id="switch_display" onclick="switch_dispay(<?=$meta['article_id']?>)"> <i class="fa fa-eye-slash" aria-hidden="true"></i> 显示 </span>
                <?}?>


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