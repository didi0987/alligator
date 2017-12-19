<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Responstable 2.0: a responsive table solution</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>res/css/back_list.css">

  
</head>

<body>
<h1>文章列表</h1>
<table class="responstable">
  
  <tr>
    <th>文章ID</th>
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
                <?=$meta['article_display']; ?></p>
            </td>
            <td>
                <a href="<?=base_url()?>index.php/back_Home/edit_panel/<?=$meta['article_id']?>"><i class="fa fa-pencil" aria-hidden="true"></i> 修改 </a>
                <?php if($meta['article_display']==1){?>
                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i> 隐藏 </a>
                <?} else {?>
                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i> 显示 </a>
                <?}?>


            </td>

        </tr>
    <?php } ?>

  
</table>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js'></script>

  
</body>
</html>
