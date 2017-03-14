<?php

/**
 * Common Model
 *
 * @author vinod
 * @copyright Bimarian
 *
 */
class AdminLocalization_model extends CI_Model {

    //get all the villages

    function getVillages($where) {
        $result = array();
        
        $this->db->select('villages.*,mandals.name as mandal');
		$this->db->join('mandals','mandals.id = villages.mandal_id','left');
		$this->db->from('villages');
        if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        $query = $this->db->get();
		
        if ($query->num_rows()) {
            return $query->result_array();
        } else
            return false;
    }
    
    //get all the Contacts

    function getContacts($where='') {
        $result = array();
        
        $this->db->select('members.*,mandals.name as mandal,villages.name as village,auth_designation.name as designation');
		$this->db->join('mandals','mandals.id = members.mandal_id','left');
        $this->db->join('villages','villages.id = members.village_id','left');
        $this->db->join('auth_designation','auth_designation.id = members.designation_id','left');
		$this->db->from('members');
		if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        $query = $this->db->get();
		
        if ($query->num_rows()) {
            return $query->result_array();
        } else
            return false;
    }
	
	//get all the Developments data

    function getDevelopments($where) {
        $result = array();
        
        $this->db->select('developments.*,mandals.name as mandal, villages.name as village, departments.name as department');
		$this->db->join('mandals', 'mandals.id = developments.mandal_id','left');
		$this->db->join('villages', 'villages.id = developments.village_id','left');
		$this->db->join('departments', 'departments.id = developments.department_id','left');
		$this->db->from('developments');
        if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows()) {
            return $query->result_array();
        } else
            return false;
    }
    
    //get all the members

    function getVillageInformation($where='') {
        $result = array();
        
        $this->db->select('village_information.*,mandals.name as mandal,villages.name as village');
		$this->db->join('mandals','mandals.id = village_information.mandal_id','left');
        $this->db->join('villages','villages.id = village_information.village_id','left');
        $this->db->from('village_information');
		if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        $query = $this->db->get();
		
        if ($query->num_rows()) {
            return $query->result_array();
        } else
            return false;
    }
	
	//get all the Requirements


    function getRequirements($where='') {
        $result = array();
        
        $this->db->select('requirements.*,mandals.name as mandal,villages.name as village');
		$this->db->join('mandals','mandals.id = requirements.mandal_id','left');
        $this->db->join('villages','villages.id = requirements.village_id','left');
        $this->db->from('requirements');
		if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        $query = $this->db->get();
		
        if ($query->num_rows()) {
            return $query->result_array();
        } else
            return false;
    }
	


        
}
