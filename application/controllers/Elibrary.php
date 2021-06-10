<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Elibrary extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $getattrb = $this->ElibraryDB->getattrb();
        foreach ($getattrb as $value) {
            $sess_array = array(
                'title' => $value->title);
        }
        $this->session->set_userdata($sess_array);
    }

    public function index() {
        $sliders = $this->SystemDB->home_sliders();
        $welcome = $this->SystemDB->home_welcome();
        $data = array('slider' => $sliders, 'welcome' => $welcome);
        $this->load->view('index/index', $data);
    }
}
