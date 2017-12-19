<?php


class Article_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function insert_Article_meta($createDate,$createTime,$lastUpdateDate,$lastUpdateTime,$article_author,$article_length,$content_ref){
        $data = array(

            'article_createDate' => $createDate,
            'article_createTime' => $createTime ,
            'article_lastUpdateDate' => $lastUpdateDate,
            'article_lastUpdateTime' => $lastUpdateTime,
            'article_author' =>$article_author,
            'article_length' =>$article_length,
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

        $query="SELECT content_title,content_html,content_displayDate FROM Article_meta a,Article_content where a.article_content_ref=Article_content.content_ref AND a.article_id=".$article_id;
        $res=$this->db->query($query)->result_array();
        if(!$res){
            show_404();
        }
        return $res;
    }
    function update_Article_Meta_by_id($article_id,$lastUpdateDate,$lastUpdateTime,$article_length){

        $sql = "Update Article_meta Set article_lastUpdateDate=?, article_lastUpdateTime=?,article_length=? where article_id=?";
        $this->db->query($sql, array($lastUpdateDate, $lastUpdateTime, $article_length,$article_id));
    }
    function update_Article_Content_by_id($article_id,$content_title,$content_html,$content_displayDate){
        $sql = "Update Article_content c inner join Article_meta a on c.content_ref=a.article_content_ref Set content_title=?, content_html=?,content_displayDate=? where article_id=?";
        $this->db->query($sql, array($content_title, $content_html, $content_displayDate,$article_id));
    }

}

?>
