<?php

/**
 * Common Model
 *
 * @author vinod
 * @copyright Vinod
 *
 */
class Localization_model extends CI_Model {

    //get all the Contacts data

    function getContacts($where, $page) {
        $result = array();
        $rec_limit = 25;

        if (isset($page) && $page > 0) {
            $page = $page - 1;
            $offset = $rec_limit * $page;
        } else {
            $page = 0;
            $offset = 0;
        }

        $this->db->select('members.*,mandals.name as mandal, villages.name as village, auth_designation.name as designation');
		$this->db->join('mandals', 'mandals.id = members.mandal_id','left');
		$this->db->join('villages', 'villages.id = members.village_id','left');
		$this->db->join('auth_designation', 'auth_designation.id = members.designation_id','left');
		$this->db->from('members');
        if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        $this->db->limit($rec_limit, $offset);
        $query = $this->db->get();
        if ($query->num_rows()) {  
            return $query->result_array();
        } else
            return false;
    }
	
	//get all the Developments data

    function getDevelopments($where, $page) {
        $result = array();
        $rec_limit = 25;

        if (isset($page) && $page > 0) {
            $page = $page - 1;
            $offset = $rec_limit * $page;
        } else {
            $page = 0;
            $offset = 0;
        }

        $this->db->select('developments.*,mandals.name as mandal, villages.name as village, departments.name as department');
		$this->db->join('mandals', 'mandals.id = developments.mandal_id','left');
		$this->db->join('villages', 'villages.id = developments.village_id','left');
		$this->db->join('departments', 'departments.id = developments.department_id','left');
		$this->db->from('developments');
        if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        $this->db->limit($rec_limit, $offset);
        $query = $this->db->get();
        if ($query->num_rows()) {
            return $query->result_array();
        } else
            return false;
    }
	
	//get all the Village Information data

    function getVillageInformation($where, $page) {
        $result = array();
        $rec_limit = 25;

        if (isset($page) && $page > 0) {
            $page = $page - 1;
            $offset = $rec_limit * $page;
        } else {
            $page = 0;
            $offset = 0;
        }

        $this->db->select('village_information.*,mandals.name as mandal, villages.name as village');
		$this->db->join('mandals', 'mandals.id = village_information.mandal_id','left');
		$this->db->join('villages', 'villages.id = village_information.village_id','left');
		$this->db->from('village_information');
        if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        $this->db->limit($rec_limit, $offset);
        $query = $this->db->get();
        if ($query->num_rows()) {
            return $query->result_array();
        } else
            return false;
    }


        
}
