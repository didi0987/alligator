<?php
/**
 * Created by PhpStorm.
 * User: chenxiaowang
 * Date: 12/20/17
 * Time: 12:16 AM
 */

class back_Category extends CI_Controller
{

    public function index(){

        show_404();
    }

    public function category1($category_id){
        $this->load->model('Category_model');
        $cates=$this->Category_model->get_Child_Cates_by_id($category_id);
        $res=$this->Category_model->get_Cate_by_id($category_id);
        $name=$res[0]['category_name'];
        $data=array('cid'=>$category_id,'cates'=>$cates,'l1_name'=>$name);

        $this->load->view('back/back_Category_view',$data);
    }
}