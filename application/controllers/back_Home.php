<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class back_Home extends CI_Controller {

    public function index()
    {
        $this->load->view('back/back_Home_view');
    }

    public function create_panel()
    {
        $this->load->view('back/back_Article_create_view');
    }
/*
 * Insert Content->Insert Meta using same Content Ref,get Article_ID->Insert Category
 * */
    public function create()
    {
    $this->load->model('Article_model');
    $content_title=$this->input->post("content_title");
    $content_html=$this->input->post("content_html");
    //the display date is not the create or last update date. Display date is only used to show after "发表于:" at front end.
        //So display date can be modified to any date and this makes easier for editor to show fake dates when needed.
    $content_displayDate=$this->input->post("content_displayDate");
    $article_category_l1=$this->input->post("article_category_l1");
    $article_category_l2=$this->input->post("article_category_l2");
    $article_category_l3=$this->input->post("article_category_l3_array");
    $article_author="Hello World";
    $article_length=$this->input->post("content_length");
    //ref is used to link content and article.
    $content_ref=uniqid("01");
    date_default_timezone_set('Asia/Shanghai');
    $createDate=date("Y-m-d");
    $createTime=date("H:i:s");
    $this->Article_model->insert_Article_content($content_ref,$content_title,$content_html,$content_displayDate);
        /*When create an article, lastUpdate Date/Time is same as create Date/Time */
        $article_id=$this->Article_model->insert_Article_meta($createDate,$createTime,$createDate,$createTime,$article_author,$article_length,$content_ref);
        if($article_id){
            //there is Lv 3 categories
            if(sizeof($article_category_l3)>0){

                foreach ($article_category_l3 as $key=>$value){
                    $this->Article_model->insert_Article_category($article_id,$article_category_l1,'',$value);
                }
                echo $article_id;
            }
            else{
                $this->Article_model->insert_Article_category($article_id,$article_category_l1,$article_category_l2,'');
                echo $article_id;
            }

        }
        else{

            echo "0000";
        }
    }
    public function alist(){
        $this->load->model('Article_model');
        return $this->Article_model->list_Article_meta(0);

    }

    public function get($article_id){

        $this->load->model('Article_model');
        $res=$this->Article_model->get_Article_Meta_Content_by_id($article_id);
        /* convert JSON so that Chinese characters can be displayed*/
        foreach ( $res[0] as $key => $value ) {
            if($key=="content_html"){

                $value=htmlspecialchars($value);
            }
            $res[0][$key] = urlencode ( $value );

        }
        echo urldecode ( json_encode($res[0]));

    }

    public function edit_panel($article_id){


        $l3=$this->get_l3($article_id);
        $l2=$this->get_l2($article_id);
        $data=array('article_id'=>$article_id,'l3'=>$l3,'l2'=>$l2);
        $this->load->view('back/back_Article_edit_view',$data);
    }

    public function switch_display($article_id){

        $this->load->model('Article_model');
        $res=$this->Article_model->get_Article_displayStatus($article_id);
        $currentDisplay=$res[0]['article_display'];
        switch ($currentDisplay){

            case "1":
                $this->Article_model->update_Article_displayStatus($article_id,"0");
                break;
            case "0":
                $this->Article_model->update_Article_displayStatus($article_id,"1");
                break;
        }




    }
    public function alist_panel(){
        $data['metas']=$this->alist();
        $this->load->view('back/back_Article_list_view',$data);

    }

    public function update($article_id){
        $this->load->model('Article_model');
        $lastUpdateTime= date("H:i:s");
        $lastUpdateDate= date("Y-m-d");
        $article_length=$this->input->post('article_length');
        $content_title=$this->input->post('content_title');
        $content_html=$this->input->post('content_html');
        $content_displayDate=$this->input->post('content_displayDate');
        $article_category_l1=$this->input->post("article_category_l1");
        $article_category_l2=$this->input->post("article_category_l2");
        $article_category_l3=$this->input->post("article_category_l3_array");
        try{
            //first remove the categories
            $this->remove_article_cates($article_id);
            $this->Article_model->update_Article_Meta_by_id($article_id,$lastUpdateDate,$lastUpdateTime,$article_length);
            $this->Article_model->update_Article_Content_by_id($article_id,$content_title,$content_html,$content_displayDate);
            if(sizeof($article_category_l3)>0){

                foreach ($article_category_l3 as $key=>$value){
                    $this->Article_model->insert_Article_category($article_id,$article_category_l1,'',$value);
                }

            }
            else{
                $this->Article_model->insert_Article_category($article_id,$article_category_l1,$article_category_l2,'');

            }
            echo '0';
        }catch(Exception $e){
            echo $e->getMessage();
        }

    }
    /*详细参见wangEditor文档上传图片*/
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

    public function  get_l3($aid){
        $this->load->model('Category_model');
        $res=$this->Category_model->get_Cates_by_id($aid);
        if($res){
            $ret=array();
            foreach($res as $key=>$value){
                array_push($ret,$value['article_category_l3']);
            }
            return json_encode($ret);

        }else{
            return "[]";
        }

    }
    public function  get_l2($aid){
        $this->load->model('Category_model');
        $res=$this->Category_model->get_Cates_by_id($aid);
        if($res){
            return $res[0]['article_category_l2'];
        }
        else{
            return "4";
        }

    }
    public function remove_article_cates($aid){
        $this->load->model('Category_model');
        $res=$this->Category_model->delete_Article_Cates_by_id($aid);
    }
}