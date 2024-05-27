<?php

class form extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->API = "https://api.aaslabs.com/web/user";
        $this->load->library('curl');
        $this->load->helper('url');


    }

}









?>