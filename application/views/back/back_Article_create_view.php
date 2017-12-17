<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Hello World Backend</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->

    <link rel="stylesheet" href="<?php echo base_url();?>res/css/back_main.css">
    <link rel="stylesheet" href="<?php echo base_url();?>res/css/article.css">
    <!--  <link rel="stylesheet" href="res/css/main.css">-->

    <!-- script
    ================================================== -->
    <script type="text/javascript" src="<?php echo base_url();?>res/js/wangEditor.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>res/js/back_main.js"></script>
    <!--jQuery Library baidu CDN -->
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>

    <!-- favicons
     ================================================== -->
    <link rel="shortcut icon" href="favicon.png" >

</head>

<body>
<div class="article_wrap">
    <label>文章标题: </label>
    <div><input type="text" id="article_title" size="80" value="默认标题"></div>
    <div><label>发表于: </label><input type="text" id="article_date"></div>
    <div><label>类型: </label><select id="article_category">
            <option value="1">活动</option>
            <option value="2">文章</option>
        </select></div>
    <div style="padding: 15px 0; color: #ccc"></div>
    <div id="editor"></div>
    <div style="padding: 5px 0; color: #ccc"></div>
    <div id="editor_input">
    <p>欢迎使用 <b>wangEditor</b> 富文本编辑器</p>
    <h1>欢迎使用 <b>wangEditor</b> 富文本编辑器</h1>
    </div>
    <button id="submit" class="button">提交</button>
    <button id="preview_btn" class="button">预览</button>
</div>

<div id="preview" class="preview">
    <button id="preview_close" class="button">关闭</button>
   <div id="preview_wrap"></div>
</div>
</body>
</html>
<script type="text/javascript">
    var E = window.wangEditor
    // var editor = new E('#editor')
    var editor = new E( document.getElementById('editor'), document.getElementById('editor_input'))
    editor.create()

    var a = document.getElementById("article_date");
    var d = new Date();
    $('#article_date').val(d.getFullYear()+"-"+d.getMonth()+'-'+d.getDate());
//Preview
    document.getElementById('preview_btn').addEventListener('click', function () {
        // 读取 html
        var data = editor.txt.html();
        $("#preview").css('display','block')
        $("#preview_wrap").html('');
        var title=$('#article_title').val();

        $("#preview_wrap").append('<div id="article_title">'+title+'</div>');
        $("#preview_wrap").append(data);

    }, false)
//Close Preview
    document.getElementById('preview_close').addEventListener('click', function (e) {

        $("#preview").css('display','none')

    }, false)
//Submit. Post to BackEnd
    document.getElementById('submit').addEventListener('click', function (e) {
        var url='<?=base_url()?>index.php/back_Article/create';
        var content_title=$('#article_title').val();
        var content_html=editor.txt.html();
        var content_length=editor.txt.text().length;
        var content_displayDate=$('#article_date').val();
        var article_category=$('#article_category').val();

        $.post( url, { content_title: content_title ,content_html: content_html, content_displayDate:content_displayDate,article_category:article_category,content_length:content_length })
            .done(function( data ) {
                console.log( "Data Loaded: " + data );
            });

    }, false)
</script>
<?php



echo "this is back home";


?>