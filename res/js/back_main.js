
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
            console.log(cates[0]);
            appendOption(cates);
        });
    /*********/
});
