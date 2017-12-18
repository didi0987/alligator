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
    function insert_Article_meta($createDate,$createTime,$lastUpdateDate,$lastUpdateTime,$article_author,$article_length,$content_ref){
        $data = array(
           // 'article_article_id' => $article_id,
            'article_createDate' => $createDate,
            'article_createTime' => $createTime ,
            'article_lastUpdateDate' => $lastUpdateDate,
            'article_lastUpdateTime' => $lastUpdateTime,
            'article_author' =>$article_author,
            'article_length' =>$article_length,
           // 'article_category' => $article_category,
            'article_content_ref' => $content_ref

        );
        $this->db->insert('Article_meta', $data);
        /*return last insert article_id */
        $query = $this->db->query('SELECT LAST_INSERT_ID()');
        $row = $query->row_array();
        return $row['LAST_INSERT_ID()'];

    }

    function insert_Article_category($article_id,$category_l1,$category_l2,$category_l3){

        $data=array(
            'article_id'=>$article_id,
            'article_category_l1'=>$category_l1,
            'article_category_l2' =>$category_l2,
            'article_category_l3' =>$category_l3

        );
        return $this->db->insert('Article_to_Category', $data);
    }

    function insert_Article_content($content_ref,$content_title,$content_html,$content_displayDate){
        $data = array(
            'content_ref'=>$content_ref,
            'content_title' => $content_title ,
            'content_html' => $content_html,
            'content_displayDate' => $content_displayDate
        );

        return $this->db->insert('Article_content', $data);
    }

    function list_Article_meta($pageNumber){

        $query="SELECT article_id,content_title,article_createDate,article_lastUpdateDate,article_display FROM Article_meta join Article_content where Article_meta.article_content_ref=Article_content.content_ref order by article_lastUpdateDate DESC ";
        return $this->db->query($query)->result_array();

    }

    function get_Article_Meta_Content_by_id($article_id){

        $query="SELECT content_title,content_html,content_displayDate,category_name FROM Article_meta ,Article_content,Article_category where Article_meta.article_content_ref=Article_content.content_ref AND Article_meta.article_category=Article_category.category_id  AND article_id=".$article_id;
        $res=$this->db->query($query)->result_array();
        if(!$res){
            show_404();
        }
        return $res;
    }

}

?>
