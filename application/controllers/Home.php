<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * This is the front end main controller
	 *
	 * Maps to the following URL
	 * 		http://180.76.152.48/index.php/Home

	 */

	public function index()
	{


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

        $this->load->view('Home_view',$data);


	}



    public function get_Categories($cid){
        $this->load->model('Category_model');
        $cates=$this->Category_model->get_Child_Cates_by_id($cid);
        return $cates;

    }
}
