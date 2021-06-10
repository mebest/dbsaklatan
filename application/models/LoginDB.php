<?php

class LoginDB extends CI_Model {

    public function login($username) {
        $this->db->select('*');
        $this->db->where('username', $username);
        $query = $this->db->get('acct_tbl');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function timestamp($data){
        $this->db->set($data);
        $this->db->where('id', 1);
        $this->db->update('dailylog');
    }
    
    public function getlog(){
        $this->db->select('log');
        $this->db->where('id', '1');
        $query = $this->db->get('dailylog');
        return $query->result();
    }
    
    public function onlogin($val, $user_id) {
        $this->db->set($val);
        $this->db->where('username', $user_id);
        $this->db->update('acct_tbl');
    }

    public function logout($val, $user_id){
        $this->db->set($val);
        $this->db->where('user_id', $user_id);
        $this->db->update('acct_tbl'); 
    }
    

}
