<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $getattrb = $this->ElibraryDB->getattrb();
        foreach ($getattrb as $value) {
            $sess_array = array(
                'title' => $value->title,
                'background' => $value->background);
        }
        $this->session->set_userdata($sess_array);
    }

    public function page_missing() {
        $this->load->view('errors/page_missing');
    }

}
