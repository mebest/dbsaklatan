<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Elogin extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($this->session->userdata('admin_logged_in')) {
            redirect('ElibrarySystem', 'refresh');
        } else {
            $this->load->view('includes/headers/header-login');
            $this->load->view('Administrator/signin');
            $this->load->view('includes/footers/footer-login');
        }
       
    }

    public function verify_login() {

        $this->form_validation->set_rules('user_login', 'Username', 'trim|required');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required|callback_database_access');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('includes/headers/header-login');
            $this->load->view('Administrator/signin');
            $this->load->view('includes/footers/footer-login');
        } else {
            redirect('ElibrarySystem', 'refresh');
        }
    }

    public function database_access() {
        $username = $this->input->post('user_login');
        $password = $this->input->post('user_password');
        $result = $this->LoginDB->login($username);
       
        $val = array('online_status' => 1);
        $trancDate = array("mm" => date('m'), "dd" => date('d'), 'yr' => date('Y'), "tm" => date("h:iA"));
        $trancID = $trancDate['mm'] . '/' . $trancDate['dd']  . '/' . $trancDate['yr'] . '&nbsp;' . $trancDate['tm'];
        
        if ($result) {
            foreach ($result as $value) {
                $stat = $value->status;
                $AccStat = $value->Account_Status;
                $data = array(
                    'password' => $value->password
                );
                
                $datas = array('student_num' => $value->student_num,
                            'name' => $value->full_name,
                            'grade' => $value->grade,
                            'date' => $trancID);
                            $logsd = $this->LoginDB->getlog();
           
            }
            if ($this->bcrypt->check_password($password, $data['password'])) {
                foreach($logsd as $teds){
                    $d = array('logsd' => $teds->log);
                    
                }
                 $nlog = "".$datas['name']."&nbsp;-&nbsp;".$datas['date']." - Login&#13;&#10;";
                $text = $nlog.$d['logsd'];
                $send = array('log' => $text);
                if ($stat == 1) {
                    if ($AccStat == 'Active') {
                        $sess_array = array(
                            'id' => $value->user_id,
                            'username' => $value->username,
                            'status' => $value->status,
                            'last_login_timestamp' => time(),
                            'title' => 'DBS - Elibrary'
                        );
                        
                        $this->LoginDB->timestamp($send);
                        $this->LoginDB->onlogin($val, $username);
                        $this->session->set_userdata('admin_logged_in', $sess_array);
                        $this->session->set_userdata($sess_array);
                        return TRUE;
                    }
                    if ($AccStat == 'Deactivate') {
                        $this->form_validation->set_message('database_access', 'Your Account has been Diactivated, Please Ask for Autorized Assistance.');
                        return false;
                    }
                } elseif ($stat == 2) {
                    if ($AccStat == 'Active') {
                        $sess_array = array(
                            'id' => $value->user_id,
                            'username' => $value->username,
                            'status' => $value->status,
                            'last_login_timestamp' => time(),
                            'title' => 'DBS - Elibrary'
                        );
                        $this->LoginDB->timestamp($send);
                        $this->LoginDB->onlogin($val, $username);
                        $this->session->set_userdata('admin_logged_in', $sess_array);
                        $this->session->set_userdata($sess_array);
                        return TRUE;
                    }
                    if ($AccStat == 'Deactivate') {
                        $this->form_validation->set_message('database_access', 'Your Account has been Diactivated, Please Ask for Autorized Assistance.');
                        return false;
                    }
                } elseif ($stat == 3) {
                    if ($AccStat == 'Active') {
                        $sess_array = array(
                            'id' => $value->user_id,
                            'username' => $value->username,
                            'status' => $value->status,
                            'grade' => $value->grade,
                            'user' => $value->full_name,
                            'std_num' => $value->student_num,
                            'last_login_timestamp' => time(),
                            'title' => 'DBS - Elibrary'
                        );

                        $this->LoginDB->timestamp($send);
                        $this->LoginDB->onlogin($val, $username);
                        $this->session->set_userdata('admin_logged_in', $sess_array);
                        $this->session->set_userdata($sess_array);
                        return TRUE;
                    }
                    if ($AccStat == 'Deactivate') {
                        $this->form_validation->set_message('database_access', 'Your Account has been Diactivated, Please Ask for Autorized Assistance.');
                        return false;
                    }

                } elseif ($stat == 4) {
                    if ($AccStat == 'Active') {
                        $sess_array = array(
                            'id' => $value->user_id,
                            'username' => $value->username,
                            'status' => $value->status,
                            'grade' => $value->grade,
                            'user' => $value->full_name,
                            'std_num' => $value->student_num,
                            'last_login_timestamp' => time(),
                            'title' => 'DBS - Elibrary'
                        );
                        
                        $this->LoginDB->timestamp($send);
                        $this->LoginDB->onlogin($val, $username);
                        $this->session->set_userdata('admin_logged_in', $sess_array);
                        $this->session->set_userdata($sess_array);
                        return TRUE;
                    }
                    if ($AccStat == 'Deactivate') {
                        $this->form_validation->set_message('database_access', 'Your Account has been Diactivated, Please Ask for Autorized Assistance.');
                        return false;
                    }
                    
                }else {
                    $this->form_validation->set_message('database_access', 'Username &#39 ' . $username . ' &#39 does not exist.');
                    return false;
                }
            } else {
                $this->form_validation->set_message('database_access', 'Wrong / Invalid Password');
                return false;
            }
        } else {
            $this->form_validation->set_message('database_access', 'Username &#39 ' . $username . ' &#39 does not exist.');
            return false;
        }
    }

}
