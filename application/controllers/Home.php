<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * This is the front end main controller
	 *
	 * Maps to the following URL
	 * 		http://180.76./index.php/Home

	 */

	public function index()
	{
        $this->load->view('Home_view');

	}

	public  function article($article_id)
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
