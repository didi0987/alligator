<?php
/**
 * Created by PhpStorm.
 * User: chenxiaowang
 * Date: 12/20/17
 * Time: 12:16 AM
 */

class back_category extends CI_Controller
{
    public function __construct()
    {
        $this->load->model('Category_model');
    }

    public function index(){

        $this->load->view('');
    }
}