<?php

class SystemDB extends CI_Model {

   function fetch_where($id) {
        $this->db->where('user_id', $id);
        $query = $this->db->get('acct_tbl');
        return $query->result();
    }

   function online_check() {
        $where = "status!='3' AND status!='4' AND online_status='1'";
        $this->db->select('username');
        $this->db->where($where);
        $query = $this->db->get('acct_tbl');
        return $query->result();
    }
    
    function getChatSts(){
        $this->db->select('*');
        $this->db->where('chat_messages_status', "no");
        $query = $this->db->get('chat_messages');
        return $query->num_rows();
    }
    
    function getStdChatSts($user){
        $data = array('sender_id' => $user, 'chat_student_status' => 'no');
        $this->db->select('*');
        $this->db->where($data);
        $query = $this->db->get('chat_messages');
        return $query->result();
    }

    function lookupSearch($keyword) {
        $this->db->select('*')->from('catalog_items');
        $this->db->like('title', $keyword, 'both');
        $this->db->or_like('author', $keyword, 'both');
        $query = $this->db->get();
        return $query->result();
    }

    public function catalog_items() {
        $this->db->select('*');
        $query = $this->db->get('catalog_items');
        return $query->result_array();
    }
    
    public function material_items() {
        $this->db->select('*');
        $query = $this->db->get('material_item');
        return $query->result_array();
    }

    public function mybooklist($std) {
        $this->db->select('*');
        $this->db->where('name', $std);
        $query = $this->db->get('transactions');
        return $query->result_array();
    }

