<?php

/**
 * AdminUser Model
 *
 * @author vinod
 * @copyright Vinod
 *
 */
class AdminUser_model extends CI_Model {
	
    	//Check User Exists or not
	
	function checkUser($username, $password) {
        
        $this->db->select('admin.*');
        $query = $this->db->get_where('admin', array('username' => $username, 'password' => MD5($password)));
        return $query;
    }
    
     //check password is matched or not

    public function checkOldPassword($password){
        $this->db->select('admin_id');
        $query = $this->db->get_where('admin',array('password' => MD5($password), 'admin_id' => $this->session->userdata['is_logged']['id']));
        if($query->num_rows()) 
            return true;
        else 
            return false;
    }
    
    
	
}