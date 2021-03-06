

<section id="services">

    <div class="row section-head">

        <div class="twelve columns">

            <h1><span><i class="fa fa-quote-left" aria-hidden="true"></i> </span><?=$cate_name?></h1>

            <hr />

        </div>

    </div> <!-- end section-head -->

    <div class="row mobile-no-padding">

        <div class="service-list s-bgrid-half tab-bgrid-whole group">
            <?php
            //var_dump($content);
            foreach ($content as $key=>$value){
                $html=$value['content_html'];
                $text=strip_tags($html);
                $substr_text=mb_substr($text,0,80,'utf-8')."...";//display first 80 charactors as descriptions
                $doc = new DOMDocument();
                $doc->loadHTML($html);
                $xpath = new DOMXPath($doc);
                $src = $xpath->evaluate("string(//img/@src)");//get first image src in the article
                $href=base_url()."index.php/article/article_detail/".$value['article_id'];
                echo  sprintf('<div class="bgrid">
                     <a href= "%s">
                    <div><img src="%s"></div>
                    <div class="service-title"><h3>[%s] %s</h3></div> 
                    <div class="service-author">发表于: %s | %s</div>
                    <div class="service-content">
                        <p>
                        %s
                        </p>
                    </div>
                      
                </a>
            </div>',$href,$src,$value['category_name'],$value['content_title'],$value['content_displayDate'],$value['article_author'],$substr_text);

            }
            ?>

                <?=$links?>



        </div> <!-- end service-list -->

    </div> <!-- end row -->

</section> <!-- end services -->
