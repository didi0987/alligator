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

    <!--jQuery Library baidu CDN -->
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>

    <!-- favicons
     ================================================== -->
    <link rel="shortcut icon" href="favicon.png" >

</head>

<body>
<div class="article_wrap">
    <h1>新建文章</h1>
    <label>文章标题: </label>
    <div><input type="text" id="article_title" size="80" value="默认标题"></div>
    <div><label>发表于: </label><input type="text" id="article_date"></div>
    <div><label>一级分类: </label><select id="category_l1">
            <option value="1">话题</option>
            <option value="2">项目</option>
        </select></div>

    <div><label>二级分类: </label><select id="category_l2">

        </select></div>

    <div><label>项目分类: </label>
        <input type="checkbox" name="category_l3"   value="13">上海
        <input type="checkbox" name="category_l3" value="14">广州
    </div>
    <div style="padding: 15px 0; color: #ccc"></div>
    <div id="editor"></div>
    <div style="padding: 5px 0; color: #ccc"></div>
    <div id="editor_input">
    <p>开始编辑文章...</p>

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
    editor.customConfig.debug = location.href.indexOf('wangeditor_debug_mode=1') > 0
    editor.customConfig.uploadImgServer = '<?=base_url()?>index.php/back_Home/uploadImg';
    editor.customConfig.uploadFileName ='file';
    editor.create()

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

        var r=confirm("确认提交?");
        if(r==true){
            var url='<?=base_url()?>index.php/back_Home/create';
            var content_title=$('#article_title').val();//get article title
            var content_html=editor.txt.html();//get content
            var content_length=editor.txt.text().length;//get length of the content
            var content_displayDate=$('#article_date').val();
            var category_l1=$('#category_l1').val();
            var category_l2=$('#category_l2').val();
            $.post( url, { content_title: content_title ,content_html: content_html, content_displayDate:content_displayDate,article_category_l1:category_l1,article_category_l2:category_l2,content_length:content_length })
                .success(function( data ) {
                    if(data=='0'){
                        alert("提交成功!");
                    }else{
                        alert("提交失败!");
                    }
                });
        }

    }, false)
    //Category Level 1 click to change
    document.getElementById('category_l1').addEventListener('change', function (e) {
        var selectCategory_id=$('#category_l1').val();
        var url='<?=base_url()?>index.php/back_Category/children_cates/'+selectCategory_id;
        $.post( url)
            .success(function( data ) {
                var cates=JSON.parse(data);
                appendOption(cates);


            });

    }, false)


    $("input:checkbox[name=category_l3]:checked").each(function () {
        console.log(" Value: " + $(this).val());
    });

    function appendOption(cates){
        $("#category_l2").empty();
        $.each(cates,function(key,value){
            var append="<option value="+cates[key]['category_id']+">"+cates[key]['category_name']+"</option>"
            $('#category_l2').append(append);
        })
    }

    $(function() {

        /*set display date*/
        var a = document.getElementById("article_date");
        var d = new Date();
        /*********/

        /*set initial Category*/
        $('#article_date').val(d.getFullYear()+"-"+d.getMonth()+'-'+d.getDate());
        var selectCategory_id=$('#category_l1').val();
        var url='<?=base_url()?>index.php/back_Category/children_cates/'+selectCategory_id;
        $.post( url)
            .success(function( data ) {
                var cates=JSON.parse(data);
                appendOption(cates);
            });
        /*********/
    });

</script>
