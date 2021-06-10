<?php

class ElibraryDB extends CI_Model {
    
public function getattrb(){
    $query = $this->db->get('attrb');
    return $query->result();
}
    
}