    public function reserve_list() {
        $this->db->select('*');
        $this->db->from('transactions');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function today_list($today) {
        $this->db->select('*');
        $this->db->where('date_reserve', $today);
        $this->db->from('transactions');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function processreserve_list() {
        $this->db->select('*');
        $this->db->where('status', '1');
        $this->db->from('transactions');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function apreserve_list() {
        $this->db->select('*');
        $this->db->where('status', '2');
        $this->db->from('transactions');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function onloan_list() {
        $this->db->select('*');
        $this->db->where('status', '3');
        $this->db->from('transactions');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function account_list(){
        $this->db->where("status", 4);
        $this->db->from('acct_tbl');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function account_teachers(){
        $this->db->where("status", 3);
        $this->db->from('acct_tbl');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function account_librarian(){
        $this->db->where("status", 2);
        $this->db->from('acct_tbl');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function chatlist(){
        $this->db->select('*');
        $this->db->order_by('chat_messages_status', 'ASC');
        $query = $this->db->get('chat_messages');
        return $query->result_array();
    }

    public function account_items() {

        
        $this->db->select('*');
$this->db->from('acct_tbl');
$this->db->join('chat_messages', 'chat_messages.sender_id = acct_tbl.student_num');
$query = $this->db->get();
return $query->result_array();
    }
    
    /*public function account_chats() {
        $this->db->select('receiver_id');
        $this->db->where('receiver_id', 0);
        $this->db->from('chat_messages');
        return $query->result_array();
    }*/
    
    public function home_sliders() {
        $this->db->select('*');
        $query = $this->db->get('home_sliders');
        return $query->result_array();
    }

    public function home_sliderId($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('home_sliders');
        return $query->result();
    }

    public function catalog_callno($callno) {
        $this->db->select('*');
        $this->db->where('callno', $callno);
        $query = $this->db->get('catalog_items');
        return $query->result_array();
    }
    
    public function catalog_access($access) {
        $this->db->select('*');
        $this->db->where('access', $access);
        $query = $this->db->get('material_item');
        return $query->result_array();
    }

    public function checkEmail($name) {
        $this->db->select('email');
        $this->db->where('full_name', $name);
        $query = $this->db->get('acct_tbl');
        $result = $query->row();
        return $result->email;
    }

    public function home_welcome() {
        $this->db->select('*');
        $query = $this->db->get('home_welcome');
        return $query->result_array();
    }

    public function checkcall($data){
        $this->db->where('callno', $data);
        $query = $this->db->get('catalog_items');
        $count_row = $query->num_rows();
        if ($count_row > 0) {
            return FALSE;
        }else{
            return TRUE;
        }
    }
    
    public function checkacc($data){
        $this->db->where('accession', $data);
        $query = $this->db->get('material_item');
        $count_row = $query->num_rows();
        if ($count_row > 0) {
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function view_item($access) {
        $this->db->select('*');
        $this->db->where('access', $access);
        $query = $this->db->get('catalog_items');
        return $query->result();
    }
    
    public function avview_item($access) {
        $this->db->select('*');
        $this->db->where('access', $access);
        $query = $this->db->get('material_item');
        return $query->result();
    }

    public function getAcctStdNo($fullname){
        $this->db->select('student_num');
        $this->db->where('student_num', $fullname);
        $query = $this->db->get('acct_tbl');
        $result = $query->row();
        return $result->student_num;
    }

    public function mychat($data){
        $this->db->select('*');
        $this->db->where($data);
        $query = $this->db->get('chat_messages');
        return $query->result_array();
    }
    
    public function logs(){
        $this->db->select('*');
        $query = $this->db->get('dailylog');
        return $query->result_array();
    }

    public function chatthems($data){
        $this->db->select('*');
        $this->db->where('sender_id', $data);
        $query = $this->db->get('chat_messages');
        return $query->result_array();
    }

    public function chatstatus() {
        $this->db->select('chat_messages_status');
        $this->db->where('status', 4);
        $query = $this->db->get('chat_messages');
        return $query->result();
    }

    function list($keyword) {
        $this->db->select('*')->from('catalog_items');
        $this->db->like('title', $keyword, 'both');
        $query = $this->db->get();
        return $query->result();
    }

    public function getcallbook($access) {
        $this->db->select('copies');
        $this->db->where('access', $access);
        $query = $this->db->get('catalog_items');
        $result = $query->row();
        return $result->copies;
    }

    public function approvecount() {
        $this->db->select('*');
        $this->db->where('status', 2);
        $this->db->from('transactions');
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
    }
    public function deniedcount() {
        $this->db->select('*');
        $this->db->where('status', 3);
        $this->db->from('transactions');
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
    }
    
    public function catalogcount() {
        $this->db->select('*');
        $this->db->from('catalog_items');
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
    }
    
    public function studentscount() {
        $this->db->select('*');
        $this->db->where('status', '4');
        $this->db->where('online_status', '1');
        $this->db->from('acct_tbl');
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
    }
    
    public function educatorscount() {
        $this->db->select('*');
        $this->db->where('status', '3');
        $this->db->where('online_status', '1');
        $this->db->from('acct_tbl');
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
    }
    
    public function anncount() {
        $this->db->select('*');
        $this->db->where('type', '2');
        $this->db->from('events');
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
    }
    
    public function newrequestebook($date) {
        $this->db->select('*');
        $this->db->where('date_reserve >=', $date);
        $this->db->where('type', 'E-Book');
        $this->db->from('transactions');
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
    }
    
    public function newrequestphys($date) {
        $this->db->select('*');
        $this->db->where('date_reserve >=', $date);
        $this->db->where('type', 'Phys.B');
        $this->db->from('transactions');
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
    }
    
    public function newscount() {
        $this->db->select('*');
        $this->db->where('type', '1');
        $this->db->from('events');
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
    }

    public function getaccess() {
        $this->db->select('access');
        $query = $this->db->get('catalog_items');
        return $query->result();
    }

    public function getchat($id) {
        $this->db->select('*');
        $this->db->where('sender_id', $id);
        $query = $this->db->get('chat_messages');
        return $query->result();
    }

    public function getchatadmin($id) {
        $this->db->select('*');
        $this->db->where('sender_id', $id);
        $query = $this->db->get('chat_messages');
        return $query->result();
    }

    public function rollbackBook($callno) {
        $this->db->select('copies');
        $this->db->where('callno', $callno);
        $query = $this->db->get('catalog_items');
        return $query->result();
    }

    public function insert_catalog($data){
        $this->db->insert('catalog_items', $data);
    }
    
    public function insert_material($data){
        $this->db->insert('material_item', $data);
    }

    public function reserve($data){
        $this->db->insert('transactions', $data);
    }

    public function tray($data){
        $this->db->insert('tray', $data);
    }
    
    public function updateEmail($info, $id){
        $this->db->set($info);
        $this->db->where('user_id', $id);
        $this->db->update('acct_tbl');
    }

    public function chat($sender, $data){
         $this->db->set($data);
        $this->db->where('sender_id', $sender);
        $this->db->update('chat_messages');
    }

    public function chatAdmin($acct, $data){
         $this->db->set($data);
        $this->db->where('sender_id', $acct);
        $this->db->update('chat_messages');
    }

    public function insertnewchat($data){
         $this->db->insert('chat_messages', $data);
    }

    public function insertSlider($data){
        $this->db->insert('home_sliders', $data);
    }

    public function updatebookinfo($access, $data){
        $this->db->set($data);
        $this->db->where('access', $access);
        $this->db->update('catalog_items');
    }
    
    public function updatematerialinfo($access, $data){
        $this->db->set($data);
        $this->db->where('access', $access);
        $this->db->update('material_item');
    }

    public function lessbook($callno, $data){
        $this->db->set($data);
        $this->db->where('callno', $callno);
        $this->db->update('catalog_items');
    }

    public function updateSlider($data, $id){
        $this->db->where('id', $id);
        $this->db->update('home_sliders', $data);
    }

    public function updateWelcome($data){
        $this->db->set($data);
        $this->db->where('id', 1);
        $this->db->update('home_welcome');
    }

    public function removeSlider($id){
        $this->db->where('id', $id);
        $this->db->delete('home_sliders');
    }

    function allPass($id) {
        $this->db->select('password');
        $this->db->where('user_id', $id);
        $query = $this->db->get('acct_tbl');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function changePass($data, $id) {
        $this->db->set($data);
        $this->db->where('user_id', $id);
        $this->db->update('acct_tbl');
    }

    function deduct($data, $id) {
        $this->db->set($data);
        $this->db->where('access', $id);
        $this->db->update('catalog_items');
    }

    function updateStatus($data, $access) {
        $this->db->set($data);
        $this->db->where('access', $access);
        $this->db->update('transactions');
    }
    function updateBookStatus($data, $callno) {
        $this->db->set($data);
        $this->db->where('access', $access);
        $this->db->update('catalog_items');
    }

    function addEvent($event) {
        $this->db->insert('events', $event);
    }

    function deleteEvent($id) {
        $this->db->delete('events', array('id' => $id));
    }

    function updateEvent($event, $id) {
        $this->db->update('events', $event, array('id' => $id));
    }

    function dragUpdateEvent($event, $id) {
        $this->db->update('events', $event, array('id' => $id));
    }

    function events() {
        $this->db->select('*');
        $query = $this->db->get('events');
        return $query->result();
    }

    function getEvents() {
        $q = $this->db->get('events');

        return $q->result();
    }

    function getEventsById($id) {
        $x = $this->db->get_where('events', array('id' => $id));
        return $x->result();
    }

    function get_day($year, $month) {
        $events = array();

        $query = $this->db->select('*')->from('events')->like('date', "$year-$month")->get();

        $query = $query->result();

        foreach ($query as $row) {

            $day = (int) substr($row->date, 8, 2);
            $events[(int) $day] = $row->date;
        }

        return $events;
    }

    function display_events($date) {
        $x = $this->db->get_where('events', array('date' => $date));
        return $x->result();
    }

    function checkEvent() {
        $sql = "SELECT DATE_FORMAT(date,'%H:%i') TIMEONLY FROM events";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function eventann() {
        $this->db->select('*');
        $this->db->where('type', 2);
        $this->db->order_by('date', 'DESC');
        $query = $this->db->get('events');
        return $query->result();   
    }

    function eventnews() {
        $this->db->select('*');
        $this->db->where('type', '1');
        $this->db->order_by('date', 'DESC');
        $query = $this->db->get('events');
        return $query->result();   
    }

    function updateStatusAccount($data, $id) {
        $this->db->set($data);
        $this->db->where('user_id', $id);
        $this->db->update('acct_tbl');
    }
    
    function updateChatStatus($up, $user){
        $this->db->set($up);
        $this->db->where('sender_id', $user);
        $this->db->update('chat_messages');
    }
    
    function updateStudentSts($up, $user){
        $this->db->set($up);
        $this->db->where('sender_id', $user);
        $this->db->update('chat_messages');
    }
    
    function uebbook($val, $access){
        $this->db->set($val);
        $this->db->where('access', $access);
        $this->db->update('catalog_items');
    }
    
    function uebbookstatus($val, $access){
        $this->db->set($val);
        $this->db->where('access', $access);
        $this->db->update('transactions');
    }

    function insertStudent($data)
    {
        $this->db->insert_batch('acct_tbl', $data);
        return false;
    }
    
    function getlog(){
        $this->db->select('log');
        $this->db->where('id', '1');
        $query = $this->db->get('dailylog');
        return $query->result();
    }
    
    public function timestamp($data){
        $this->db->set($data);
        $this->db->where('id', 1);
        $this->db->update('dailylog');
    }

}
