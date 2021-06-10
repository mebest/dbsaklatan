<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ElibrarySystem extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if($this->config->item('sess_expiration') == "0"){
            $this->logout();
        }
    }

    public function index() {
        $this->load->view('includes/headers/header-preloader');
        $this->load->view('includes/preloader_home');
        $this->load->view('includes/footers/footer-preloader');
    }

    public function landing_page() {
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $id = $this->session->userdata('id');
            
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));
            $sliders = $this->SystemDB->home_sliders();
            $welcome = $this->SystemDB->home_welcome();
            $announce = $this->SystemDB->eventann();
            $news = $this->SystemDB->eventnews();
            $approve = $this->SystemDB->approvecount();
            $denied = $this->SystemDB->deniedcount();
            $catalog = $this->SystemDB->catalogcount();
            $students = $this->SystemDB->studentscount();
            $educators = $this->SystemDB->educatorscount();
            $ann = $this->SystemDB->anncount();
            $newsc = $this->SystemDB->newscount();
            
            $trancDate = array("mm" => date('m'), "dd" => date('d'), 'yr' => date('Y'));
        $trancID = $trancDate['mm'] . '/' . $trancDate['dd']  . '/' . $trancDate['yr'];
            $newrequest = $this->SystemDB->newrequestebook($trancID);
            $newrequestphys = $this->SystemDB->newrequestphys($trancID);

            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                    'std' => $value->student_num,
                );
            }
            
            
            $getChat = $this->SystemDB->getChatSts();
            if($getChat == null){
                $newchat = '';
            }else{
                $newchat = '<span class="mif-mail mif-ani-ring mif-ani-slow fg-red">'.$getChat.'</span>';
            }
            
            $getStdChat = $this->SystemDB->getStdChatSts($data['std']);
            if($getStdChat == null){
                $newstdchat = '';
            }else{
                $newstdchat = '<span class="mif-mail mif-2x mif-ani-shake mif-ani-slow fg-red"></span>';
            }

            if ($data['status'] == 1) {
                $stat['status'] = 'Administrators';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li>
                                <li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li>
                                <li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }
            

        $parent_data = array('newphys' => $newrequestphys,'newrequest' => $newrequest,'newsc' => $newsc,'ann' => $ann,'educators' => $educators,'students' => $students,'catalog' => $catalog,'newstdchat' => $newstdchat,'newchat' => $newchat,'user_log' => $data, 'approve' => $approve, 'denied' => $denied,'online' => $online, 'stat' => $stat, 'send' => $send, 'slider' => $sliders, 'welcome' => $welcome, 'announce' => $announce, 'news' => $news);

        if(isset($_GET['logout'])){ 
     
    //Simple exit message
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'><i>User ". $_SESSION['name'] ." has left the chat session.</i><br></div>");
    fclose($fp);
}

            if($data['status'] == 1){
            $this->load->view('includes/headers/header', $parent_data);
            $this->load->view('Administrator/Dashboard', $parent_data);
            $this->load->view('includes/footers/footer');
        }elseif($data['status'] == 2){
            $this->load->view('includes/headers/header', $parent_data);
            $this->load->view('Administrator/Dashboard', $parent_data);
            $this->load->view('includes/footers/footer');
        }else{
            $this->load->view('includes/headers/header-student', $parent_data);
            $this->load->view('Student/Dashboard', $parent_data);
            $this->load->view('includes/footers/footer-subaccounts', $parent_data); 

        }
        } else {
            redirect('Elogin', 'refresh');
        }
    }

    public function accounts(){
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));

            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }
            
            $getChat = $this->SystemDB->getChatSts();
            if($getChat == null){
                $newchat = '';
            }else{
                $newchat = '<span class="mif-mail mif-ani-ring mif-ani-slow fg-red">'.$getChat.'</span>';
            }

            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }

            $parent_data = array('newchat' => $newchat,'user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send);

            $this->load->view('includes/headers/header', $parent_data);
            $this->load->view('Administrator/Accounts', $parent_data);
            $this->load->view('includes/footers/footer');
        } else {
            redirect('Elogin', 'refresh');
        }
    }

    public function catalog(){
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));

            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }
            
            $getChat = $this->SystemDB->getChatSts();
            if($getChat == null){
                $newchat = '';
            }else{
                $newchat = '<span class="mif-mail mif-ani-ring mif-ani-slow fg-red">'.$getChat.'</span>';
            }

            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }

            $parent_data = array('newchat' => $newchat,'user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send);

            if($data['status'] == 1){
            $this->load->view('includes/headers/header', $parent_data);
            $this->load->view('Administrator/Catalog', $parent_data);
            $this->load->view('includes/footers/footer');
        }elseif($data['status'] == 2){
            $this->load->view('includes/headers/header', $parent_data);
            $this->load->view('Administrator/Catalog', $parent_data);
            $this->load->view('includes/footers/footer');
        }else{
            redirect('ElibrarySystem/landing_page', 'refresh');
        }
        } else {
            redirect('Elogin', 'refresh');
        }
    }
    
    
    public function book_catalog(){
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));

            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }
            
            $getChat = $this->SystemDB->getChatSts();
            if($getChat == null){
                $newchat = '';
            }else{
                $newchat = '<span class="mif-mail mif-ani-ring mif-ani-slow fg-red">'.$getChat.'</span>';
            }

            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }

            $parent_data = array('newchat' => $newchat,'user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send);

            if($data['status'] == 3){
            $this->load->view('includes/headers/header-student', $parent_data);
            $this->load->view('Student/Catalog', $parent_data);
            $this->load->view('includes/footers/footer-student');
        }elseif($data['status'] == 4){
            $this->load->view('includes/headers/header-student', $parent_data);
            $this->load->view('Student/Catalog', $parent_data);
            $this->load->view('includes/footers/footer-student');
        }else{
            redirect('ElibrarySystem/landing_page', 'refresh');
        }
        } else {
            redirect('Elogin', 'refresh');
        }
    }
    
    public function catalog_liststudent(){
        $fetch = $this->SystemDB->catalog_items();
        foreach ($fetch as $key => $value) {
            if($value['copies'] == 0){
                $status = '<span class="tag bg-lightRed fg-white">Onloan</span>';
                $color = 'fg-indigo';
                $dis = '';
            }else{
                $status = '<span class="tag bg-lightGreen fg-white">Available</span>';
                $color = 'fg-white';
                $dis = '';
            }
            if($value['book_cover'] == NULL){
                    $cover = 'N/A';
                }else{
                    $cover = '<img alt="Home Slide" src="' . base_url('' . $value['book_cover'] . '') . '" style="width: 150px;"/>';
                }
            $result['data'][$key] = array(
                '' . $value['id'] . '',
                $cover,
                '' . $value['callno'].'',
                '' . $value['accession'] . '',
                '' . $value['title'] . '',
                '' . $value['location'] . '',
                '' . $value['author'] . '',
                '' . $value['edition'] . '',
                '' . $value['copies'] . '',
                '' . $value['type'] . '',
                $status
            );
        }echo json_encode($result);
    }

    public function catalog_list(){
        $fetch = $this->SystemDB->catalog_items();
        foreach ($fetch as $key => $value) {
            if($value['copies'] == 0){
                $status = '<span class="tag bg-lightRed fg-white">Onloan</span>';
                $color = 'fg-indigo';
                $dis = '';
            }else{
                $status = '<span class="tag bg-lightGreen fg-white">Available</span>';
                $color = 'fg-white';
                $dis = '';
            }
            if($value['book_cover'] == NULL){
                    $cover = 'N/A';
            }else{
                    $cover = '<img alt="Home Slide" src="' . base_url('' . $value['book_cover'] . '') . '" style="width: 150px;"/>';
            }
            if($value['type'] == 'Phys.B'){
                $link = 'book';
            }elseif($value['type'] == 'E-Book'){
                $link = 'book';
            }elseif($value['type'] == 'AV'){
                $link = 'AVmaterials';
            }else{
                $link = '';
            }
            $result['data'][$key] = array(
                '' . $value['id'] . '',
                $cover,
                '' . $value['callno'].'',
                '' . $value['accession'] . '',
                '' . $value['title'] . '',
                '' . $value['location'] . '',
                '' . $value['author'] . '',
                '' . $value['edition'] . '',
                '' . $value['copies'] . '',
                '' . $value['type'] . '',
                $status,
                '<a href="'.$link.'?access='.$value['access'].'"><span class="mif-enter"'
                . 'title="View Book"></span></a></br><a href="viewbook?file=../resources/'.$value['accession'].'.pdf" target="_blank"><span class="mif-file-text"'
                . 'title="View PDF"></span></a>'
            );
        }echo json_encode($result);
    }
    
    public function material_list(){
        $fetch = $this->SystemDB->material_items();
        foreach ($fetch as $key => $value) {
            if($value['quantity'] == 0){
                $status = '<span class="tag bg-lightRed fg-white">Onloan</span>';
                $color = 'fg-indigo';
                $dis = '';
            }else{
                $status = '<span class="tag bg-lightGreen fg-white">Available</span>';
                $color = 'fg-white';
                $dis = '';
            }
            if($value['image'] == NULL){
                    $cover = 'N/A';
            }else{
                    $cover = '<img alt="Home Slide" src="' . base_url('' . $value['image'] . '') . '" style="width: 150px;"/>';
            }
            $result['data'][$key] = array(
                '' . $value['id'] . '',
                $cover,
                '' . $value['accession'] . '',
                '' . $value['equipment_id'] . '',
                '' . $value['dop'] . '',
                '' . $value['manufacture'] . '',
                '' . $value['description'] . '',
                '' . $value['format'] . '',
                $status,
                '<a href="AVmaterials?access='.$value['access'].'"><span class="mif-enter"'
                . 'title="View Book"></span></a>'
            );
        }echo json_encode($result);
    }

    public function account_list(){
        $fetch = $this->SystemDB->account_list();
        foreach ($fetch as $key => $value) {
        if ($value['Account_Status'] == 'Deactivate') {
                $stat = "mif-switch fg-red";
            } else {
                $stat = "mif-switch fg-lightOlive";
            }
            if ($value['Account_Status'] == 'Active') {
                $AccStat = 'Deactivate';
            } elseif ($value['Account_Status'] == 'Deactivate') {
                $AccStat = 'Active';
            } else {
                $AccStat = '';
            }
            if ($value['online_status'] == 1){
                $on = '<span class="mif-sun4 fg-lightOlive"></span>Online';
            }else{
                $on = '';
            }
            $result['data'][$key] = array(
                '' . $value['student_num'] . '',
                '' . $value['full_name'] . '',
                '' . $value['username'] . '',
                '' . $value['grade'] . '',
                '' . $value['email'] . '',
                '' . $on . '',
                '' . $value['Account_Status'] . '',
                '<a href="account_update?user_id=' . $value['user_id'] . '&stat=' . $value['Account_Status'] . '">'
                . '<span class="' . $stat . '" title="' . $AccStat . '" onclick="return statusconfirm();"></span></a>' . '&nbsp;&nbsp;'
                .'<a href="resetPass?user_id=' . $value['user_id'] . '">'
                . '<span class="mif-undo fg-blue" onclick="return resetconfirm();" title="Reset Password"></span></a>' . '&nbsp;'
            );
        }echo json_encode($result);
    }
    
    public function account_teachers(){
        $fetch = $this->SystemDB->account_teachers();
        foreach ($fetch as $key => $value) {
        if ($value['Account_Status'] == 'Deactivate') {
                $stat = "mif-switch fg-red";
            } else {
                $stat = "mif-switch fg-lightOlive";
            }
            if ($value['Account_Status'] == 'Active') {
                $AccStat = 'Deactivate';
            } elseif ($value['Account_Status'] == 'Deactivate') {
                $AccStat = 'Active';
            } else {
                $AccStat = '';
            }
            if ($value['online_status'] == 1){
                $on = '<span class="mif-sun4 fg-lightOlive"></span>Online';
            }else{
                $on = '';
            }
            $result['data'][$key] = array(
                '' . $value['student_num'] . '',
                '' . $value['full_name'] . '',
                '' . $value['username'] . '',
                '' . $value['email'] . '',
                '' . $on . '',
                '' . $value['Account_Status'] . '',
                '<a href="account_update?user_id=' . $value['user_id'] . '&stat=' . $value['Account_Status'] . '">'
                . '<span class="' . $stat . '" title="' . $AccStat . '" onclick="return statusconfirm();"></span></a>' . '&nbsp;&nbsp;'
                .'<a href="resetPass?user_id=' . $value['user_id'] . '">'
                . '<span class="mif-undo fg-blue" onclick="return resetconfirm();" title="Reset Password"></span></a>' . '&nbsp;'
            );
        }echo json_encode($result);
    }
    
    public function account_librarian(){
        $fetch = $this->SystemDB->account_librarian();
        foreach ($fetch as $key => $value) {
        if ($value['Account_Status'] == 'Deactivate') {
                $stat = "mif-switch fg-red";
            } else {
                $stat = "mif-switch fg-lightOlive";
            }
            if ($value['Account_Status'] == 'Active') {
                $AccStat = 'Deactivate';
            } elseif ($value['Account_Status'] == 'Deactivate') {
                $AccStat = 'Active';
            } else {
                $AccStat = '';
            } 
            $result['data'][$key] = array(
                '' . $value['student_num'] . '',
                '' . $value['full_name'] . '',
                '' . $value['username'] . '',
                '' . $value['email'] . '',
                '' . $value['Account_Status'] . '',
                '<a href="account_update?user_id=' . $value['user_id'] . '&stat=' . $value['Account_Status'] . '">'
                . '<span class="' . $stat . '" title="' . $AccStat . '" onclick="return statusconfirm();"></span></a>' . '&nbsp;&nbsp;'
                .'<a href="resetPass?user_id=' . $value['user_id'] . '">'
                . '<span class="mif-undo fg-blue" onclick="return resetconfirm();" title="Reset Password"></span></a>' . '&nbsp;'
            );
        }echo json_encode($result);
    }

    public function account_update() {
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            $user_id = $this->input->get('user_id');
            $AccStat = $this->input->get('stat');
            $online = array('user' => $this->SystemDB->online_check(1));

            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }
            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }

            if ($AccStat == 'Active') {
                $AccStat = 'Deactivate';
            } elseif ($AccStat == 'Deactivate') {
                $AccStat = 'Active';
            } else {
                $AccStat = '';
            }
            
            $dataInsert = array('Account_Status' => $AccStat);
            $this->SystemDB->updateStatusAccount($dataInsert, $user_id);
  
            $parent_data = array('user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send);

            $this->load->view('includes/headers/header', $parent_data);
            $this->load->view('Administrator/Accounts', $parent_data);
            $this->load->view('includes/footers/footer');
        } else {
            redirect('Elogin', 'refresh');
        }
    }


    public function resetPass() {
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $online = array('user' => $this->SystemDB->online_check(1));
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            $user_id = $this->input->get('user_id');
            $newpass = '$2a$08$mm5dd3fWE1DCs.jA0wlF2OyZzpUpU4n53e2i8/Vsi.hSZl.PnAcre';

            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }
            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }


            $dataInsert = array('password' => $newpass);
            $this->SystemDB->updateStatusAccount($dataInsert, $user_id);

            $parent_data = array('user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send);

            $this->load->view('includes/headers/header', $parent_data);
            $this->load->view('Administrator/Accounts', $parent_data);
            $this->load->view('includes/footers/footer');
        } else {
            redirect('Elogin', 'refresh');
        }
    }

    public function insert_catalog(){
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }


            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }

            $parent_data = array('user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send);
            
        $this->form_validation->set_rules('callno', 'callno.', 'callback_catalogcheck');

         if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('includes/headers/header', $parent_data);
                        $this->load->view('Administrator/Catalog', $parent_data);
                        $this->load->view('includes/footers/footer');
                }
                else
                {
                        $this->load->view('includes/headers/header', $parent_data);
                        $this->load->view('Administrator/Catalogs', $parent_data);
                        $this->load->view('includes/footers/footer');
                }
                } else {
            redirect('Elogin', 'refresh');
        }
    }

    public function catalogcheck(){
        $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }
        $callno = $this->input->post('callno');
        $title = $this->input->post('title');
        $isbn = $this->input->post('isbn');
        $location = $this->input->post('location');
        $copyright = $this->input->post('copyright');
        $author = $this->input->post('author');
        $series = $this->input->post('series');
        $subject = $this->input->post('subject');
        $volume = $this->input->post('volume');
        $accession = $this->input->post('accession');
        $copies = $this->input->post('copies');
        $description = $this->input->post('description');
        $publisher = $this->input->post('publisher');
        $gettype = $this->input->get('type');
        $access = md5($callno);
        $chkcall = $this->SystemDB->checkcall($callno);
        

        if($gettype == 'Phys.B'){
            $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '10000'; // max_size in kb
        $config['image_width'] = '500';
        $config['image_height'] = '300';

        //Load upload library
        $this->load->library('upload', $config);
           $bg = $this->input->post('coveradd'); 
           if ($this->upload->do_upload('coveradd')) {
            $uploadData = $this->upload->data();
            $loc = '' . $config['upload_path'] . '' . $uploadData['file_name'] . '';

             $data = array('callno' => $callno, 'title' => $title, 'isbn' => $isbn, 'location' => $location, 'copyright' => $copyright, 'author' => $author, 'series' => $series, 'subject' => $subject, 'volume' => $volume, 'accession' => $accession, 'description' => $description,'publisher' => $publisher, 'book_cover' => $loc, 'type' => $gettype, 'copies' => $copies,'access' => $access, 'Created' => $data['name']);

            if($title != NULL){
            if($chkcall != FALSE){
                $this->SystemDB->insert_catalog($data);
                $this->form_validation->set_message('catalogcheck', '<div class="cell colspan5  bg-lightGreen fg-white"><h4>&nbsp;New Added. Title: '.$title.'</h4></div>');
                return false;
            }else{
                $this->form_validation->set_message('catalogcheck', '<div class="cell colspan2 bg-red fg-white"><h4>&nbsp;Call No. already Exist.</h4></div>');
                return false;
            }
            }else{
                $this->form_validation->set_message('catalogcheck', '<div class="cell colspan4  bg-red fg-white"><h4>&nbsp;The {title} field can not be empty.</h4></div>');
                return false; 
            }      
        }else{
            $this->form_validation->set_message('catalogcheck', '<div class="cell colspan4  bg-red fg-white"><h4>&nbsp;No Cover Photo.</h4></div>');
                return false; 
        } 
        }else{
            $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '10000'; // max_size in kb
        $config['image_width'] = '500';
        $config['image_height'] = '300';

        //Load upload library
        $this->load->library('upload', $config);
            $bg = $this->input->post('coveradde');
            if ($this->upload->do_upload('coveradde')) {
            $uploadData = $this->upload->data();
            $loc = '' . $config['upload_path'] . '' . $uploadData['file_name'] . '';

             $data = array('callno' => $callno, 'title' => $title, 'isbn' => $isbn, 'location' => $location, 'copyright' => $copyright, 'author' => $author, 'series' => $series, 'subject' => $subject, 'volume' => $volume, 'accession' => $accession, 'description' => $description,'publisher' => $publisher, 'book_cover' => $loc, 'type' => $gettype, 'copies' => $copies,'access' => $access, 'Created' => $data['name']);

            if($title != NULL){
            if($chkcall != FALSE){
                $this->SystemDB->insert_catalog($data);
                $this->form_validation->set_message('catalogcheck', '<div class="cell colspan5  bg-lightGreen fg-white"><h4>&nbsp;New Added. Title: '.$title.'</h4></div>');
                return false;
            }else{
                $this->form_validation->set_message('catalogcheck', '<div class="cell colspan2 bg-red fg-white"><h4>&nbsp;Call No. already Exist.</h4></div>');
                return false;
            }
            }else{
                $this->form_validation->set_message('catalogcheck', '<div class="cell colspan4  bg-red fg-white"><h4>&nbsp;The {title} field can not be empty.</h4></div>');
                return false; 
            }      
        }else{
            $this->form_validation->set_message('catalogcheck', '<div class="cell colspan4  bg-red fg-white"><h4>&nbsp;No Cover Photo.</h4></div>');
                return false; 
        } 
        }

        // File upload
            
        
    }
    
    public function insert_material(){
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }


            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }

            $parent_data = array('user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send);
            
        $this->form_validation->set_rules('accession', 'accession.', 'callback_materialcheck');

         if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('includes/headers/header', $parent_data);
                        $this->load->view('Administrator/Catalog', $parent_data);
                        $this->load->view('includes/footers/footer');
                }
                else
                {
                        $this->load->view('includes/headers/header', $parent_data);
                        $this->load->view('Administrator/Catalogs', $parent_data);
                        $this->load->view('includes/footers/footer');
                }
                } else {
            redirect('Elogin', 'refresh');
        }
    }
    
    
    public function materialcheck(){
        $accession = $this->input->post('accession');
        $equipmentid = $this->input->post('equipmentid');
        $dpurchase = $this->input->post('dpurchase');
        $manufacturer = $this->input->post('manufacturer');
        $description = $this->input->post('description');
        $format = $this->input->post('format');
        $quantity = $this->input->post('quantity');
        $access = md5($accession);
        $chkcall = $this->SystemDB->checkacc($accession);
        $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }


        $config['upload_path'] = 'image_material/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '10000'; // max_size in kb
        $config['image_width'] = '500';
        $config['image_height'] = '300';

        //Load upload library
        $this->load->library('upload', $config);
           $bg = $this->input->post('imageadd'); 
           if ($this->upload->do_upload('imageadd')) {
            $uploadData = $this->upload->data();
            $loc = '' . $config['upload_path'] . '' . $uploadData['file_name'] . '';

             $data = array('image' => $loc,'dop' => $dpurchase,'format' => $format,'description' => $description,'manufacture' => $manufacturer,'equipment_id' => $equipmentid,'accession' => $accession,'quantity' => $quantity,'uploadedby' => $data['name'],'access' => $access);

            if($accession != NULL){
            if($chkcall != FALSE){
                $this->SystemDB->insert_material($data);
                $this->form_validation->set_message('materialcheck', '<div class="cell colspan5  bg-lightGreen fg-white"><h4>&nbsp;New Added. Equipment: '.$equipmentid.'</h4></div>');
                return false;
            }else{
                $this->form_validation->set_message('materialcheck', '<div class="cell colspan2 bg-red fg-white"><h4>&nbsp;Accession. already Exist.</h4></div>');
                return false;
            }
            }else{
                $this->form_validation->set_message('materialcheck', '<div class="cell colspan4  bg-red fg-white"><h4>&nbsp;The {equipmentid} field can not be empty.</h4></div>');
                return false; 
            }      
        }else{
            $this->form_validation->set_message('materialcheck', '<div class="cell colspan4  bg-red fg-white"><h4>&nbsp;No Photo.</h4></div>');
                return false; 
        } 
        // File upload
            
    }
    
    
    //-- Update Book Info --//
    public function updatebook(){
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $id = $this->session->userdata('id');
            $bookid = $this->input->get('access');
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));
            $fetchbook = $this->SystemDB->view_item($bookid);
            $fetchcall = $this->SystemDB->getaccess();
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }
            
            
            $getChat = $this->SystemDB->getChatSts();
            if($getChat == null){
                $newchat = '';
            }else{
                $newchat = '<span class="mif-mail mif-ani-ring mif-ani-slow fg-red">'.$getChat.'</span>';
            }

            foreach ($fetchbook as $value) {
                $book = array(
                    'bookcover' => $value->book_cover,
                    'callno' => $value->callno,
                    'accession' => $value->accession,
                    'isbn' => $value->isbn,
                    'location' => $value->location,
                    'title' => $value->title,
                    'copyright' => $value->copyright,
                    'author' => $value->author,
                    'series' => $value->series,
                    'volume' => $value->volume,
                    'copies' => $value->copies,
                    'subject' => $value->subject,
                    'description' => $value->description,
                    'status' => $value->Status,
                    'publisher' => $value->publisher,
                    'classification' => $value->classification,
                    'edition' => $value->edition,
                    'accession' => $value->accession,
                    'access' => $value->access,
                    'createdby' => $value->Created,
                    'updatedby' => $value->Updated
                );
            }


            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }

            $parent_data = array('newchat' => $newchat,'access' => $fetchcall,'book_info' => $book, 'user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send);
            
                $this->form_validation->set_rules('utitle', 'Call No.', 'callback_checkbook');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('includes/headers/header', $parent_data);
                        $this->load->view('Administrator/book', $parent_data);
                        $this->load->view('includes/footers/footer');
                }
                else
                {
                      $this->load->view('includes/headers/header', $parent_data);
                        $this->load->view('Administrator/book', $parent_data);
                        $this->load->view('includes/footers/footer');  
                }
                } else {
            redirect('Elogin', 'refresh');
        }
    }

    public function checkbook(){
         $id = $this->session->userdata('id');
            $bookid = $this->input->get('access');
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));
            $fetchbook = $this->SystemDB->view_item($bookid);
            $fetchcall = $this->SystemDB->getaccess();
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }
            $access = $this->input->get('access');
            $ucallno = $this->input->post('callno');
            $utitle = $this->input->post('utitle');
            $ulocation = $this->input->post('ulocation');
            $uisbn = $this->input->post('uisbn');
            $uauthor = $this->input->post('uauthor');
            $ucopyright = $this->input->post('ucopyright');
            $upublisher = $this->input->post('upublisher');
            $useries = $this->input->post('useries');
            $uvolume = $this->input->post('uvolume');
            $usubject = $this->input->post('usubject');
            $ucopies = $this->input->post('ucopies');
            $udescription = $this->input->post('udescription');
            $uclassification = $this->input->post('uclassification');
            $uedition = $this->input->post('uedition');
            $uaccession = $this->input->post('uaccession');

             $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '10000'; // max_size in kb
        $config['image_width'] = '500';
        $config['image_height'] = '300';
        $config['overwrite'] = TRUE;
        
        //Load upload library
        $this->load->library('upload', $config); 
           if ($this->upload->do_upload('ucoveradd')) {
            $uploadData = $this->upload->data();
            $loc = '' . $config['upload_path'] . '' . $uploadData['file_name'] . '';

            $bookinfo = array('callno' => $ucallno,'title' => $utitle, 'location' => $ulocation, 'isbn' => $uisbn, 'author' => $uauthor, 'copyright' => $ucopyright, 'publisher' => $upublisher, 'series' => $useries, 'volume' => $uvolume, 'subject' => $usubject, 'copies' => $ucopies, 'description' => $udescription,'classification' => $uclassification, 'edition' => $uedition, 'accession' => $uaccession, 'book_cover' => $loc, 'updated' => $data['name']);    
            if($utitle == ""){
                $this->form_validation->set_message('checkbook', '<script> alert("Book Not Change.");</script>');
                return false;
            }else{
                $this->form_validation->set_message('checkbook', '');
                $this->SystemDB->updatebookinfo($access,$bookinfo);
                return true;
            }
            }else{
                $bookinfo = array('callno' => $ucallno,'title' => $utitle, 'location' => $ulocation, 'isbn' => $uisbn, 'author' => $uauthor, 'copyright' => $ucopyright, 'publisher' => $upublisher, 'series' => $useries, 'volume' => $uvolume, 'subject' => $usubject, 'copies' => $ucopies, 'description' => $udescription,'classification' => $uclassification, 'edition' => $uedition, 'accession' => $uaccession, 'updated' => $data['name']);   
                $this->form_validation->set_message('checkbook', '');
                $this->SystemDB->updatebookinfo($access,$bookinfo);
                return true;
            }
            
    }
    
    //-- Update Material Info --//
    public function updatematerial(){
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $id = $this->session->userdata('id');
            $bookid = $this->input->get('access');
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));
            $fetchbook = $this->SystemDB->avview_item($bookid);
            $fetchcall = $this->SystemDB->getaccess();
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }
            
            
            $getChat = $this->SystemDB->getChatSts();
            if($getChat == null){
                $newchat = '';
            }else{
                $newchat = '<span class="mif-mail mif-ani-ring mif-ani-slow fg-red">'.$getChat.'</span>';
            }

            foreach ($fetchbook as $value) {
                $material = array(
                    'bookcover' => $value->image,
                    'accession' => $value->accession,
                    'equipment_id' => $value->equipment_id,
                    'manufacture' => $value->manufacture,
                    'description' => $value->description,
                    'format' => $value->format,
                    'dop' => $value->dop,
                    'quantity' => $value->quantity,
                    'status' => $value->status,
                    'upload' => $value->uploadedby,
                    'access' => $value->access,
                );
            }


            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }

            $parent_data = array('newchat' => $newchat,'access' => $fetchcall,'book_info' => $material, 'user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send);
            
                $this->form_validation->set_rules('utitle', 'Call No.', 'callback_checkmaterial');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('includes/headers/header', $parent_data);
                        $this->load->view('Administrator/material', $parent_data);
                        $this->load->view('includes/footers/footer');
                }
                else
                {
                      $this->load->view('includes/headers/header', $parent_data);
                        $this->load->view('Administrator/material', $parent_data);
                        $this->load->view('includes/footers/footer');  
                }
                } else {
            redirect('Elogin', 'refresh');
        }
    }

    public function checkmaterial(){
         $id = $this->session->userdata('id');
            $bookid = $this->input->get('access');
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));
            $fetchbook = $this->SystemDB->view_item($bookid);
            $fetchcall = $this->SystemDB->getaccess();
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }
            $accession = $this->input->post('accession');
            $equipment_id = $this->input->post('equipment_id');
            $dop = $this->input->post('dop');
            $manufacture = $this->input->post('manufacture');
            $description = $this->input->post('description');
            $format = $this->input->post('format');
            $quantity = $this->input->post('quantity');

             $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '10000'; // max_size in kb
        $config['image_width'] = '500';
        $config['image_height'] = '300';
        $config['overwrite'] = TRUE;
        
        //Load upload library
        $this->load->library('upload', $config); 
           if ($this->upload->do_upload('imageadd')) {
            $uploadData = $this->upload->data();
            $loc = '' . $config['upload_path'] . '' . $uploadData['file_name'] . '';

            $bookinfo = array('accession' => $accession, 'equipment_id' => $equipment_id, 'dop' => $dop, 'manufacture' => $manufacture, 'description' => $description, 'format' => $format, 'quantity' => $quantity, 'image' => $loc);    
            if($accession == ""){
                $this->form_validation->set_message('checkbook', '<script> alert("Material Not Change.");</script>');
                return false;
            }else{
                $this->form_validation->set_message('checkbook', '');
                $this->SystemDB->updatematerialinfo($bookid,$bookinfo);
                return true;
            }
            }else{
                $bookinfo = array('accession' => $accession, 'equipment_id' => $equipment_id, 'dop' => $dop, 'manufacture' => $manufacture, 'description' => $description, 'format' => $format, 'quantity' => $quantity);   
                $this->form_validation->set_message('checkbook', '');
                $this->SystemDB->updatematerialinfo($bookid,$bookinfo);
                return true;
            }
            
    }

    public function Reserve(){
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $id = $this->session->userdata('id');
            $grade = $this->session->userdata('grade');
            $access = $this->input->get('access');
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));
            $fetchbook = $this->SystemDB->view_item($access);
            $fetchaccess = $this->SystemDB->getaccess();

            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                'std' => $value->student_num
                );
            }
            
            $getStdChat = $this->SystemDB->getStdChatSts($data['std']);
            if($getStdChat == null){
                $newstdchat = '';
            }else{
                $newstdchat = '<span class="mif-mail mif-2x mif-ani-shake mif-ani-slow fg-red"></span>';
            }
            foreach ($fetchbook as $value) {
                if($value->book_cover == null){
                        $img = 'images/no_image.png';
                    }else{
                        $img = $value->book_cover;
                    }
                $book = array(
                    'bookcover' => $img,
                    'callno' => $value->callno,
                    'accession' => $value->accession,
                    'isbn' => $value->isbn,
                    'location' => $value->location,
                    'title' => $value->title,
                    'copyright' => $value->copyright,
                    'author' => $value->author,
                    'series' => $value->series,
                    'volume' => $value->volume,
                    'copies' => $value->copies,
                    'subject' => $value->subject,
                    'description' => $value->description,
                    'status' => $value->Status,
                    'publisher' => $value->publisher,
                    'type' => $value->type,
                    'access' => $value->access,
                );
            }


            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }

            $parent_data = array('newstdchat' => $newstdchat,'access' => $fetchaccess, 'gr' => $grade,'book_info' => $book, 'user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send);
            
            $this->load->view('includes/headers/header-student', $parent_data);
            $this->load->view('Student/Reserve', $parent_data);
            $this->load->view('includes/footers/footer-subaccounts');
        } else {
            redirect('Elogin', 'refresh');
        }
    }

    public function Request(){
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $id = $this->session->userdata('id');
            $grade = $this->session->userdata('grade');
            $bookid = $this->input->get('access');
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));
            $fetchbook = $this->SystemDB->view_item($bookid);
            $fetchcall = $this->SystemDB->getaccess();

            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                'std' => $value->student_num
                );
            }
            
            $getStdChat = $this->SystemDB->getStdChatSts($data['std']);
            if($getStdChat == null){
                $newstdchat = '';
            }else{
                $newstdchat = '<span class="mif-mail mif-2x mif-ani-shake mif-ani-slow fg-red"></span>';
            }

            foreach ($fetchbook as $value) {
                if($value->book_cover == null){
                        $img = 'images/no_image.png';
                    }else{
                        $img = $value->book_cover;
                    }
                $book = array(
                    'bookcover' => $img,
                    'callno' => $value->callno,
                    'accession' => $value->accession,
                    'isbn' => $value->isbn,
                    'location' => $value->location,
                    'title' => $value->title,
                    'copyright' => $value->copyright,
                    'author' => $value->author,
                    'series' => $value->series,
                    'volume' => $value->volume,
                    'copies' => $value->copies,
                    'subject' => $value->subject,
                    'description' => $value->description,
                    'status' => $value->Status,
                    'publisher' => $value->publisher,
                    'type' => $value->type,
                    'access' => $value->access
                );
            }


            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }

            $parent_data = array('newstdchat' => $newstdchat,'callno' => $fetchcall, 'gr' => $grade,'book_info' => $book, 'user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send);

            $this->load->view('includes/headers/header-student', $parent_data);
            $this->load->view('Student/Request', $parent_data);
            $this->load->view('includes/footers/footer-subaccounts');
        } else {
            redirect('Elogin', 'refresh');
        }
    }
    
    
    

    public function request_book(){
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $id = $this->session->userdata('id');
            $grade = $this->session->userdata('grade');
            $access = $this->input->get('access'); 
            $subarea = $this->input->post('subarea');
            $section = $this->input->post('stdsectrack');
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));
            $fetchbook = $this->SystemDB->view_item($access);
            $copies = $this->SystemDB->getcallbook($access);
            date_default_timezone_set("Asia/Manila");
            $trancDate = array("mm" => date('m'), "dd" => date('d'), 'yr' => date('Y'));
            $trancID = ($trancDate['mm'] . '/' . $trancDate['dd'] . '/' . $trancDate['yr']);
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'grade' => $value->grade,
                    'std_no' => $value->student_num,
                    'name' => $value->full_name,
                    'email' => $value->email,
                    'std' => $value->student_num
                );
            }
            
            $getStdChat = $this->SystemDB->getStdChatSts($data['std']);
            if($getStdChat == null){
                $newstdchat = '';
            }else{
                $newstdchat = '<span class="mif-mail mif-2x mif-ani-shake mif-ani-slow fg-red"></span>';
            }

           foreach ($fetchbook as $value) {
                if($value->book_cover == null){
                        $img = 'images/no_image.png';
                    }else{
                        $img = $value->book_cover;
                    }
                $book = array(
                    'bookcover' => $img,
                    'callno' => $value->callno,
                    'accession' => $value->accession,
                    'isbn' => $value->isbn,
                    'location' => $value->location,
                    'title' => $value->title,
                    'copyright' => $value->copyright,
                    'author' => $value->author,
                    'series' => $value->series,
                    'volume' => $value->volume,
                    'copies' => $value->copies,
                    'subject' => $value->subject,
                    'description' => $value->description,
                    'status' => $value->Status,
                    'publisher' => $value->publisher,
                    'type' => $value->type,
                    'access' => $value->access,
                );
            }     

            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }

            $parent_data = array('newstdchat' => $newstdchat,'access' => $access, 'gr' => $grade,'book_info' => $book, 'user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send);
            
           
            if($this->input->post('subarea')){
            $this->form_validation->set_rules('subarea', 'Subject Area', 'required|callback_check_request');
            }elseif($this->input->post('stdsectrack')){
                $this->form_validation->set_rules('stdsectrack', 'Section/Track', 'required|callback_check_request');
            }
                if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('includes/headers/header-student', $parent_data);
                        $this->load->view('Student/Request', $parent_data);
                        $this->load->view('includes/footers/footer-subaccounts');
                }
                else
                {
                        $this->load->view('includes/headers/header-student', $parent_data);
                        $this->load->view('Student/Request', $parent_data);
                        $this->load->view('includes/footers/footer-subaccounts');
                }
        } else {
            redirect('Elogin', 'refresh');
        }
    }
    
    
    public function check_request(){
         $id = $this->session->userdata('id');
            $grade = $this->session->userdata('grade');
            $access = $this->input->get('access'); 
            $subarea = $this->input->post('subarea');
            $section = $this->input->post('stdsectrack');
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));
            $fetchbook = $this->SystemDB->view_item($access);
            $copies = $this->SystemDB->getcallbook($access);
            date_default_timezone_set("Asia/Manila");
            $trancDate = array("mm" => date('m'), "dd" => date('d'), 'yr' => date('Y'));
            $trancID = ($trancDate['mm'] . '/' . $trancDate['dd'] . '/' . $trancDate['yr']);
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'grade' => $value->grade,
                    'std_no' => $value->student_num,
                    'name' => $value->full_name,
                    'email' => $value->email,
                    'std' => $value->student_num
                );
            }
        
        
        foreach ($fetchbook as $value) {
                if($value->book_cover == null){
                        $img = 'images/no_image.png';
                    }else{
                        $img = $value->book_cover;
                    }
                $book = array(
                    'bookcover' => $img,
                    'callno' => $value->callno,
                    'accession' => $value->accession,
                    'isbn' => $value->isbn,
                    'location' => $value->location,
                    'title' => $value->title,
                    'copyright' => $value->copyright,
                    'author' => $value->author,
                    'series' => $value->series,
                    'volume' => $value->volume,
                    'copies' => $value->copies,
                    'subject' => $value->subject,
                    'description' => $value->description,
                    'status' => $value->Status,
                    'publisher' => $value->publisher,
                    'type' => $value->type,
                    'access' => $value->access,
                );
            }
        
         if($data['status'] == 4){
                 $subarea = '-';
                if($section){
                    if($copies >= 1){
                        $rbook = array('date_reserve' => $trancID,'name' => $data['name'], 'grade' => $data['grade'], 'subject_area' => $subarea, 'section_track' => $section, 'callno' => $book['callno'], 'accession' => $book['accession'] ,'title' => $book['title'], 'author' => $book['author'], 'type' => $book['type'], 'access' => $access);
                $this->SystemDB->reserve($rbook);
                $this->form_validation->set_message('check_request', 'Request Submitted.');
                        return FALSE;
                }else{
                    $this->form_validation->set_message('check_request', 'Request Failed.');
                    return false;
                }
                }
               
            }else{
               $section = '-';
               if($subarea){
                   if($copies >= 1){
                     $rbook = array('date_reserve' => $trancID,'name' => $data['name'], 'grade' => $data['grade'], 'subject_area' => $subarea, 'section_track' => $section, 'callno' => $book['callno'], 'accession' => $book['accession'] ,'title' => $book['title'], 'author' => $book['author'], 'type' => $book['type'], 'access' => $access);   
                $this->SystemDB->reserve($rbook);
                $this->form_validation->set_message('check_request', 'Request Submitted.');
                        return FALSE;
                }else{
                    $this->form_validation->set_message('check_request', 'Request Failed.');
                    return false;
                }
               }
            }
    }

    public function reserve_book(){
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $id = $this->session->userdata('id');
            $grade = $this->session->userdata('grade');
            $access = $this->input->get('access'); 
            $subarea = $this->input->post('subarea');
            $section = $this->input->post('stdsectrack');
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));
            $fetchbook = $this->SystemDB->view_item($access);
            $copies = $this->SystemDB->getcallbook($access);
            $type = $this->input->get('type');
            date_default_timezone_set("Asia/Manila");
            $trancDate = array("mm" => date('m'), "dd" => date('d'), 'yr' => date('Y'));
            $trancID = $trancDate['mm'] . '/' . $trancDate['dd'] . '/' . $trancDate['yr'];
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'grade' => $value->grade,
                    'std_no' => $value->student_num,
                    'name' => $value->full_name,
                    'email' => $value->email,
                    'std' => $value->student_num
                );
            }
            
            $getStdChat = $this->SystemDB->getStdChatSts($data['std']);
            if($getStdChat == null){
                $newstdchat = '';
            }else{
                $newstdchat = '<span class="mif-mail mif-2x mif-ani-shake mif-ani-slow fg-red"></span>';
            }
            
            foreach ($fetchbook as $value) {
                if($value->book_cover == null){
                        $img = 'images/no_image.png';
                    }else{
                        $img = $value->book_cover;
                    }
                $book = array(
                    'bookcover' => $img,
                    'callno' => $value->callno,
                    'accession' => $value->accession,
                    'isbn' => $value->isbn,
                    'location' => $value->location,
                    'title' => $value->title,
                    'copyright' => $value->copyright,
                    'author' => $value->author,
                    'series' => $value->series,
                    'volume' => $value->volume,
                    'copies' => $value->copies,
                    'subject' => $value->subject,
                    'description' => $value->description,
                    'status' => $value->Status,
                    'publisher' => $value->publisher,
                    'type' => $value->type,
                    'access' => $value->access,
                );
            }

            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }

            $parent_data = array("newstdchat" => $newstdchat,'access' => $access, 'gr' => $grade,'book_info' => $book, 'user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send);

            
            if($this->input->post('subarea')){
                $this->form_validation->set_rules('subarea', 'Subject Area', 'required|callback_check_reserve');
            }elseif($this->input->post('stdsectrack')){
                $this->form_validation->set_rules('stdsectrack', 'Section/Track', 'required|callback_check_reserve');
            }
                if ($this->form_validation->run() == FALSE)
                {
                         $this->load->view('includes/headers/header-student', $parent_data);
                         $this->load->view('Student/Reserve', $parent_data);
                         $this->load->view('includes/footers/footer-subaccounts');
                }
                else
                {
                         $this->load->view('includes/headers/header-student', $parent_data);
                         $this->load->view('Student/Reserve', $parent_data);
                         $this->load->view('includes/footers/footer-subaccounts');
                }
            
        } else {
            redirect('Elogin', 'refresh');
        }
    }
    
    public function check_reserve(){
        $id = $this->session->userdata('id');
            $grade = $this->session->userdata('grade');
            $access = $this->input->get('access'); 
            $subarea = $this->input->post('subarea');
            $section = $this->input->post('stdsectrack');
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));
            $fetchbook = $this->SystemDB->view_item($access);
            $copies = $this->SystemDB->getcallbook($access);
            $type = $this->input->get('type');
            date_default_timezone_set("Asia/Manila");
            $trancDate = array("mm" => date('m'), "dd" => date('d'), 'yr' => date('Y'));
            $trancID = $trancDate['mm'] . '/' . $trancDate['dd'] . '/' . $trancDate['yr'];
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'grade' => $value->grade,
                    'std_no' => $value->student_num,
                    'name' => $value->full_name,
                    'email' => $value->email,
                    'std' => $value->student_num
                );
            }
            
        foreach ($fetchbook as $value) {
                if($value->book_cover == null){
                        $img = 'images/no_image.png';
                    }else{
                        $img = $value->book_cover;
                    }
                $book = array(
                    'bookcover' => $img,
                    'callno' => $value->callno,
                    'accession' => $value->accession,
                    'isbn' => $value->isbn,
                    'location' => $value->location,
                    'title' => $value->title,
                    'copyright' => $value->copyright,
                    'author' => $value->author,
                    'series' => $value->series,
                    'volume' => $value->volume,
                    'copies' => $value->copies,
                    'subject' => $value->subject,
                    'description' => $value->description,
                    'status' => $value->Status,
                    'publisher' => $value->publisher,
                    'type' => $value->type,
                    'access' => $value->access,
                );
            }
        if($data['status'] == 4){
                 $subarea = '-';
                if($section){
                    if($copies >= 1){
                        $rbook = array('date_reserve' => $trancID,'name' => $data['name'], 'grade' => $data['grade'], 'subject_area' => $subarea, 'section_track' => $section, 'callno' => $book['callno'], 'accession' => $book['accession'] ,'title' => $book['title'], 'author' => $book['author'], 'type' => $book['type'], 'access' => $access);
               $this->SystemDB->reserve($rbook);
                $this->form_validation->set_message('check_reserve', '<script>alert("Reserve Successful.")</script>');
                        return FALSE;
                }else{
                    $this->form_validation->set_message('check_reserve', '<script>alert("Reserve Failed.")</script>');
                    return false;
                }
                }
               
            }else{
               $section = '-';
               if($subarea){
                   if($copies >= 1){
                     $rbook = array('date_reserve' => $trancID,'name' => $data['name'], 'grade' => $data['grade'], 'subject_area' => $subarea, 'section_track' => $section, 'callno' => $book['callno'], 'accession' => $book['accession'] ,'title' => $book['title'], 'author' => $book['author'], 'type' => $book['type'], 'access' => $access);   
                $this->SystemDB->reserve($rbook);
                $this->form_validation->set_message('check_reserve', '<script>alert("Reserve Successful.")</script>');
                        return FALSE;
                }else{
                    $this->form_validation->set_message('check_reserve', '<script>alert("Reserve Failed.")</script>');
                    return false;
                }
               }
            }
    }
    

    public function book(){
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $id = $this->session->userdata('id');
            $bookid = $this->input->get('access');
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));
            $fetchbook = $this->SystemDB->view_item($bookid);
            $fetchcall = $this->SystemDB->getaccess();
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }
            
            $getChat = $this->SystemDB->getChatSts();
            if($getChat == null){
                $newchat = '';
            }else{
                $newchat = '<span class="mif-mail mif-ani-ring mif-ani-slow fg-red">'.$getChat.'</span>';
            }

            foreach ($fetchbook as $value) {
                $book = array(
                    'bookcover' => $value->book_cover,
                    'callno' => $value->callno,
                    'accession' => $value->accession,
                    'isbn' => $value->isbn,
                    'location' => $value->location,
                    'title' => $value->title,
                    'copyright' => $value->copyright,
                    'author' => $value->author,
                    'series' => $value->series,
                    'volume' => $value->volume,
                    'copies' => $value->copies,
                    'subject' => $value->subject,
                    'description' => $value->description,
                    'status' => $value->Status,
                    'publisher' => $value->publisher,
                    'classification' => $value->classification,
                    'edition' => $value->edition,
                    'access' => $value->access,
                    'createdby' => $value->Created
                );
            }


            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }

            $parent_data = array('newchat' => $newchat,'callno' => $fetchcall,'book_info' => $book, 'user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send);

            $this->load->view('includes/headers/header', $parent_data);
            $this->load->view('Administrator/book', $parent_data);
            $this->load->view('includes/footers/footer');
        } else {
            redirect('Elogin', 'refresh');
        }
    }
    
    public function AVmaterials(){
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $id = $this->session->userdata('id');
            $bookid = $this->input->get('access');
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));
            $fetchbook = $this->SystemDB->avview_item($bookid);
            $fetchcall = $this->SystemDB->getaccess();
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }
            
            $getChat = $this->SystemDB->getChatSts();
            if($getChat == null){
                $newchat = '';
            }else{
                $newchat = '<span class="mif-mail mif-ani-ring mif-ani-slow fg-red">'.$getChat.'</span>';
            }

            foreach ($fetchbook as $value) {
                $material = array(
                    'bookcover' => $value->image,
                    'accession' => $value->accession,
                    'equipment_id' => $value->equipment_id,
                    'manufacture' => $value->manufacture,
                    'description' => $value->description,
                    'format' => $value->format,
                    'dop' => $value->dop,
                    'quantity' => $value->quantity,
                    'status' => $value->status,
                    'upload' => $value->uploadedby,
                    'access' => $value->access,
                );
            }


            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }

            $parent_data = array('newchat' => $newchat,'callno' => $fetchcall,'book_info' => $material, 'user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send);

            $this->load->view('includes/headers/header', $parent_data);
            $this->load->view('Administrator/material', $parent_data);
            $this->load->view('includes/footers/footer');
        } else {
            redirect('Elogin', 'refresh');
        }
    }

    public function chatme(){
        if($this->session->userdata('admin_logged_in')){
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                    'std' => $value->student_num,
                );
            }
            $d = $data['user'];
            $val = array('sender_id' => $data['std']);
            $getchat = $this->SystemDB->mychat($val);
            foreach ($getchat as $key => $values) {
            $result['data'][$key] = array(
                'id' => ''.$values['chat_messages_id'].'',
                'message' => '' . $values['chat_messages_text'] . '',
            );

        }echo json_encode($result);
        }
    }

    public function chatthem(){
        if($this->session->userdata('admin_logged_in')){
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                    'std' => $value->student_num,
                );
            }
            $d = $this->input->get('user');
            $getchat = $this->SystemDB->chatthems($d);
            foreach ($getchat as $key => $values) {
            $result['data'][$key] = array(
                'id' => ''.$values['chat_messages_id'].'',
                'message' => '' . $values['chat_messages_text'] . '',
            );

        }echo json_encode($result);
        }
    }

    public function sendchat(){
         if($this->session->userdata('admin_logged_in')){
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            $text = $this->input->get('text');
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                    'std' => $value->student_num,
                );
            }
    
            $getchat = $this->SystemDB->getchat($data['std']);
        foreach ($getchat as $values) {
            $d = array('user' => $values->sender_id,
            'msg' => $values->chat_messages_text);
        }
        
        if($text){
        $datas = array('chat_messages_text' => "<div class='msgln'><b>".$data['name']."</b>: ".$text."<br><br><p class='text-small align-center'>".date("F d Y h:i:s A")."</p></div>");
        
            if($data['std'] == $d['user']){
                $ms = $d['msg'] . $datas['chat_messages_text'];
        $ds = array('chat_messages_text' => $ms, 'chat_messages_status' => 'no');
        $this->SystemDB->chat($data['std'],$ds);
            }else{
                $da = array('sender_id' => $data['std'], 'chat_messages_text' => "<div class='msgln'><b>".$data['name']."</b>: ".$text."<br></div>", 'chat_messages_status' => 'no');
            $this->SystemDB->insertnewchat($da);
            }
        }
        }

    }

    public function sendchatadmin(){
         if($this->session->userdata('admin_logged_in')){
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                    'std' => $value->student_num,
                );
            }
    $text = $_POST['text'];
    
    if($data['status'] == 3 || 4){
        $full = $this->input->get('sendto');
        $acct = $this->SystemDB->getAcctStdNo($full);
        $getchat = $this->SystemDB->getchat($full);
        foreach ($getchat as $values) {
            $d = array('user' => $values->sender_id,
            'msg' => $values->chat_messages_text);
        }
         $datas = array('chat_messages_text' => "<div class='msgln'><b>LIA</b>: ".$text."<br><br><p class='text-small align-center'>".date("F d Y h:i:s A")."</p></div>");
        if($getchat){
        $ms = $d['msg'] . $datas['chat_messages_text'];
        $ds = array('chat_messages_text' => $ms);
        $this->SystemDB->chatAdmin($acct,$ds);
        }else{
                $da = array('sender_id' => $full, 'chat_messages_text' => "<div class='msgln'><b>LIA</b>: ".$text."<br></div>", 'chat_messages_status' => 'no');
            $this->SystemDB->insertnewchat($da);
            }
            }
        }

    }


    public function chatpage(){
         if($this->session->userdata('admin_logged_in')){
            $_SESSION['last_login_timestamp'] = time();
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            $sliders = $this->SystemDB->home_sliders();
            $online = array('user' => $this->SystemDB->online_check(1));

            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }
            
            $getChat = $this->SystemDB->getChatSts();
            if($getChat == null){
                $newchat = '';
            }else{
                $newchat = '<span class="mif-mail mif-ani-ring mif-ani-slow fg-red">'.$getChat.'</span>';
            }

            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }

            $parent_data = array('newchat' => $newchat,'user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send, 'slide' => $sliders);

            if($data['status'] == 1){
            $this->load->view('includes/headers/header', $parent_data);
            $this->load->view('Administrator/chat', $parent_data);
            $this->load->view('includes/footers/footer');
        }elseif($data['status'] == 2){
            $this->load->view('includes/headers/header', $parent_data);
            $this->load->view('Administrator/chat', $parent_data);
            $this->load->view('includes/footers/footer');
        }else{
            redirect('ElibrarySystem/landing_page', 'refresh');
        }
        } else {
            redirect('Elogin', 'refresh');
        }
            
    }

    public function chatname(){
        $id = $this->session->userdata('id');
        $s = $this->SystemDB->fetch_where($id);
        foreach ($s as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                    'std' => $value->student_num,
                );
            }
        $fetch = $this->SystemDB->account_items();
        foreach ($fetch as $key => $value) {
            if($value['chat_messages_status'] == "yes"){
                $newchat = '';
            }else{
                $newchat = '<span class="mif-mail mif-ani-ring mif-ani-slow fg-red"></span>';
            }
            if ($value['online_status'] == 1){
                $on = '<span class="mif-sun4 fg-lightOlive mif-ani-flash"></span>Active';
            }else{
                $on = '';
            }
            $result['data'][$key] = array(
                ''.$value['chat_messages_id'].'',
                ''.$value['student_num'].'',
                '<div id="std">' . $value['full_name'] . ''.$newchat.'</div>'.$on.'<button class="button small-button info block-shadow-info text-shadow" style="float: right;" onclick="return chatmeloadme('.$value['sender_id'].');">Chat</button>'
                
            );
        }echo json_encode($result);
    }

    public function page_configurations() {
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            $sliders = $this->SystemDB->home_sliders();
            $online = array('user' => $this->SystemDB->online_check(1));

            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }
            
            $getChat = $this->SystemDB->getChatSts();
            if($getChat == null){
                $newchat = '';
            }else{
                $newchat = '<span class="mif-mail mif-ani-ring mif-ani-slow fg-red">'.$getChat.'</span>';
            }
            
            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }

            $parent_data = array('newchat' => $newchat,'user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send, 'slide' => $sliders);

            if($data['status'] == 1){
            $this->load->view('includes/headers/header', $parent_data);
            $this->load->view('Administrator/HomepageConfig', $parent_data);
            $this->load->view('includes/footers/footer');
        }elseif($data['status'] == 2){
            $this->load->view('includes/headers/header', $parent_data);
            $this->load->view('Administrator/HomepageConfig', $parent_data);
            $this->load->view('includes/footers/footer');
        }else{
            redirect('ElibrarySystem/landing_page', 'refresh');
        }
        } else {
            redirect('Elogin', 'refresh');
        }
    }

    public function home_config() {
        date_default_timezone_set("Asia/Manila");
        $trancDate = array('yr' => date('Y'), "mm" => date('m'), "dd" => date('d'));
        $result = array('data' => array());
        $fetch = $this->SystemDB->home_sliders();
        foreach ($fetch as $key => $value) {
            $result['data'][$key] = array(
                '' . $value['id'] . '',
                '<img alt="Home Slide" src="' . base_url('' . $value['background'] . '') . '" style="width: 150px;"/>',
                '' . $value['title'] . '',
                '' . $value['subtitle'] . '',
                '' . $value['description'] . '',
                '' . $value['status'] . ''
            );
        }echo json_encode($result);
    }

    public function sliders_id() {
        if ($this->input->post('slider_id')) {
            $id = $this->input->post('slider_id');
            echo json_encode($this->SystemDB->home_sliderId($id));
        }
    }



    public function checkcallno() {
        if ($this->input->get('callno')) {
            $callno = $this->input->get('callno');
            echo json_encode($this->SystemDB->catalog_callno($callno));
        }
    }
    
    public function checkaccessmaterial() {
        if ($this->input->get('access')) {
            $access = $this->input->get('access');
            echo json_encode($this->SystemDB->catalog_access($access));
        }
    }

    public function welcome_config() {
        date_default_timezone_set("Asia/Manila");
        $trancDate = array('yr' => date('Y'), "mm" => date('m'), "dd" => date('d'));
        $result = array('data' => array());
        $fetch = $this->SystemDB->home_welcome();
        foreach ($fetch as $key => $value) {
            $result['data'][$key] = array(
                '<input type="text" name="title" value="' . $value['title'] . '">',
                '<input type="text" name="author" value="' . $value['author'] . '">',
                '<input type="text" name="details" value="' . $value['details'] . '">',
                '<input type="submit" value="Update">'
            );
        }echo json_encode($result);
    }

    public function update_slider() {
        $id = $this->input->post('sliderid');
        $title = $this->input->post('titleslider');
        $subtitle = $this->input->post('subtitle');
        $description = $this->input->post('description');
        $status = $this->input->post('status');
        $bg = $this->input->post('fileUpdate');

        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '100000'; // max_size in kb
        $config['file_name'] = $_FILES['fileUpdate']['name'];
        $config['image_width'] = '500';
        $config['image_height'] = '300';

        //Load upload library
        $this->load->library('upload', $config);

        // File upload
        if ($this->upload->do_upload('fileUpdate')) {
            $uploadData = $this->upload->data();
            $loc = '' . $config['upload_path'] . '' . $uploadData['file_name'] . '';
            $data = array(
                'background' => $loc,
                'title' => $title,
                'subtitle' => $subtitle,
                'description' => $description,
                'status' => $status
            );
            $this->SystemDB->updateSlider($data, $id);
        } else {
            $data = array(
                'title' => $title,
                'subtitle' => $subtitle,
                'description' => $description,
                'status' => $status
            );
            $this->SystemDB->updateSlider($data, $id);
        }
        redirect('ElibrarySystem/page_configurations', 'refresh');
    }

    public function update_welcome() {
        $title = $this->input->post('title');
        $author = $this->input->post('author');
        $details = $this->input->post('details');

        $data = array(
            'title' => $title,
            'author' => $author,
            'details' => $details
        );

        $this->SystemDB->updateWelcome($data);
        redirect('ElibrarySystem/page_configurations', 'refresh');
    }

    public function insert_slider() {
        $title = $this->input->post('title');
        $subtitle = $this->input->post('subtitle');
        $description = $this->input->post('description');

        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '100000'; // max_size in kb
        $config['file_name'] = $_FILES['file']['name'];
        $config['image_width'] = '500';
        $config['image_height'] = '300';

        //Load upload library
        $this->load->library('upload', $config);

        // File upload
        if ($this->upload->do_upload('file')) {
            $uploadData = $this->upload->data();
            $loc = '' . $config['upload_path'] . '' . $uploadData['file_name'] . '';

            $data = array(
                'background' => $loc,
                'title' => $title,
                'subtitle' => $subtitle,
                'description' => $description
            );
            $this->SystemDB->insertSlider($data);
        }
        redirect('ElibrarySystem/page_configurations', 'refresh');
    }

    public function remove_slider() {
        $id = $this->input->post('sliderremoveid');
        $this->SystemDB->removeSlider($id);
        redirect('ElibrarySystem/page_configurations', 'refresh');
    }

    public function lookupSearch() {
        // process posted form data  
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response  
        $query = $this->SystemDB->lookupSearch($keyword); //Search DB  
        if (!empty($query)) {
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach ($query as $row) {
                $data['message'][] = array(
                    'title' => $row->title
                );  //Add a row to array  
            }
        }
        if ('IS_AJAX') {
            echo json_encode($data); //echo json string if ajax request  
            return TRUE;
        } else {
            $this->load->view('Student/Dashboard', $data);
            return FALSE;
        }
    }

    public function account_change() {
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $online = array('user' => $this->SystemDB->online_check(1));
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            $user_id = $this->input->get('user_id');
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                'std' => $value->student_num
                );
            }
            
            $getStdChat = $this->SystemDB->getStdChatSts($data['std']);
            if($getStdChat == null){
                $newstdchat = '';
            }else{
                $newstdchat = '<span class="mif-mail mif-2x mif-ani-shake mif-ani-slow fg-red"></span>';
            }
            
            $getChat = $this->SystemDB->getChatSts();
            if($getChat == null){
                $newchat = '';
            }else{
                $newchat = '<span class="mif-mail mif-ani-ring mif-ani-slow fg-red">'.$getChat.'</span>';
            }
            
            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }
            

            $parent_data = array('newstdchat' => $newstdchat,'newchat' => $newchat,'user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send, 'user_id' => $user_id);


            if($data['status'] == 1 && 2){
            $this->load->view('includes/headers/header', $parent_data);
            $this->load->view('Accounts/account_change', $parent_data);
            $this->load->view('includes/footers/footer');
        }else{
            $this->load->view('includes/headers/header-student', $parent_data);
            $this->load->view('Accounts/account_change_student', $parent_data);
            $this->load->view('includes/footers/footer-subaccounts'); 
        }
        } else {
            redirect('Elogin', 'refresh');
        }
    }

    public function changePass() {
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $online = array('user' => $this->SystemDB->online_check(1));
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            $user_id = $this->input->get('user_id');

            $this->form_validation->set_rules('oldpassword', 'Old Password', 'required|callback_checkPass');
            $this->form_validation->set_rules('newpassword', 'New Password', 'required');
            $this->form_validation->set_rules('rpassword', 'Confirm Password', 'required');


            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name
                );
            }
            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }

            $parent_data = array('send' => $send, 'user_log' => $data, 'online' => $online, 'user_id' => $user_id, 'stat' => $stat);

            if ($this->form_validation->run() == FALSE) {

                if($data['status'] == 1 && 2){
            $this->load->view('includes/headers/header', $parent_data);
            $this->load->view('Accounts/account_change', $parent_data);
            $this->load->view('includes/footers/footer');
            }else{
            $this->load->view('includes/headers/header-student', $parent_data);
            $this->load->view('Accounts/account_change', $parent_data);
            $this->load->view('includes/footers/footer-student'); 
        }
            } else {

                redirect('ElibrarySystem/account_change?user_id=' . $user_id . '');
            }
        } else {
            redirect('Elogin', 'refresh');
        }
    }

    public function updateEmail() {
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $online = array('user' => $this->SystemDB->online_check(1));
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            $user_id = $this->input->get('user_id');

            $this->form_validation->set_rules('newemail', 'Email', 'required');
            $this->form_validation->set_rules('remail', 'Confirm Email', 'required|matches[newemail]|callback_upEmail');


            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email
                );
            }
            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }

            $parent_data = array('send' => $send, 'user_log' => $data, 'online' => $online, 'user_id' => $user_id, 'stat' => $stat);

            if ($this->form_validation->run() == FALSE) {

                if($data['status'] == 1 && 2){
            $this->load->view('includes/headers/header', $parent_data);
            $this->load->view('Accounts/update_email', $parent_data);
            $this->load->view('includes/footers/footer');
            }else{
            $this->load->view('includes/headers/header-student', $parent_data);
            $this->load->view('Accounts/update_email', $parent_data);
            $this->load->view('includes/footers/footer-student'); 
        }
            } else {

                redirect('ElibrarySystem/account_change?user_id=' . $user_id . '');
            }
        } else {
            redirect('Elogin', 'refresh');
        }
    }

    public function transactions(){
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $id = $this->session->userdata('id');
            $bookid = $this->input->get('access');
            $fetch = $this->SystemDB->fetch_where($id);
            $online = array('user' => $this->SystemDB->online_check(1));
            $fetchbook = $this->SystemDB->view_item($bookid);
            $fetchcall = $this->SystemDB->getaccess();
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }
            
            $getChat = $this->SystemDB->getChatSts();
            if($getChat == null){
                $newchat = '';
            }else{
                $newchat = '<span class="mif-mail mif-ani-ring mif-ani-slow fg-red">'.$getChat.'</span>';
            }

            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }

            $parent_data = array('newchat' => $newchat,'callno' => $fetchcall, 'user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send);

            $this->load->view('includes/headers/header', $parent_data);
            $this->load->view('Administrator/transaction', $parent_data);
            $this->load->view('includes/footers/footer');
        } else {
            redirect('Elogin', 'refresh');
        }
    }

    public function reservelist(){
        if($this->session->userdata('admin_logged_in')){ 
        $fetch = $this->SystemDB->reserve_list();
        $trancDate = array("mm" => date('m'), "dd" => date('d'), 'yr' => date('Y'));
        $trancID = $trancDate['mm'] . '/' . $trancDate['dd'] . '/' . $trancDate['yr'];
        foreach ($fetch as $key => $value) {
            if($value['status'] == 0){
                    $status = '<span class="tag fg-white bg-indigo">Pending</span>';
                }elseif($value['status'] == 1){
                    $status = '<span class="tag fg-white bg-blue">Processing</span>';
                }elseif($value['status'] == 2){
                    $status = '<span class="tag fg-white bg-lightGreen">Approved</span>';
                }else{
                    $cd = intval(str_replace('/', '',$trancID));
                $dd = intval(str_replace('/', '',$value['due_date']));
                $rd = intval(str_replace('/', '',$value['date_reserve']));
                    if($cd < $dd){
                        $status = '<span class="tag fg-white bg-red">Onloan</span>';
                    }else{
                        $status = '<span class="tag fg-white bg-red">Expired</span>';
                    }
                    
                }
                
            $result['data'][$key] = array(
                '' . $value['id'] . '',
                '' . $value['date_reserve'] . '',
                '' . $value['due_date'] . '',
                '' . $value['name'] . '',
                '' . $value['grade'] . '',
                '' . $value['subject_area'] . '',
                '' . $value['section_track'] . '',
                '' . $value['callno'] . '',
                '' . $value['accession'] . '',
                '' . $value['title'] . '',
                '' . $value['author'] . '',
                '' . $value['type'] . '',
                $status,
                '<a href="changeStatus?access='.$value['access'].'&a=0" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-undo fg-indigo" title="Pending"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=1" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-eye fg-blue" title="Process"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=2" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-checkmark fg-lightGreen" title="Approved"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=3&d=3" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-calendar fg-lightGreen" title="3-Days"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=3&d=5" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-calendar fg-orange" title="5-Days"></span></a>
                &nbsp;|&nbsp;
                <a href="book?access='.$value['access'].'"><span class="mif-enter" title="View Book"></span></a>&nbsp;|&nbsp;',
                
            );
        }echo json_encode($result);
        }
    }
    
    public function todaylist(){
        if($this->session->userdata('admin_logged_in')){ 
        $trancDate = array("mm" => date('m'), "dd" => date('d'), 'yr' => date('Y'));
            $trancID = $trancDate['mm'] . '/' . $trancDate['dd'] . '/' . $trancDate['yr'];
        $fetch = $this->SystemDB->today_list($trancID);
        foreach ($fetch as $key => $value) {
            if($value['status'] == 0){
                    $status = '<span class="tag fg-white bg-indigo">Pending</span>';
                }elseif($value['status'] == 1){
                    $status = '<span class="tag fg-white bg-blue">Processing</span>';
                }elseif($value['status'] == 2){
                    $status = '<span class="tag fg-white bg-lightGreen">Approved</span>';
                }else{
                    $status = '<span class="tag fg-white bg-red">Onloan</span>';
                }
                
            $result['data'][$key] = array(
                '' . $value['id'] . '',
                '' . $value['date_reserve'] . '',
                '' . $value['due_date'] . '',
                '' . $value['name'] . '',
                '' . $value['grade'] . '',
                '' . $value['subject_area'] . '',
                '' . $value['section_track'] . '',
                '' . $value['callno'] . '',
                '' . $value['accession'] . '',
                '' . $value['title'] . '',
                '' . $value['author'] . '',
                '' . $value['type'] . '',
                $status,
                '<a href="changeStatus?access='.$value['access'].'&a=0" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-undo fg-indigo" title="Pending"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=1" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-eye fg-blue" title="Process"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=2" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-checkmark fg-lightGreen" title="Approved"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=3&d=3" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-calendar fg-lightGreen" title="3-Days"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=3&d=5" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-calendar fg-orange" title="5-Days"></span></a>
                &nbsp;|&nbsp;
                <a href="book?access='.$value['access'].'"><span class="mif-enter" title="View Book"></span></a>&nbsp;|&nbsp;',
                
            );
        }echo json_encode($result);
        }
    }
    
    public function processreservelist(){
        if($this->session->userdata('admin_logged_in')){ 
        $fetch = $this->SystemDB->processreserve_list();
        foreach ($fetch as $key => $value) {
            if($value['status'] == 0){
                    $status = '<span class="tag fg-white bg-indigo">Pending</span>';
                }elseif($value['status'] == 1){
                    $status = '<span class="tag fg-white bg-blue">Processing</span>';
                }elseif($value['status'] == 2){
                    $status = '<span class="tag fg-white bg-lightGreen">Approved</span>';
                }else{
                    $status = '<span class="tag fg-white bg-red">Onloan</span>';
                }
            $result['data'][$key] = array(
                '' . $value['id'] . '',
                '' . $value['date_reserve'] . '',
                '' . $value['due_date'] . '',
                '' . $value['name'] . '',
                '' . $value['grade'] . '',
                '' . $value['subject_area'] . '',
                '' . $value['section_track'] . '',
                '' . $value['callno'] . '',
                '' . $value['accession'] . '',
                '' . $value['title'] . '',
                '' . $value['author'] . '',
                '' . $value['type'] . '',
                $status,
                '<a href="changeStatus?access='.$value['access'].'&a=0" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-undo fg-indigo" title="Pending"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=1" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-eye fg-blue" title="Process"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=2" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-checkmark fg-lightGreen" title="Approved"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=3&d=3" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-calendar fg-lightGreen" title="3-Days"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=3&d=5" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-calendar fg-orange" title="5-Days"></span></a>
                &nbsp;|&nbsp;',
            );
        }echo json_encode($result);
        }
    }
    
    
    public function apreservelist(){
        if($this->session->userdata('admin_logged_in')){ 
        $fetch = $this->SystemDB->apreserve_list();
        foreach ($fetch as $key => $value) {
            if($value['status'] == 0){
                    $status = '<span class="tag fg-white bg-indigo">Pending</span>';
                }elseif($value['status'] == 1){
                    $status = '<span class="tag fg-white bg-blue">Processing</span>';
                }elseif($value['status'] == 2){
                    $status = '<span class="tag fg-white bg-lightGreen">Approved</span>';
                }else{
                    $status = '<span class="tag fg-white bg-red">Onloan</span>';
                }
            $result['data'][$key] = array(
                '' . $value['id'] . '',
                '' . $value['date_reserve'] . '',
                '' . $value['due_date'] . '',
                '' . $value['name'] . '',
                '' . $value['grade'] . '',
                '' . $value['subject_area'] . '',
                '' . $value['section_track'] . '',
                '' . $value['callno'] . '',
                '' . $value['accession'] . '',
                '' . $value['title'] . '',
                '' . $value['author'] . '',
                '' . $value['type'] . '',
                $status,
                '<a href="changeStatus?access='.$value['access'].'&a=0" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-undo fg-indigo" title="Pending"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=1" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-eye fg-blue" title="Process"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=2" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-checkmark fg-lightGreen" title="Approved"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=3&d=3" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-calendar fg-lightGreen" title="3-Days"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=3&d=5" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-calendar fg-orange" title="5-Days"></span></a>
                &nbsp;|&nbsp;',
            );
        }echo json_encode($result);
        }
    }
    
    public function onloanlist(){
        if($this->session->userdata('admin_logged_in')){ 
        $fetch = $this->SystemDB->onloan_list();
        foreach ($fetch as $key => $value) {
            if($value['status'] == 0){
                    $status = '<span class="tag fg-white bg-indigo">Pending</span>';
                }elseif($value['status'] == 1){
                    $status = '<span class="tag fg-white bg-blue">Processing</span>';
                }elseif($value['status'] == 2){
                    $status = '<span class="tag fg-white bg-lightGreen">Approved</span>';
                }else{
                    $status = '<span class="tag fg-white bg-red">Onloan</span>';
                }
            $result['data'][$key] = array(
                '' . $value['id'] . '',
                '' . $value['date_reserve'] . '',
                '' . $value['due_date'] . '',
                '' . $value['name'] . '',
                '' . $value['grade'] . '',
                '' . $value['subject_area'] . '',
                '' . $value['section_track'] . '',
                '' . $value['callno'] . '',
                '' . $value['accession'] . '',
                '' . $value['title'] . '',
                '' . $value['author'] . '',
                '' . $value['type'] . '',
                $status,
                '<a href="changeStatus?access='.$value['access'].'&a=0" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-undo fg-indigo" title="Pending"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=1" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-eye fg-blue" title="Process"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=2" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-checkmark fg-lightGreen" title="Approved"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=3&d=3" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-calendar fg-lightGreen" title="3-Days"></span></a>
                &nbsp;|&nbsp;
                <a href="changeStatus?access='.$value['access'].'&a=3&d=5" onclick="showSwal(&#39;success-message&#39;)"><span class="mif-calendar fg-orange" title="5-Days"></span></a>
                &nbsp;|&nbsp;',
            );
        }echo json_encode($result);
        }
    }

    public function changeStatus(){
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $online = array('user' => $this->SystemDB->online_check(1));
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            $val = $this->input->get('a');
            $days = $this->input->get('d');
            $trancDate = array("mm" => date('m'), "dd" => date('d'), 'yr' => date('Y'));
            
            $access = $this->input->get('access');
            $rcallno = $this->SystemDB->getcallbook($access);
            if($val == 0){ 
                $data = array('status' => $val,);
                $s = $rcallno + 1;
                $cs = array('copies' => $s,);
                $this->SystemDB->deduct($cs,$access); 
                $this->SystemDB->updateStatus($data,$access);
            }elseif($val == 1){
                $data = array('status' => $val,);
                $s = $rcallno - 1;
                $cs = array('copies' => $s,);
                $this->SystemDB->deduct($cs,$access); 
                $this->SystemDB->updateStatus($data,$access);
            }else{
                if($days == 3){
                    
                    $trancID = $trancDate['mm'] . '/' .$trancDate['dd']. '/' . $trancDate['yr'];
                    $ssd = date('m/d/Y', strtotime($trancID. ' + 3 days'));
                    $data = array('status' => $val,'due_date' => $ssd);
                    $this->SystemDB->updateStatus($data,$access);
                }elseif($days == 5){
                     $trancID = $trancDate['mm'] . '/' .$trancDate['dd']. '/' . $trancDate['yr'];
                    $ssd = date('m/d/Y', strtotime($trancID. ' + 5 days'));
                    
                    $data = array('status' => $val,'due_date' => $ssd);
                    $this->SystemDB->updateStatus($data,$access);
                }else{
                    $data = array('status' => $val,);
                    $this->SystemDB->updateStatus($data,$access);
                }
            }   
            redirect('ElibrarySystem/transactions', 'refresh');
 
        } else {
            redirect('Elogin', 'refresh');
        }
    }

    

    public function checkPass() {
        $_SESSION['last_login_timestamp'] = time();
        $user_id = $this->input->get('user_id');
        $oldpass = strip_tags(xss_clean($this->input->post('oldpassword')));
        $newpass = strip_tags(xss_clean($this->input->post('newpassword')));
        $rpass = strip_tags(xss_clean($this->input->post('rpassword')));
        $allpass = $this->SystemDB->allPass($user_id);
        $new = strip_tags(xss_clean($this->input->post('newpassword')));
        $sNew = $this->bcrypt->hash_password($new);
        foreach ($allpass as $value) {
            $dt = array(
                'password' => $value->password
            );
        }

        if ($rpass == $newpass) {
            if ($oldpass != $newpass) {
                if ($this->bcrypt->check_password($oldpass, $dt['password'])) {
                    if ($new != null) {
                        $pdata = array('password' => $sNew);
                        $this->SystemDB->changePass($pdata, $user_id);
                        $this->form_validation->set_message('checkPass', 'Password Updated!');
                        return FALSE;
                    } else {
                        $this->form_validation->set_message('checkPass', 'Tags not allowed.');
                        return FALSE;
                    }
                } else {
                    $this->form_validation->set_message('checkPass', 'Password Failed to Update. Current Password Wrong');
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('checkPass', 'Please Dont use same password.');
                return FALSE;
            }
        } else {
            $this->form_validation->set_message('checkPass', 'Confirm Password does not match to New Password.');
            return FALSE;
        }
    }

    public function upEmail() {
        $_SESSION['last_login_timestamp'] = time();
        $id = $this->session->userdata('id');
        $fetch = $this->SystemDB->fetch_where($id);
        $email = $this->input->post('newemail');
        $remail = $this->input->post('remail');

        foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                );
            }

        $info = array(
            'email' => $email, 
        );

        if($email != $remail){
             $this->form_validation->set_message('upEmail', 'Email Not Match.');
             return False;
        }else{
            $this->SystemDB->updateEmail($info,$data['id']);
            $this->form_validation->set_message('upEmail', 'Email Updated!');
            return False;
        }  
    }

    public function booklist(){
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $online = array('user' => $this->SystemDB->online_check(1));
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            $user_id = $this->input->get('user_id');
            $var = $this->input->post('search');
            $books = $this->SystemDB->list($var);
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                    'std' => $value->student_num
                );
            }
            
            $getStdChat = $this->SystemDB->getStdChatSts($data['std']);
            if($getStdChat == null){
                $newstdchat = '';
            }else{
                $newstdchat = '<span class="mif-mail mif-2x mif-ani-shake mif-ani-slow fg-red"></span>';
            }

            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }
            

            $parent_data = array('newstdchat' => $newstdchat,'book' => $books,'user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send, 'user_id' => $user_id);


            $this->load->view('includes/headers/header-student', $parent_data);
            $this->load->view('Student/Books', $parent_data);
            $this->load->view('includes/footers/footer-subaccounts'); 
        } else {
            redirect('Elogin', 'refresh');
        }
    }

    public function my_books() {
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $online = array('user' => $this->SystemDB->online_check(1));
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            $user_id = $this->input->get('user_id');
            $name = $this->session->userdata('name');
            print_r($name);
            echo $name;
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                'std' => $value->student_num
                );
            }
            
            $getStdChat = $this->SystemDB->getStdChatSts($data['std']);
            if($getStdChat == null){
                $newstdchat = '';
            }else{
                $newstdchat = '<span class="mif-mail mif-2x mif-ani-shake mif-ani-slow fg-red"></span>';
            }


            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }
            

            $parent_data = array('newstdchat' => $newstdchat,'user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send, 'user_id' => $user_id, 'name' => $name);


          
            $this->load->view('includes/headers/header-student', $parent_data);
            $this->load->view('Student/mybooks', $parent_data);
            $this->load->view('includes/footers/footer-subaccounts'); 
        
        } else {
            redirect('Elogin', 'refresh');
        }
    }

    public function mybooklist(){
        if($this->session->userdata('admin_logged_in')){
        $id = $this->session->userdata('id');
        $info = $this->SystemDB->fetch_where($id);
            foreach ($info as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }
         date_default_timezone_set("Asia/Manila");
            $trancDate = array("mm" => date('m'), "dd" => date('d'), 'yr' => date('Y'));
            $trancID = $trancDate['mm'] . '/' . $trancDate['dd'] . '/' . $trancDate['yr'];
            $pt = $trancDate['mm'] . '' . $trancDate['dd'];
        $fetch = $this->SystemDB->mybooklist($data['name']);
        $text = '';
        foreach ($fetch as $key => $value) {
            if($value['status'] == 0){
                    $status = '<span class="tag fg-white bg-indigo">Pending</span>';
                }elseif($value['status'] == 1){
                    $status = '<span class="tag fg-white bg-blue">Processing</span>';
                }elseif($value['status'] == 2){
                    $status = '<span class="tag fg-white bg-lightGreen">Approved</span>';
                }elseif($value['status'] == 3){
                    $status = '<span class="tag fg-white bg-green">Access Granted</span>';
                }else{
                    $status = '<span class="tag fg-white bg-yellow">Access Expired</span>';
                }
                
                
                $cd = intval(str_replace('/', '',$trancID));
                $dd = intval(str_replace('/', '',$value['due_date']));
                $rd = intval(str_replace('/', '',$value['date_reserve']));
                
                
                if($value['due_date'] != null){
                    if($cd < $dd){
                       $sd = $value['accession'];
                    $text = '<a href="viewbook?file=../resources/'.$sd.'.pdf" target="_blank"><span class="mif-file-text" title="View PDF"></span></a>';
                    }else{
                        $text = '<span class="tag fg-white bg-red">Expired</span>';
                       
                    }
                }else{
                    $text = '';
                }
            $result['data'][$key] = array(
                '' . $value['id'] . '',
                '' . $value['date_reserve'] . '',
                '' . $value['due_date'] . '',
                '' . $value['name'] . '',
                '' . $value['callno'] . '',
                '' . $value['title'] . '',
                '' . $value['author'] . '',
                '' . $value['type'] . '',
                $status,
                $text
            );
        }echo json_encode($result);
        }
    }

    public function events() {
        if ($this->session->userdata('admin_logged_in')) {
            $_SESSION['last_login_timestamp'] = time();
            $online = array('user' => $this->SystemDB->online_check(1));
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            $user_id = $this->input->get('user_id');
            $name = $this->session->userdata('name');
            print_r($name);
            echo $name;
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                );
            }
            
            $getChat = $this->SystemDB->getChatSts();
            if($getChat == null){
                $newchat = '';
            }else{
                $newchat = '<span class="mif-mail mif-ani-ring mif-ani-slow fg-red">'.$getChat.'</span>';
            }
        
            if ($data['status'] == 1) {
                $stat['status'] = 'Administrator';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';

            }elseif($data['status'] == 2){
                $stat['status'] = 'Librarian';
                $send['link'] = '<li><a href="catalog">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Catalog Items</span>
                                </a></li>
                                <li><a href="transactions">
                                    <span class="mif-books icon" title="Catalog Items"></span>
                                    <span class="title">Transactions</span>
                                </a></li>
                                <li><a href="accounts">
                                    <span class="mif-profile icon" title="Catalog Items"></span>
                                    <span class="title">User Accounts</span>
                                </a></li><li><a href="events">
                                    <span class="mif-calendar icon" title="Configurations"></span>
                                    <span class="title">Events Calendar</span>
                                </a></li><li><a href="page_configurations">
                                    <span class="mif-cog icon" title="Configurations"></span>
                                    <span class="title">Page Configurations</span>
                                </a></li>';
            }elseif($data['status'] == 3){
                $stat['status'] = 'Teacher';
                $send['link'] = '';
            }else {
                $stat['status'] = 'Student';
                $send['link'] = '';
            }
            

            $parent_data = array('newchat' => $newchat,'user_log' => $data, 'online' => $online, 'stat' => $stat, 'send' => $send, 'user_id' => $user_id, 'name' => $name);
          
            $this->load->view('includes/headers/header', $parent_data);
            $this->load->view('Administrator/Events', $parent_data);
            $this->load->view('includes/footers/footer'); 
        
        } else {
            redirect('Elogin', 'refresh');
        }
    }

    Public function getEvents() {

        $result = $this->SystemDB->getEvents();
        echo json_encode($result);
    }

    /* Add new event */

    Public function addEvent() {
        $type = $this->input->post('type');
        $title = $this->input->post('title');
        $clock = $this->input->post('date');
        $desc = $this->input->post('description');
        $color = $this->input->post('color');
        $check = $this->SystemDB->checkEvent();
        foreach ($check as $value) {
            $info = array(
                'date' => $value->date
            );
        }
        if ($check == $info) {
            echo "<script>alert('qwe');</script>";
        }
        $data = array('title' => $title, 'description' => $desc, 'color' => $color, 'date' => $clock, 'type' => $type);
        $result = $this->SystemDB->addEvent($data);

        echo $result;
    }

    /* Update Event */

    Public function updateEvent() {
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $title = $this->input->post('title');
        $clock = $this->input->post('date');
        $desc = $this->input->post('description');
        $color = $this->input->post('color');
        $data = array('title' => $title, 'description' => $desc, 'color' => $color, 'date' => $clock, 'type' => $type);
        $result = $this->SystemDB->updateEvent($data, $id);
        echo $result;
    }
    
    Public function deleteEvent() {
        $id = $this->input->get('id');
        $result = $this->SystemDB->deleteEvent($id);
        echo $result;
    }

    Public function dragUpdateEvent() {
        $id = $this->input->post('id');
        $clock = $this->input->post('date');
        $data = array('date' => $clock);
        $result = $this->SystemDB->dragUpdateEvent($data, $id);
        echo $result;
    }

    public function viewbook(){
        $data = array('acc' => $this->input->get('file'));
        $this->load->view('Administrator/media',$data);
    }

    public function getEmail(){
            $name = $this->input->get('name');
            echo json_encode($this->SystemDB->checkEmail($name));
        
    }


    public function upload(){
        $file = $_FILES["file"]["tmp_name"];
        $file_open = fopen($file,"r");
        while (($csv = fgetcsv($file_open, 10000, ",")) !== FALSE)
        {
            $data['data'] = array(
                'user_id' => md5($csv[0]),
                'student_num' => $csv[0],
                'full_name' => $csv[1],
                'email' => $csv[2],
                'username' => $csv[3],
                'grade' => $csv[4],
                'password' => $csv[5],
                'Account_Status' => $csv[6],
                'status' => $csv[7],
                'online_status' => $csv[8],
                'Access_Token' => md5($csv[3])
        );  
          $result = $this->SystemDB->insertStudent($data);
        }
        if(!isset($result))
        {
            echo "<script type=\"text/javascript\">
                            alert(\"Invalid File:Please Upload CSV File.\");
                            window.location = \"index.php\"
                          </script>";
        }else{
            echo "<script type=\"text/javascript\">
                        alert(\"CSV File has been successfully Imported.\");
                        window.location = \"index.php\"
                    </script>";
        }
    }
    
    public function updateChatSts(){
       $user = $this->input->get('user');
       $up = array('chat_messages_status' => 'yes', 'chat_student_status' => 'no');
       $this->SystemDB->updateChatStatus($up, $user);
    }
    
    public function updateStdStatus(){
         $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
        foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                    'std' => $value->student_num,
                );
            }
            $up = array('chat_student_status' => "yes");
            $this->SystemDB->updateStudentSts($up, $data['std']);
    }
    
    public function ueblist(){
        $trancDate = array("mm" => date('m'), "dd" => date('d'), 'yr' => date('Y'));
        $trancID = ($trancDate['mm'] . '/' . $trancDate['dd'] . '/' . $trancDate['yr']);
        $fetch = $this->SystemDB->reserve_list();
        foreach ($fetch as $key => $value) {
            if($value['due_date'] == $trancID){
                $access = array('copies' => '1');
                $status = array('status' => '3');
                $this->SystemDB->uebbookstatus($status, $value['access']);
                $this->SystemDB->uebbook($access, $value['access']);
            }
        }
         redirect('ElibrarySystem/transactions');
    }
    
    
    public function logs(){
        if($this->session->userdata('admin_logged_in')){
            $id = $this->session->userdata('id');
            $fetch = $this->SystemDB->fetch_where($id);
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                    'std' => $value->student_num,
                );
            }
            $getchat = $this->SystemDB->logs();
            foreach ($getchat as $key => $values) {
            $result['data'][$key] = array(
                'log' => ''.$values['log'].'',
            );

        }echo json_encode($result);
        }
    }
    
    

    public function logout() {
        $user_id = $this->session->userdata('id');
        $fetch = $this->SystemDB->fetch_where($user_id);
        $logsd = $this->SystemDB->getlog();
        $trancDate = array("mm" => date('m'), "dd" => date('d'), 'yr' => date('Y'), "tm" => date("h:iA"));
        $trancID = $trancDate['mm'] . '/' . $trancDate['dd']  . '/' . $trancDate['yr'] . '&nbsp;' . $trancDate['tm'];
            foreach ($fetch as $value) {
                $data = array(
                    'id' => $value->user_id,
                    'user' => $value->username,
                    'status' => $value->status,
                    'name' => $value->full_name,
                    'email' => $value->email,
                    'std' => $value->student_num,
                    'date' => $trancID
                );
            }
        foreach($logsd as $teds){
                    $d = array('logsd' => $teds->log);
                    
                }
                 $nlog = "".$data['name']."&nbsp;-&nbsp;".$data['date']." - Logout&#13;&#10;";
                $text = $nlog.$d['logsd'];
                $send = array('log' => $text);
                $this->SystemDB->timestamp($send);
        $val = array('online_status' => '0');
        $this->LoginDB->logout($val, $user_id);
        $this->session->flashdata();
        session_destroy();
        redirect('ElibrarySystem', 'refresh');
    }



}
