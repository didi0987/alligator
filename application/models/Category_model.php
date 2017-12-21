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
    function update_Cate_by_id($cid,$category_name){

        $query="Update Article_category set category_name=? where category_id=?";
        return $this->db->query($query,array($category_name,$cid));
    }
    function delete_Cate_by_id($cid){
        $query="Delete from Article_category where category_id=?";
        return $this->db->query($query,array($cid));
    }

    function add_Cate_to_id($cid,$name,$level){

        $query="Insert into Article_category (category_name,category_level,category_belongTo)values (?,?,?) ";
        return $this->db->query($query,array($name,$level,$cid));
    }


}