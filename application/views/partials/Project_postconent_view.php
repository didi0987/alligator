<section id="about">


    <div class="row section-head">

        <div class="twelve columns">

            <h1>相关项目</h1>



        </div>

    </div> <!-- end section-head -->

    <div class="row">

        <div id="team-wrapper" class="bgrid-fourth s-bgrid-fourth tab-bgrid-half mob-bgrid-whole group">

            <?php
            //var_dump($content);
            foreach ($related as $key=>$value){
                //related excludes self
                if($value['article_id']!=$article[0]['article_id'])
                {
                $html=$value['content_html'];
                $doc = new DOMDocument();
                $doc->loadHTML($html);
                $xpath = new DOMXPath($doc);
                $src = $xpath->evaluate("string(//img/@src)");//get first image src in the article
                $href=base_url()."index.php/article/article_detail/".$value['article_id'];
                echo  sprintf('<div class="bgrid member">
                     <a href= "%s">
                    <div class="member-pic">
                    <img src="%s" alt=""/>
               
                    </div>
                  <div class="member-name">
                    <h5>[%s] %s</h5>
                </div>
                </a>
            </div>',$href,$src,$value['category_name'],$value['content_title']);
                }
            }
            ?>





            </div> <!-- end member -->

        </div> <!-- end team-wrapper -->

    <?=$links?>
    </div> <!-- end row -->



</section> <!-- end about -->