<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Hello World 后台</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>res/css/back_layout.css" />
    <!--jQuery Library baidu CDN -->
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>

</head>
<body>
<div id="container">
  <div id="header">
    <h1>Hello World 后台</h1>
  </div>
  <div id="wrapper">
    <div id="content">

        <object name="panel" type="text/html" style="width:100%;min-height:1500px;" data=""></object>

    </div>
  </div>

      <aside class="sidebar">
          <div id="leftside-navigation" class="nano">
              <ul class="nano-content">
                  <li>
                      <a href="index.html"><i class="fa fa-tags"></i><span>分类管理</span></a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:void(0);"><i class="fa fa-text-height"></i><span>文章管理</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                      <ul>

                          <li><a href="<?=base_url()?>/index.php/back_Article/create_panel" target="panel">新建文章</a>
                          </li>
                          <li><a href="ui-panels.html">修改文章</a>
                          </li>
                          <!--
                          <li><a href="ui-buttons.html">Buttons</a>
                          </li>
                          <li><a href="ui-slider-progress.html">Sliders &amp; Progress</a>
                          </li>
                          <li><a href="ui-modals-popups.html">Modals &amp; Popups</a>
                          </li>
                          <li><a href="ui-icons.html">Icons</a>
                          </li>
                          <li><a href="ui-grid.html">Grid</a>
                          </li>
                          <li><a href="ui-tabs-accordions.html">Tabs &amp; Accordions</a>
                          </li>
                          <li><a href="ui-nestable-list.html">Nestable Lists</a>
                          </li>-->
                      </ul>
                  </li>

              </ul>
          </div>
      </aside>



  <div id="footer">

  </div>
</div>
<script type="text/javascript">
    $("#leftside-navigation .sub-menu > a").click(function(e) {
        $("#leftside-navigation ul ul").slideUp(), $(this).next().is(":visible") || $(this).next().slideDown(),
            e.stopPropagation()
    })
</script>
</body>
</html>
