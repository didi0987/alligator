<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pla_info
 *
 * @author chenxiao
 */
class Article_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function create_Article_meta($createDate,$createTime,$lastUpdateDate,$lastUpdateTime,$article_author,$article_length,$content_ref,$article_category){
        $data = array(
           // 'article_article_id' => $article_id,
            'article_createDate' => $createDate,
            'article_createTime' => $createTime ,
            'article_lastUpdateDate' => $lastUpdateDate,
            'article_lastUpdateTime' => $lastUpdateTime,
            'article_author' =>$article_author,
            'article_length' =>$article_length,
            'article_category' => $article_category,
            'article_content_ref' => $content_ref

        );
        return $this->db->insert('Article_meta', $data);
    }

    function create_Article_content($content_ref,$content_title,$content_html,$content_displayDate){
        $data = array(
            'content_ref'=>$content_ref,
            'content_title' => $content_title ,
            'content_html' => $content_html,
            'content_displayDate' => $content_displayDate
        );

        return $this->db->insert('Article_content', $data);
    }

    function list_Article_meta($pageNumber){

        $query="SELECT article_id,content_title,article_createDate,article_lastUpdateDate,article_display FROM Article_meta join Article_content where Article_meta.article_content_ref=Article_content.content_ref order by article_lastUpdateDate ";
        return $this->db->query($query)->result_array();

    }

}

?>
