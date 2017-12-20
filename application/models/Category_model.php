<?php
/**
 * Created by PhpStorm.
 * User: chenxiaowang
 * Date: 12/20/17
 * Time: 3:17 AM
 */
class Category_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function get_Child_Cates_by_id($cid){

        $query="SELECT category_id,category_name FROM Article_category where category_belongTo=? ";
        return $this->db->query($query,array($cid))->result_array();
    }
    function get_Cate_by_id($cid){

            $query="Select * from  Article_category where category_id=?";
            return $this->db->query($query,array($cid))->result_array();



    }

}