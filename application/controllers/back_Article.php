<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class back_Article extends CI_Controller {

    public function index()
    {
        $this->load->view('back/back_Article_create_view');
    }

    public function create()
    {
    $this->load->model('Article_model');
    $content_title=$this->input->post("content_title");
    $content_html=$this->input->post("content_html");
    $content_displayDate=$this->input->post("content_displayDate");
    $article_category=$this->input->post("article_category");
    $article_author="Hello World";
    $article_length=$this->input->post("content_length");
    echo "aa".$article_length;
    //ref is used to link content and article.
    $content_ref=uniqid("01");
    date_default_timezone_set('Asia/Shanghai');
    $createDate=date("Y-m-d");
    $createTime=date("H:i:s");
    $res=$this->Article_model->create_Article_content($content_ref,$content_title,$content_html,$content_displayDate);
    if($res>0){

        $this->Article_model->create_Article_meta($createDate,$createTime,$createDate,$createTime,$article_author,$article_length,$content_ref,$article_category);
    }
    else{

        echo 'something wrong in creating new article!';
    }



    }
}