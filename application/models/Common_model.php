<?php

/**
 * Common Model
 *
 * @author vinod
 * @copyright Bimarian
 *
 */
class Common_model extends CI_Model {

    

    //get all the records

    function getAllRecords($table, $where) {
        $result = array();
        
        $this->db->select('*');
        $this->db->from($table);
        if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        $query = $this->db->get();
		
        if ($query->num_rows()) {
            return $query->result_array();
        } else
            return false;
    }

    //get the Records

    function getRecords($table, $where, $page='') {
		$result = array();
        $rec_limit = 25;

        if (isset($page) && $page > 0) {
            $page = $page - 1;
            $offset = $rec_limit * $page;
        } else {
            $page = 0;
            $offset = 0;
        }
        if (!empty($where) && is_array($where) && count($where) > 0)
            $this->db->where($where);
        $query = $this->db->get($table);
        if ($query->num_rows()) {
            return $query->result_array();
        } else
            return false;
    }

    //get the total number or Records

    function getRecordsCount($table) {
        $query = $this->db->get($table);
        return $query->num_rows();
    }
	
	//get the single record

    function getRecord($table, $where) {
        if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        $query = $this->db->get($table);
        if ($query->num_rows()) {
            return $query->row_array();
        } else
            return false;
    }

    //Insert a record

    public function insertRecord($table, $data) {
        if (empty($table) || !is_array($data) || count($data) < 1)
            return false;
        else {
            $query = $this->db->insert($table, $data);
            //echo $this->db->last_query();exit;
            if ($query)
                return $this->db->insert_id(); // return the inserted record id
            else
                return false;
        }
    }

    //Update a record

    public function updateRecord($table, $where, $data) {
        if (empty($table) || !is_array($data) || count($data) < 1)
            return false;
        else {
            if (!empty($where) && is_array($where))
                $this->db->where($where);
            $query = $this->db->update($table, $data);
            if ($query)
                return true;
            else
                return false;
        }
    }
	
	//Delete a record

    public function deleteRecord($table, $where) {
        if (empty($table))
            return false;
        else {
            if(is_array($where) && count($where)>0)
                $this->db->where($where);
            $query = $this->db->delete($table);
			if ($query)
                return true;
            else
                return false;
        }
    }

    //Check record exists or not

    public function checkRecordExist($table, $where) {
        if (empty($table))
            return false;
        if (!empty($where) && is_array($where))
            $this->db->where($where);
        $query = $this->db->get($table);
        if ($query->num_rows())
            return $query->num_rows();
        else
            return false;
    }
    
    //messages into session
    public function messageAction($msg, $type){
        //1 -- success ; 2 -- error
        if($type == 1) {
            $this->session->set_flashdata('msg_class','alert-success');
        }else if($type == 2){
            $this->session->set_flashdata('msg_class','alert-danger');
        }
        $this->session->set_flashdata('message',$msg);
        return true;
    }

	//send Mail
    
    public function sendMail($to, $subject, $data) {
        // PREPARE THE BODY OF THE MESSAGE
        $from = 'nagarajimakani@gmail.com';
        $message = '<html><body>';
        $message .= '<img src="http://css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" />';
        $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
        $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($data['name']) . "</td></tr>";
        $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($data['email']) . "</td></tr>";
        $message .= "<tr><td><strong>Phone Number:</strong> </td><td>" . strip_tags($data['phone']) . "</td></tr>";
        $message .= "<tr><td><strong>Address:</strong> </td><td>" . htmlentities(strip_tags($data['address'])) . "</td></tr>";

        if ($mandal_id != '') {
            $message .= "<tr><td><strong>Mandal Name:</strong> </td><td>" . strip_tags($data['mandal_id']) . "</td></tr>";
            $message .= "<tr><td><strong>Village Name:</strong> </td><td>" . strip_tags($data['village_id']) . "</td></tr>";
        }else{
            $message .= "<tr><td><strong>Category:</strong> </td><td>" . strip_tags($data['category']) . "</td></tr>";
        }
        $requirement = htmlentities($data['message']);

        $message .= "<tr><td><strong>Message:</strong> </td><td>" . $requirement . "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";

        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . strip_tags($to) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        if (mail($to, $subject, $message, $headers)) {
            echo 'Your message has been sent.';
            return true;
        } else {
            echo 'There was a problem sending the email.';
            return false;
        }

        // DON'T BOTHER CONTINUING TO THE HTML...
        die();
    }
}
