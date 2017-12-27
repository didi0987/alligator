<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

    public function topics($cid){
        $cate_name="最新话题";
       $this->load->model('Article_model');
       $this->load->model('Category_model');
       $this->load->library('pagination');
       $page_size=2;
       $config['base_url']=site_url('index.php/Article/topics/'.$cid);
       $config['total_rows']=50;
       $config['per_page']=$page_size;
       $this->pagination->initialize($config);
       $links=$this->pagination->create_links();
       $offset=intval($this->uri->segment(4));

       $res=$this->Article_model->get_Topics_by_Cate($cid,$offset,$page_size);
        //0 is all topics
       if(!$cid=='0'){
           $cate=$this->Category_model->get_Cate_by_id($cid);
           $cate_name=$cate[0]['category_name'];
       }

       $header_data=$this->load_Header_data();
       $content_data=array('cate_name'=>$cate_name,'content'=>$res);
        //load_partials pass the partials name to layout in /partials, so that the layout can render
        $load_partials=array('pre_content_partial_name'=>'','content_partial_name'=>'Topics_view','post_content_partial_name'=>'');
        //var_dump($res);
        $data=array_merge(array('links'=>$links),$header_data,$content_data,$load_partials);
        $this->load->view("layout/Layout_view",$data);

    }

    public function projects($cid){
        $cate_name="最新项目";
        $this->load->model('Article_model');
        $this->load->model('Category_model');
        $res=$this->Article_model->get_Projects_by_Cate($cid);
        if(!$cid=='0'){
            $cate=$this->Category_model->get_Cate_by_id($cid);
            $cate_name=$cate[0]['category_name'];
        }
        $header_data=$this->load_Header_data();
        $content_data=array('cate_name'=>$cate_name,'content'=>$res);
        //load_partials pass the partials name to layout in /partials, so that the layout can render
        $load_partials=array('pre_content_partial_name'=>'Project_precontent_View','content_partial_name'=>'Projects_view','post_content_partial_name'=>'');
        //var_dump($res);
        $data=array_merge($header_data,$content_data,$load_partials);
        $this->load->view("layout/Layout_view",$data);

    }
    public function article_detail($aid){

        $this->load->model('Article_model');
        $article=$this->Article_model->get_Article_Meta_Content_by_id($aid);
        $header_data=$this->load_Header_data();
        $content_data=array('article'=>$article);
        //load_partials pass the partials name to layout in /partials, so that the layout can render
        $load_partials=array('pre_content_partial_name'=>'Project_precontent_View','content_partial_name'=>'Article_view','post_content_partial_name'=>'');
        //var_dump($res);
        $data=array_merge($header_data,$content_data,$load_partials);
        $this->load->view("layout/Layout_view",$data);

    }


    public function load_Header_data(){


        $topics=$this->get_Categories(1);//Get Topic Lv 2 Categories
        $projects=array();
        $projects_lv2=$this->get_Categories(2);//Get Project Lv 3 Categories
        $joins=$this->get_Categories(3);//Get Join Categories
        foreach($projects_lv2 as $key=>$value){

            $name1=$value['category_name'];
            $projects_lv3=$this->get_Categories($value['category_id']);
            $tmp_array=[$name1,$projects_lv3];
            array_push($projects,$tmp_array);
        }

        $data=array('topics'=>$topics,'projects'=>$projects,'joins'=>$joins);
        return $data;
    }
    public function get_Categories($cid){
        $this->load->model('Category_model');
        $cates=$this->Category_model->get_Child_Cates_by_id($cid);
        return $cates;

    }
    public  function get_Article_by_id($article_id)
    {
        $data=array('article'=>"文章加载错误!");
        $this->load->model('Article_model');
        if(!$article_id){
            show_404();
        }else
        {
            $result=$this->Article_model->get_Article_Meta_Content_by_id($article_id);
            $data['article']=$result;
        }
        //subview data only need to be passed to layout and the subview is able to get. Does not require second pass to the subview
        $this->load->view('layout/Layout_view',$data);

    }



}


?>

