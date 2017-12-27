<section id="about">


    <div class="row section-head">

        <div class="twelve columns">

            <h1><span><i class="fa fa-quote-left" aria-hidden="true"></i></span> <?=$cate_name?></h1>

            <hr />

        </div>

    </div> <!-- end section-head -->

    <div class="row">

        <div id="team-wrapper" class="bgrid-third s-bgrid-third tab-bgrid-half mob-bgrid-whole group">

            <?php
            //var_dump($content);
            foreach ($content as $key=>$value){
                $html=$value['content_html'];
                //$text=strip_tags($html);
                //$substr_text=mb_substr($text,0,150,'utf-8')."...";
                $doc = new DOMDocument();
                $doc->loadHTML($html);
                $xpath = new DOMXPath($doc);
                $src = $xpath->evaluate("string(//img/@src)");//get first image src in the article
                $href=base_url()."index.php/article/article_detail/".$value['article_id'];
                echo  sprintf('<div class="bgrid member">
                     <a href= "%s">
                    <div class="member-pic">
                    <img src="%s" alt=""/>
                     <div class="mask"></div>
                    </div>
                  <div class="member-name">
                    <h3>[%s] %s</h3>
                </div>
                </a>
            </div>',$href,$src,$value['category_name'],$value['content_title']);

            }
            ?>





            </div> <!-- end member -->


        </div> <!-- end team-wrapper -->

    </div> <!-- end row -->



</section> <!-- end about -->