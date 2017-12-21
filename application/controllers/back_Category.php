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
        $level=$res[0]['category_level'];
        $data=array('cid'=>$category_id,'cates'=>$cates,'l1_name'=>$name,'level'=>$level);

        $this->load->view('back/back_Category_view',$data);
    }

    public function change($cid){
        $this->load->model('Category_model');
        $category_name=$this->input->post('category_name');
        $this->Category_model->update_Cate_by_id($cid,$category_name);
    }

    public function delete($cid){
        $this->load->model('Category_model');

        $this->Category_model->delete_Cate_by_id($cid);
    }
    public function add($cid){

        $this->load->model('Category_model');
        $level=$this->input->post('level');
        $name=$this->input->post('category_name');
        $this->Category_model->add_Cate_to_id($cid,$name,$level);

    }
    public function children_cates($cid){
        $this->load->model('Category_model');
        $res=$this->Category_model->get_Child_Cates_by_id($cid);
        /* convert JSON so that Chinese characters can be displayed*/
        foreach ( $res as $key => $value ) {
            $res[$key]['category_name'] = urlencode ( $res[$key]['category_name'] );
        }
        echo urldecode ( json_encode($res));
        //echo json_encode($res);
    }
}