<?php
/**
 * Created by PhpStorm.
 * User: chenxiaowang
 * Date: 12/24/17
 * Time: 5:04 AM
 */

class Nimda extends CI_Controller
{


    public function index(){

        $this->load->view('pc');
    }
    public function good($pc){
        $correct="2018hw232";

        if($pc==$correct){

            $this->load->library('session');
            $this->session->set_userdata(array('pc'=>$correct));
            redirect('index.php/back_Home');
        }
        else{

            redirect('index.php/Nimda');
        }
    }
}