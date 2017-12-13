<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class back_Article extends CI_Controller {

    public function index()
    {
        $this->load->view('back/back_Home_view');
    }
}