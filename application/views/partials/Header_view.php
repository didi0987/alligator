<!-- header
================================================== -->

<header>
    <nav id='cssmenu'>
        <div class="logo"><a href="index.html">Responsive </a></div>
        <div id="head-mobile"></div>
       <div class="button"><i class="fa fa-bars fa-3x" aria-hidden="true"></i> </div>
        <ul>
            <li><a href='#'>话题</a>
                <ul>

                        <?php

                         foreach($topics as $key=>$value)
                         {

                             echo sprintf (" <li><a href='1122'>%s</a></li>",$value['category_name']);
                         }

                        ?>


                </ul>
            </li>




            <li><a href='#'>项目</a>


                <ul>
                   <li> Product 1</li>
                    <?php

                    foreach($topics as $key=>$value)
                    {

                        echo sprintf (" <li><a href='1122'>%s</a></li>",$value['category_name']);
                    }

                    ?>
                   <li>Product 2</li>
                    <?php

                    foreach($topics as $key=>$value)
                    {

                        echo sprintf (" <li><a href='1122'>%s</a></li>",$value['category_name']);
                    }

                    ?>
                </ul>
            </li>
            <li><a href='#'>导师</a></li>
            <li><a href='#'>加入</a></li>
        </ul>

    </nav>
</header>
<!-- end header -->
<script>
    (function($) {
        $.fn.menumaker = function(options) {
            var cssmenu = $(this), settings = $.extend({
                format: "dropdown",
                sticky: false
            }, options);
            return this.each(function() {
                $(this).find(".button").on('click', function(){
                    $(this).toggleClass('menu-opened');
                    var mainmenu = $(this).next('ul');
                    if (mainmenu.hasClass('open')) {
                        mainmenu.slideToggle().removeClass('open');
                    }
                    else {
                        mainmenu.slideToggle().addClass('open');
                        if (settings.format === "dropdown") {
                            mainmenu.find('ul').show();
                        }
                    }
                });
                cssmenu.find('li ul').parent().addClass('has-sub');
                multiTg = function() {
                   // cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
                    cssmenu.find('.has-sub').on('click', function() {
                        $(this).toggleClass('submenu-opened');
                        if ($(this).find('ul').hasClass('open')) {
                            $(this).find('ul').removeClass('open').slideToggle();
                        }
                        else {
                            $(this).find('ul').addClass('open').slideToggle();
                        }
                    });
                };
                if (settings.format === 'multitoggle') multiTg();
                else cssmenu.addClass('dropdown');
                if (settings.sticky === true) cssmenu.css('position', 'fixed');
                resizeFix = function() {
                    var mediasize = 1000;
                    if ($( window ).width() > mediasize) {
                        cssmenu.find('ul').show();
                    }
                    if ($(window).width() <= mediasize) {
                        cssmenu.find('ul').hide().removeClass('open');
                    }
                };
                resizeFix();
                return $(window).on('resize', resizeFix);
            });
        };
    })(jQuery);

    (function($){
        $(document).ready(function(){
            $("#cssmenu").menumaker({
                format: "multitoggle"
            });
        });
    })(jQuery);

</script>