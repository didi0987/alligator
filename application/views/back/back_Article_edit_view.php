<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

    <!--- basic page needs
    ================================================== -->
    <title>Hello World Backend</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
==================================================Q -->
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


</head>

<body>

<div class="article_wrap">
    <h1>修改文章</h1>
    <label>文章标题: </label>
    <div><input type="text" id="article_title" size="80" value=""></div>
    <div><label>发表于: </label><input type="text" id="article_date"></div>
    <div>
        <label>一级分类: </label>
        <select id="category_l1">
            <option value="1">话题</option>
            <option value="2">项目</option>
        </select>
    </div>

    <div id="category_l2_wrap">
        <label>二级分类: </label>
        <select id="category_l2">

        </select>
    </div>

    <div class="project_wrap">
        <label>项目分类: </label>
        <div id="project_section">

        </div>
    </div>
    <div style="padding: 15px 0; color: #ccc"></div>
    <div id="editor"></div>
    <div style="padding: 5px 0; color: #ccc"></div>
    <div id="editor_input">


    </div>
    <button id="update" class="button">修改</button>
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
        var data=$('#editor_input').html();
        $("#preview").css('display','block')
        $("#preview_wrap").html('');
        var title=$('#article_title').val();

        $("#preview_wrap").append('<div id="article_title">'+title+'</div>');
        $("#preview_wrap").append(data);

    }, false)
//Close Preview
    document.getElementById('preview_close').addEventListener('click', function (e) {

        $("#preview").hide();

    }, false)
//Update. Post to BackEnd
    document.getElementById('update').addEventListener('click', function (e) {

        var r=confirm("确认提交?");
        if(r==true){
        var url='<?=base_url()?>index.php/back_Home/update/<?=$article_id?>';
        var content_title=$('#article_title').val();//get article title
        var content_html=editor.txt.html();//get content
        var content_length=editor.txt.text().length;//get length of the content
        var content_displayDate=$('#article_date').val();
        console.log(content_displayDate)
        var category_l1=$('#category_l1').val();
        var category_l2=$('#category_l2').val();
        var category_l3 = $('input[name=category_l3]:checked').map(function() {
                return this.value;
            }).get();
        $.post( url, { content_title: content_title ,content_html: content_html, content_displayDate:content_displayDate,article_category_l1:category_l1,article_category_l2:category_l2,article_category_l3_array:category_l3,content_length:content_length })
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
        var selectCategory_id2=0;
        var url='<?=base_url()?>index.php/back_Category/children_cates/'+selectCategory_id;
        $.post( url)
            .success(function( data ) {
                var cates=JSON.parse(data);
                selectCategory_id2=appendL2Option(cates);

            }).done(function(data){
            //after Category_l2 is populated, populate Category_l3 with the first option
            //only "项目" is selected, the Lv 3 options are able to be selected. "话题" has no Lv 3 categories.
            switch (selectCategory_id){
                case '1':{
                    $('#category_l2_wrap').show();
                    $('.project_wrap').hide();
                    break;
                }
                case '2':{
                    $('#category_l2_wrap').hide();
                    $('#project_section').empty();
                    $('.project_wrap').show();


                    var url='<?=base_url()?>index.php/back_Category/children_cates/2';
                    $.post(url)
                        .success(function( data ) {
                            var cates3=JSON.parse(data);
                            $.each(cates3,function(key,value){
                                var url2='<?=base_url()?>index.php/back_Category/children_cates/'+cates3[key]['category_id'];
                                $.post(url2).success(function(data){
                                    var data=JSON.parse(data);
                                    var title=cates3[key]['category_name'];
                                    var checked_l3=<?=$l3?>;
                                    appendL3Option(title,data,checked_l3);
                                }).done(function(){

                                })
                            })
                        });
                }
            }
        });

    }, false)

    /*Category Level 2 click to change*/
    /*
    document.getElementById('category_l2').addEventListener('change', function (e) {

        var selectCategory_id=$('#category_l2').val();
        var url='<?=base_url()?>index.php/back_Category/children_cates/'+selectCategory_id;
        $.post( url)
            .success(function( data ) {
                var cates=JSON.parse(data);
                appendL3Option(cates);
            });
    },false)
*/

    $( document ).ready(function() {

        /*set inital content*/
        $.get( "<?=base_url()?>index.php/back_Home/get/<?=$article_id?>", function( data ) {
            //console.log(data);
            var json =JSON.parse( data );
       /*set display date*/
            $('#article_date').val(json.content_displayDate);
        /*********/
            $('#article_title').val(json.content_title);
            //decode special html character in json
           var html=(jQuery('<div />').html(json.content_html).text())
            editor .txt.html(html);

        });

        /*set initial Category*/
        $('.project_wrap').hide();
        var selectCategory_id=$('#category_l1').val();
        var url='<?=base_url()?>index.php/back_Category/children_cates/'+selectCategory_id;
        var select_l2=<?=$l2?>;
        $.post( url)
            .success(function( data ) {
                var cates=JSON.parse(data);
                appendL2Option(cates,select_l2);
            });
        /*********/
    });
    /*add options to Category_l2 dropdown */
    function appendL2Option(cates,select_l2){
        $("#category_l2").empty();
        $.each(cates,function(key,value){
            if(cates[key]['category_id']==select_l2){
                var append="<option selected=selected value="+cates[key]['category_id']+">"+cates[key]['category_name']+"</option>"
            }
            else
            {
                var append="<option value="+cates[key]['category_id']+">"+cates[key]['category_name']+"</option>"
            }

            $('#category_l2').append(append);
        })
        return cates[0]['category_id'];

    }
    /*add options to Category_l3 checkbox */
    function appendL3Option(title,cates,check_l3){

        var append="<div class='project_subsection'><div class='title'>"+title+"</div>";
        $.each(cates,function(key,value){
            var category_id=cates[key]["category_id"];
            //if category is selected  ,check the checkbox
            if($.inArray(category_id,check_l3)>-1){
                append+='<input type="checkbox" checked name="category_l3" value='+category_id+'>'+cates[key]['category_name'];
            }
            else
            {
                append+='<input type="checkbox"  name="category_l3" value='+category_id+'>'+cates[key]['category_name'];
            }

        })
        append+="</div>";
        $('#project_section').append(append);

    }

    function get_checked_cates_l3(){
        var ret;

       //return ret;
    }
</script>
