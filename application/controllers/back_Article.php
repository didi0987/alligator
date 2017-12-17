<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class back_Article extends CI_Controller {

    public function index()
    {
        $this->load->view('back/back_Home_view');
    }

    public function create_panel()
    {
        $this->load->view('back/back_Article_create_view');
    }

    public function create()
    {
    $this->load->model('Article_model');
    $content_title=$this->input->post("content_title");
    $content_html=$this->input->post("content_html");
    //the display date is not the create or last update date. Display date is only used to show after "发表于:" at front end.
        //So display date can be modified to any date and this makes easier for editor to show fake dates when needed.
    $content_displayDate=$this->input->post("content_displayDate");
    $article_category=$this->input->post("article_category");
    $article_author="Hello World";
    $article_length=$this->input->post("content_length");
    //ref is used to link content and article.
    $content_ref=uniqid("01");
    date_default_timezone_set('Asia/Shanghai');
    $createDate=date("Y-m-d");
    $createTime=date("H:i:s");
    $res=$this->Article_model->create_Article_content($content_ref,$content_title,$content_html,$content_displayDate);
    if($res>0){
        /*When create an article, lastUpdate Date/Time is same as create Date/Time */
        $this->Article_model->create_Article_meta($createDate,$createTime,$createDate,$createTime,$article_author,$article_length,$content_ref,$article_category);
    }
    else{

        echo 'something wrong in creating new article!';
    }
        
    }
    public function alist(){
        $this->load->model('Article_model');
        return $this->Article_model->list_Article_meta(0);

    }
    //TODO
    public function get($article_id){

    }
    //TODO
    public function edit_panel($article_id){

    }
    //TODO
    public function article($article_id){


    }
    public function hide($article_id){


    }
    public function alist_panel(){


        $data['metas']=$this->alist();
        var_dump($data);
        $this->load->view('back/back_Article_list_view',$data);

    }

    public function uploadImg()
    {

        try{
            $imgInfo = $_FILES['file'];
            // 图片名称
            $oldname = $imgInfo['name'];
            // 临时文件
            $tmp_name = $imgInfo['tmp_name'];
            // 错误信息
            $error = $imgInfo['error'];
            // 分割字符串，得到数组。
            $temp = explode(".",$oldname);
            // 用时间戳 + 文件后缀 重命名文件。
            $newname = time().".".$temp[count($temp)-1];

            $move_dir='./upload/img/article/'.date('Y-m-d');
            if(!file_exists($move_dir)){
                mkdir($move_dir,0777);
            }
            // 在服务上移动图片到指定目录。


            $server_url=$move_dir.'/'.$newname;
            move_uploaded_file($tmp_name,$server_url);
            // 返回图片路径，类似ajax的响应流程。

            $data=[base_url().'upload/img/article/'.date('Y-m-d').'/'.$newname];
            //var_dump($data);
            $errorno=0;
            $array=['errno'=>$errorno,'data'=>$data];
            echo json_encode($array);
        }catch (Exception $e){

            $errorno=1;
            $array=['errno'=>$errorno,'data'=>''];
            echo json_encode($array);
        }


    }
    
}