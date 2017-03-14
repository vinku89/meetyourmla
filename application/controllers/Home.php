<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        
        $this->load->model('common_model');
		$this->load->model('localization_model');
    }
	
	public function index() {
        $villagetable = 'villages';
		$departmenttable = 'departments';
        $where = array('status' => 1);
					
        $data['villages'] =  $this->common_model->getRecords($villagetable,$where);
		$data['departments'] =  $this->common_model->getRecords($departmenttable,$where);
        $this->load->view('frontend/index',$data);
    }

    public function contacts() {
        $madaltable = 'mandals';
        $villagetable = 'villages';
        $designationtable = 'auth_designation';
		$page='';
        $where = array('status'=>1);
        $data['mandals'] =  $this->common_model->getRecords($madaltable,$where);
		$data['villages'] =  $this->common_model->getRecords($villagetable,$where);
		$data['designations'] =  $this->common_model->getRecords($designationtable,$where);
		$data['contacts'] = $this->localization_model->getContacts(array(''),$page);
        $data['page_name'] = 'frontend/contact';
        //echo $this->db->last_query();die;
        $this->load->view('frontend/contact',$data);
    }

    public function getVillages() {		
		$table = 'villages';
		$data    = $this->input->post('result');		
		$data    = json_decode("$data", true);
		$this->db->where_in('mandal_id',$data);
		$this->db->where('status',1);
		$this->db->order_by("name","asc");
        $query = $this->db->get($table);
		
        if ($query->num_rows()) {
            $villages = $query->result_array();				
			echo json_encode($villages);
        } 
		else
            echo null;
    }
	
	public function getContacts() {		
		$table = 'members';
		$this->db->select('members.*,mandals.name as mandal, villages.name as village, auth_designation.name as designation');
		$this->db->join('mandals', 'mandals.id = members.mandal_id','left');
		$this->db->join('villages', 'villages.id = members.village_id','left');
		$this->db->join('auth_designation', 'auth_designation.id = members.designation_id','left');
		$this->db->from('members');
		$mandals    = $this->input->post('mandals');	
		$mandals    = json_decode("$mandals", true);
		if(isset($mandals) && count($mandals)>0){
			$this->db->where_in('members.mandal_id',$mandals);
		}
		$villages    = $this->input->post('villages');
		$villages    = json_decode("$villages", true);
		if(isset($villages) && count($villages)>0){
			$this->db->where_in('members.village_id',$villages);
		}
		$designations    = $this->input->post('designations');
		$designations    = json_decode("$designations", true);
		if(isset($designations) && count($designations)>0){
			$this->db->where_in('members.designation_id',$designations);
		}
		$this->db->where('members.status',1);
		$this->db->order_by("members.name","asc");
        $query = $this->db->get();
		
        if ($query->num_rows()) {
            $members = $query->result_array();				
			echo json_encode($members);
        } 
		else
            echo null;
    }

	//development
	
	public function developments() {
		$department_id = $this->uri->segment(3);
        $madaltable = 'mandals';
        $villagetable = 'villages';
        $departmenttable = 'departments';
		$page='';$where = array('status' => 1);
					
        $data['mandals'] =  $this->common_model->getRecords($madaltable,$where);
		$data['villages'] =  $this->common_model->getRecords($villagetable,$where);
		$data['departments'] =  $this->common_model->getRecords($departmenttable,$where);
		$where = '';
		if($department_id){
			$where = array('department_id'=> $department_id);
		}
		$data['developments'] = $this->localization_model->getDevelopments($where,$page);
        //echo $this->db->last_query();die;
        $this->load->view('frontend/developments',$data);
    }
	
	//development
	
	public function getDevelopmentsByAjaxFilter() {
		$department_id = $this->uri->segment(3);
        $table = 'developments';
		$this->db->select('developments.*,mandals.name as mandal, villages.name as village, departments.name as department');
		$this->db->join('mandals', 'mandals.id = developments.mandal_id','left');
		$this->db->join('villages', 'villages.id = developments.village_id','left');
		$this->db->join('departments', 'departments.id = developments.department_id','left');
		$this->db->from('developments');
		$mandals    = $this->input->post('mandals');	
		$mandals    = json_decode("$mandals", true);
		if(isset($mandals) && count($mandals)>0){
			$this->db->where_in('developments.mandal_id',$mandals);
		}
		$villages    = $this->input->post('villages');
		$villages    = json_decode("$villages", true);
		if(isset($villages) && count($villages)>0){
			$this->db->where_in('developments.village_id',$villages);
		}
		if($department_id){
			$where = array('developments.department_id'=> $department_id);
		}
		$this->db->where('developments.status',1);
		$this->db->order_by("developments.contrator","asc");
        $query = $this->db->get();
		
        if ($query->num_rows()) {
            $members = $query->result_array();				
			echo json_encode($members);
        } 
		else
            echo null;
		
    }

	//Villages
	
	public function villages() {
		$village_id = $this->uri->segment(3);
        $villagetable = 'villages';
		$departmenttable = 'departments';
        $page='';$where = array('status' => 1);
					
        $data['villages'] =  $this->common_model->getRecords($villagetable,$where);
		$data['departments'] =  $this->common_model->getRecords($departmenttable,$where);
		if($village_id){
			$where = array('village_information.id'=> $village_id);
		}
		$data['villageInfo'] = array_shift($this->localization_model->getVillageInformation($where,$page));
        //echo $this->db->last_query();die;
        $this->load->view('frontend/villages',$data);
    }
	
	//About 
	
	public function about() {
		$villagetable = 'villages';
		$departmenttable = 'departments';
        $where = array('status' => 1);
					
        $data['villages'] =  $this->common_model->getRecords($villagetable,$where);
		$data['departments'] =  $this->common_model->getRecords($departmenttable,$where);
		$this->load->view('frontend/aboutus',$data);
    }
	
	//About 
	
	public function investment() {
		$villagetable = 'villages';
		$departmenttable = 'departments';
		if(isset($_POST) && $_POST['investmentPost'] == 'Submit'){
			$ignore_data = array('investmentPost');
			$update_data = array();
			foreach ($this->input->post() as $key => $value) {
				if (!array_key_exists($key, $update_data) && !in_array($key, $ignore_data)) {
					$update_data[$key] = $value;
				}
			}
			$result = $this->common_model->insertRecord('investments', $update_data); // params :tablename,data
			if ($result){
				$subject = 'Investment Mail From User';
				$this->common_model->sendMail($update_data['email'],$subject,$update_data);
				$this->common_model->messageAction('Details sent Successfully.Admin team will Contact you Soon.', 1);
			}
			unset($_POST);
		}
        $where = array('status' => 1);
		$data['villages'] =  $this->common_model->getRecords($villagetable,$where);
		$data['departments'] =  $this->common_model->getRecords($departmenttable,$where);
		$this->load->view('frontend/investment',$data);
    }
	
	//About 
	
	public function requirement() {
		$madaltable = 'mandals';
		$villagetable = 'villages';
		$departmenttable = 'departments';
		if(isset($_POST) && $_POST['requirementPost'] == 'Submit'){
			$ignore_data = array('requirementPost');
			$update_data = array();
			foreach ($this->input->post() as $key => $value) {
				if (!array_key_exists($key, $update_data) && !in_array($key, $ignore_data)) {
					$update_data[$key] = $value;
				}
			}
			
			$result = $this->common_model->insertRecord('requirements', $update_data); // params :tablename,data
			if ($result){
				$subject = 'Requirement Mail From User';
				$this->common_model->sendMail($update_data['email'],$subject,$update_data);
				$this->common_model->messageAction('Requirement Mail sent Successfully', 1);
			}
			unset($_POST);
		}
        $where = array('status' => 1);
		$data['mandals'] =  $this->common_model->getRecords($madaltable,$where);
        $data['villages'] =  $this->common_model->getRecords($villagetable,$where);
		$data['departments'] =  $this->common_model->getRecords($departmenttable,$where);
		$this->load->view('frontend/requirement',$data);
    }
}
