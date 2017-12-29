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

    function list_Article_meta($offset,$pagesize){

        $query="SELECT article_id,content_title,article_createDate,article_lastUpdateDate,article_display FROM Article_meta join Article_content where Article_meta.article_content_ref=Article_content.content_ref order by article_lastUpdateDate DESC,article_lastUpdateTime DESC LIMIT $offset,$pagesize";
        return $this->db->query($query)->result_array();

    }
    function update_Article_Meta_by_id($article_id,$lastUpdateDate,$lastUpdateTime,$article_length){

        $query = "Update Article_meta Set article_lastUpdateDate=?, article_lastUpdateTime=?,article_length=? where article_id=?";
        $this->db->query($query, array($lastUpdateDate, $lastUpdateTime, $article_length,$article_id));
    }
    function update_Article_Content_by_id($article_id,$content_title,$content_html,$content_displayDate){
        $sql = "Update Article_content c inner join Article_meta a on c.content_ref=a.article_content_ref Set content_title=?, content_html=?,content_displayDate=? where article_id=?";
        $this->db->query($sql, array($content_title, $content_html, $content_displayDate,$article_id));
    }
    function update_Article_displayStatus($article_id,$status){
        $query="Update Article_meta Set article_display=? where article_id=?";
        $this->db->query($query,array($status,$article_id));
    }
    function get_Article_displayStatus($article_id){
        $query="Select article_display from  Article_meta where article_id=?";
        return $this->db->query($query,array($article_id))->result_array();

    }
    function get_Article_Meta_Content_by_id($article_id){

        $query="SELECT * FROM Article_meta a,Article_content,Article_to_Category c where a.article_content_ref=Article_content.content_ref AND a.article_id=c.article_id AND a.article_id=".$article_id;
        $res=$this->db->query($query)->result_array();
        if(!$res){
            show_404();
        }
        return $res;
    }
    function get_Topics_by_Cate($cid,$offset,$pagesize){
        if($cid=='0')//全部
        {
            $query="Select * from Article_meta a,Article_Content b,Article_Category c,Article_to_Category d where a.article_content_ref=b.content_ref AND d.article_id=a.article_id AND d.article_category_l2=c.category_id AND a.article_display=1  ORDER BY a.article_lastUpdateDate DESC,a.article_lastUpdateTime DESC limit $offset,$pagesize ";
        }
        else{
        $query="Select * from Article_meta a,Article_Content b,Article_Category c,Article_to_Category d where a.article_content_ref=b.content_ref AND d.article_id=a.article_id AND d.article_category_l2=c.category_id AND d.article_category_l2=? AND a.article_display=1 ORDER BY a.article_lastUpdateDate DESC,a.article_lastUpdateTime DESC limit $offset,$pagesize ";
            }

        return $this->db->query($query,array($cid))->result_array();

    }

    function get_Projects_by_Cate($cid,$offset,$pagesize){
        if($cid=='0')//全部
        {
            $query="Select a.article_id,b.content_title,c.category_name,b.content_html from Article_meta a,Article_Content b,Article_Category c,Article_to_Category d where a.article_content_ref=b.content_ref AND d.article_id=a.article_id AND d.article_category_l3=c.category_id AND a.article_display=1 group by a.article_id ORDER BY a.article_lastUpdateDate DESC,a.article_lastUpdateTime DESC LIMIT $offset,$pagesize";
        }
        else{
            $query="Select a.article_id,b.content_title,c.category_name,b.content_html from Article_meta a,Article_Content b,Article_Category c,Article_to_Category d where a.article_content_ref=b.content_ref AND d.article_id=a.article_id AND d.article_category_l3=c.category_id AND d.article_category_l3=? AND a.article_display=1 group by a.article_id ORDER BY a.article_lastUpdateDate DESC,a.article_lastUpdateTime DESC LIMIT $offset,$pagesize";
        }
        return $this->db->query($query,array($cid))->result_array();
    }


}

?>
