<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AdminLocalization extends CI_Controller {

    public $suc_msg='';
    public $err_msg='';
    function __construct() {
        // Construct the parent class
        parent::__construct();
         
        $this->load->model('common_model');
        $this->load->model('adminLocalization_model');
	}

    //get all the mandals

    public function mandals() {
        $data['mandals'] = array();
        $where = array();
        $result = $this->common_model->getAllRecords('mandals', $where);
        if ($result)
            $data['mandals'] = $result;

        $this->load->view('admin/mandals', $data);
    }

    //Add Mandal

    public function addMandal() {
        $data = array();
        if (isset($_POST['mandalPost']) && $_POST['mandalPost'] == 'Submit') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Mandal Name', 'trim|required|alpha_numeric_spaces|max_length[25]|is_unique[mandals.name]');
            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->error_array();
                $i = 0;
                foreach ($errors as $key => $value) {
                    $error[$i] = $value;
                    $i++;
                }
            } else {
				$data = array('name' => trim($this->input->post('name')));
                $result = $this->common_model->insertRecord('mandals', $data); // params :tablename,data
                    if ($result) {
                        $this->common_model->messageAction('Mandal Added Successfully',1);
                        redirect(base_url('adminLocalization/mandals'));
                    } else {
                        $this->common_model->messageAction('Mandal Not added',2);
                    }
                
                unset($_POST);
            }
        }
              
        $this->load->view('admin/addMandal', $data);
    }
	
	//update Mandal Data
	
	public function editMandal() {
        $data = array();
		$id = $this->uri->segment(3);
		$where = array('id' => $id);
        if (isset($_POST['mandalPost']) && $_POST['mandalPost'] == 'Submit') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Mandal Name', 'trim|required|alpha_numeric_spaces|max_length[25]');
            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->error_array();
                $i = 0;
                foreach ($errors as $key => $value) {
                    $error[$i] = $value;
                    $i++;
                }
            } else {
				
				$data = array('name' => trim($this->input->post('name')));
                $result = $this->common_model->updateRecord('mandals', $where, $data); // params :tablename,data
                    if ($result) {
                        $this->common_model->messageAction('Mandal Data Updated Successfully',1);
                        redirect(base_url('adminLocalization/mandals'));
                    } else {
                        $this->common_model->messageAction('Mandal Data Not Updated',2);
                    }
                
                unset($_POST);
            }
        }
        $data['mandal'] = $this->common_model->getRecord('mandals', $where);
		
        $this->load->view('admin/editMandal', $data);
    }

    //delete Mandal

    public function deleteMandal() {
        $mandal_id = $this->uri->segment(3);

        if ($mandal_id > 0 && $mandal_id != '') {
            $where = array('id' => $mandal_id);
            $result = $this->common_model->deleteRecord('mandals', $where);
            if ($result) {
                $this->common_model->messageAction('Deleted Successfully',1);
            } else {
                $this->common_model->messageAction('Not Deleted',2);
            }
        } else {
            $this->common_model->messageAction('Invalid Mandal ID',2);
        }
        redirect(base_url('adminLocalization/mandals'));
    }
	
	//export Mandals into excelsheet

    public function exportMandals(){
        $id = '';$page='';$flag = false;
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Mandals');
		$where = array();
        $mandals = $this->common_model->getAllRecords('mandals', $where);
                
        // get all deliveryRates in array format
        $mandal[0]['A']='Sno';    $mandal[0]['B']='Mandal ID';   $mandal[0]['C']='Name';   $mandal[0]['D']='Status'; 
        
        if(count($mandals)>0 && is_array($mandals)){
          foreach($mandals as $key => $value){
              $mandal[$key+1]['A'] = $key+1;
			  $mandal[$key+1]['B'] = $value['id'];
              $mandal[$key+1]['C'] = ucwords($value['name']);
              $mandal[$key+1]['D'] = $value['status'];
          }
        }
        
        // read data to active sheet
        $this->excel->getActiveSheet()->fromArray($mandal);
 
        $filename='mandals.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

	//import Mandals excel file into the database (formats .xls,.xlsx)

    public function importMandals(){
          
          if(isset($_POST['Import_mandals']) && $_POST['Import_mandals'] == 'Import')
          {
              $file = $_FILES['mandals']['tmp_name'];
              $handle = fopen($file, "r");
              $c = 0;$flag = false;
              $this->db->query("TRUNCATE TABLE mandals");
              $this->load->library('excel');
              $objPHPExcel = PHPExcel_IOFactory::load($file);
              $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
              $dataCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet>0
              if($dataCount>0){
                    for($i=2;$i<=$dataCount;$i++)
                    {
                        $result['name'] = isset($allDataInSheet[$i]['C'])?$allDataInSheet[$i]['C']:'';
                        $result['status'] = isset($allDataInSheet[$i]['D'])?$allDataInSheet[$i]['D']:'';
                        		
                        if(is_array($result) && count($result)>0)
                        {
                            $sql = $this->common_model->InsertRecord('mandals',$result); 
                            if(!$sql){
                              $err_msg = "Some Error Occured in importing..upload again.";
                            }else{
                              $suc_msg = 'Mandals Imported Successfully.'; 
                            }
                        }
                    }
                  }
             }
          
          redirect(base_url('adminLocalization/mandals'));exit;
    } 

    //get all the villages

    public function villages() {
        $data['villages'] = array();
        $where = array();
        $result = $this->adminLocalization_model->getVillages($where);

        if ($result)
            $data['villages'] = $result;

        $this->load->view('admin/villages', $data);
    }

    //Add village

    public function addVillage() {
        $data = array();
        if (isset($_POST['villagePost']) && $_POST['villagePost'] == 'Submit') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Village Name', 'trim|required|alpha_numeric_spaces|max_length[25]');
            $this->form_validation->set_rules('mandal_id', 'Select Mandal', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->error_array();
                $i = 0;
                foreach ($errors as $key => $value) {
                    $error[$i] = $value;
                    $i++;
                }
            } else {
                $name = trim($this->input->post('name'));
                $mandal_id = trim($this->input->post('mandal_id'));
                $records = $this->common_model->checkRecordExist('villages', array('name' => $name, 'mandal_id' => $mandal_id));
                
				$update_data = array();$ignore_data = array('villagePost');
				foreach($this->input->post() as $key => $value){
                    if(!array_key_exists($key, $update_data) && !in_array($key,$ignore_data)){
                        $update_data[$key] = $value;
                    }
                }
                if (!$records) {
                    $result = $this->common_model->insertRecord('villages', $update_data); // params :tablename,data
                    if ($result) {
                        $this->common_model->messageAction('Village Added Successfully',1);
                        unset($_POST);
                        redirect(base_url('adminLocalization/villages'));
                    } else {
                        $this->common_model->messageAction('Village Not added',2);
                    }
                } else {
                    $this->common_model->messageAction('Village Already exists',2);
                }
                unset($_POST);
            }
        }
        
        $data['mandals'] = $this->common_model->getAllRecords('mandals', array());
        $this->load->view('admin/addVillage', $data);
    }

    //delete Village

    public function deleteVillage() {
        $id = $this->uri->segment(3);

        if ($id > 0 && $id != '') {
            $where = array('id' => $id);
            $result = $this->common_model->deleteRecord('villages', $where);
            if ($result) {
                $this->common_model->messageAction('Deleted Successfully',1);
            } else {
                $this->common_model->messageAction('Not Deleted',2);
            }
        } else {
            $this->common_model->messageAction('Invalid Village ID',2);
        }
        redirect(base_url('adminLocalization/villages'));
    }
	
	//export Villages into excelsheet

    public function exportVillages(){
        $id = '';$page='';$flag = false;
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Villages');
		$where = array();
        $villages = $this->adminLocalization_model->getVillages($where);
                
        // get all villages in array format
        $village[0]['A']='Sno';    $village[0]['B']='Village ID';   $village[0]['C']='Village Name';  $village[0]['D']='Mandal ID';   $village[0]['E']='Mandal Name';   $village[0]['F']='Status'; 
        
        if(count($villages)>0 && is_array($villages)){
          foreach($villages as $key => $value){
              $village[$key+1]['A'] = $key+1;
			  $village[$key+1]['B'] = $value['id'];
              $village[$key+1]['C'] = ucwords($value['name']);
			  $village[$key+1]['D'] = $value['mandal_id'];
              $village[$key+1]['E'] = ucwords($value['mandal']);
              $village[$key+1]['F'] = $value['status'];
          }
        }
        
        // read data to active sheet
        $this->excel->getActiveSheet()->fromArray($village);
 
        $filename='villages.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

	//import Villages excel file into the database (formats .xls,.xlsx)

    public function importVillages(){
          
          if(isset($_POST['Import_villages']) && $_POST['Import_villages'] == 'Import')
          {
              $file = $_FILES['village']['tmp_name'];
              $handle = fopen($file, "r");
              $c = 0;$flag = false;
              $this->db->query("TRUNCATE TABLE villages");
              $this->load->library('excel');
              $objPHPExcel = PHPExcel_IOFactory::load($file);
              $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
              $dataCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet>0
              if($dataCount>0){
                    for($i=2;$i<=$dataCount;$i++)
                    {
                        $result['name'] = isset($allDataInSheet[$i]['C'])?$allDataInSheet[$i]['C']:'';
						$result['mandal_id'] = isset($allDataInSheet[$i]['D'])?$allDataInSheet[$i]['D']:'';
						$result['status'] = isset($allDataInSheet[$i]['F'])?$allDataInSheet[$i]['F']:'';
                        		
                        if(is_array($result) && count($result)>0)
                        {
                            $sql = $this->common_model->InsertRecord('villages',$result); 
                            if(!$sql){
                              $err_msg = "Some Error Occured in importing..upload again.";
                            }else{
                              $suc_msg = 'Villages Imported Successfully.'; 
                            }
                        }
                    }
                  }
             }
          
          redirect(base_url('adminLocalization/villages'));exit;
    } 

    //get all the Departments

    public function departments() {
        $data['departments'] = array();
        $where = array();
        $result = $this->common_model->getAllRecords('departments', $where);

        if ($result)
            $data['departments'] = $result;

        $this->load->view('admin/departments', $data);
    }

    //Add Department

    public function addDepartment() {
        $data = array();
        $suc_msg = '';$err_msg = '';

        if (isset($_POST['departmentPost']) && $_POST['departmentPost'] == 'Submit') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Department Name', 'trim|required|max_length[50]|is_unique[departments.name]');
            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->error_array();
                $i = 0;
                foreach ($errors as $key => $value) {
                    $error[$i] = $value;
                    $i++;
                }
            } else {
                $name = trim($this->input->post('name'));
                $where = array('name' => $name);

                $records = $this->common_model->checkRecordExist('departments', $where);
                if ($records == 0) {
                    $result = $this->common_model->insertRecord('departments', array('name' => $name)); // params :tablename,data
                    if ($result) {
                        $this->common_model->messageAction('Department Added Successfully',1);
                        redirect(base_url('adminLocalization/departments'));
                    } else {
                        $this->common_model->messageAction('Department Not added',2);
                    }
                } else {
                    $this->common_model->messageAction('Department Already exists',2);
                }
                unset($_POST);
            }
        }
        
        $this->load->view('admin/addDepartment', $data);
    }

	//Update Department

    public function editDepartment() {
        $data = array();
        $id = $this->uri->segment(3);
		$where = array('id' => $id);
        if (isset($_POST['departmentPost']) && $_POST['departmentPost'] == 'Submit') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Department Name', 'trim|required|max_length[50]');
            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->error_array();
                $i = 0;
                foreach ($errors as $key => $value) {
                    $error[$i] = $value;
                    $i++;
                }
				
            } else {
				
                $name = trim($this->input->post('name'));
                
                $result = $this->common_model->updateRecord('departments', $where, array('name' => $name)); // params :tablename,data
                    if ($result) {
                        $this->common_model->messageAction('Department Updated Successfully',1);
                        redirect(base_url('adminLocalization/departments'));
                    } else {
                        $this->common_model->messageAction('Department Not Updated',2);
                    }
                
                unset($_POST);
            }
        }
        $data['department'] = $this->common_model->getRecord('departments', $where);
        $this->load->view('admin/editDepartment', $data);
    }
	
    //delete Department

    public function deleteDepartment() {
        $id = $this->uri->segment(3);

        if (!empty($id) && $id > 0) {
            $where = array('id' => $id);
            $result = $this->common_model->deleteRecord('departments', $where);
            if ($result) {
                $this->common_model->messageAction('Deleted Successfully',1);
            } else {
                $this->common_model->messageAction('Not Deleted',2);
            }
        } else {
            $this->common_model->messageAction('Invalid Department ID',2);
        }
        redirect(base_url('adminLocalization/departments'));
    }
	
	//export Departments into excelsheet

    public function exportDepartments(){
        $id = '';$page='';$flag = false;
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Departments');
		$where = array();
        $departments = $this->common_model->getAllRecords('departments', $where);
                
        // get all department in array format
        $department[0]['A']='Sno';    $department[0]['B']='Department ID';   $department[0]['C']='Name';     $department[0]['D']='Status'; 
        
        if(count($departments)>0 && is_array($departments)){
          foreach($departments as $key => $value){
              $department[$key+1]['A'] = $key+1;
			  $department[$key+1]['B'] = $value['id'];
              $department[$key+1]['C'] = ucwords($value['name']);
              $department[$key+1]['D'] = $value['status'];
          }
        }
        
        // read data to active sheet
        $this->excel->getActiveSheet()->fromArray($department);
 
        $filename='departments.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

	//import Departments excel file into the database (formats .xls,.xlsx)

    public function importDepartments(){
          
          if(isset($_POST['Import_departments']) && $_POST['Import_departments'] == 'Import')
          {
              $file = $_FILES['departments']['tmp_name'];
              $handle = fopen($file, "r");
              $c = 0;$flag = false;
              $this->db->query("TRUNCATE TABLE departments");
              $this->load->library('excel');
              $objPHPExcel = PHPExcel_IOFactory::load($file);
              $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
              $dataCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet>0
              if($dataCount>0){
                    for($i=2;$i<=$dataCount;$i++)
                    {
                        $result['name'] = isset($allDataInSheet[$i]['C'])?$allDataInSheet[$i]['C']:'';
                        $result['status'] = isset($allDataInSheet[$i]['D'])?$allDataInSheet[$i]['D']:'';
                        		
                        if(is_array($result) && count($result)>0)
                        {
                            $sql = $this->common_model->InsertRecord('departments',$result); 
                            if(!$sql){
                              $err_msg = "Some Error Occured in importing..upload again.";
                            }else{
                              $suc_msg = 'Departments Imported Successfully.'; 
                            }
                        }
                    }
                  }
             }
          
          redirect(base_url('adminLocalization/mandals'));exit;
    }
	
	//get all the Designations

    public function designations() {
        $data['designations'] = array();
        $where = array();
		
        $result =  $this->common_model->getAllRecords('auth_designation', $where);

        if ($result)
            $data['designations'] = $result;

        $this->load->view('admin/designations', $data);
    }
	
	//Add Designation

    public function addDesignation() {
        $data = array();
        
        if (isset($_POST['designationPost']) && $_POST['designationPost'] == 'Submit') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Designation Name', 'trim|required|alpha_numeric_spaces|max_length[25]|is_unique[auth_designation.name]');
            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->error_array();
                $i = 0;
                foreach ($errors as $key => $value) {
                    $error[$i] = $value;
                    $i++;
                }
            } else {
                $name = trim($this->input->post('name'));
                $where = array('name' => $name);

                $records = $this->common_model->checkRecordExist('auth_designation', $where);
                if ($records == 0) {
                    $result = $this->common_model->insertRecord('auth_designation', array('name' => $name)); // params :tablename,data
                    if ($result) {
                        $this->common_model->messageAction('Designation Added Successfully',1);
                        redirect(base_url('adminLocalization/designations'));
                    } else {
                        $this->common_model->messageAction('Designation Not added',2);
                    }
                } else {
                    $this->common_model->messageAction('Designation Already exists',2);
                }
                unset($_POST);
            }
        }
        
        $this->load->view('admin/addDesignation', $data);
    }
	
	//Edit Designation

    public function editDesignation() {
        $data = array();
        $id = $this->uri->segment(3);
		$where = array('id' => $id);
        if (isset($_POST['designationPost']) && $_POST['designationPost'] == 'Submit') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Designation Name', 'trim|required|alpha_numeric_spaces|max_length[25]');
            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->error_array();
                $i = 0;
                foreach ($errors as $key => $value) {
                    $error[$i] = $value;
                    $i++;
                }
            } else {
                $name = trim($this->input->post('name'));
                
                $result = $this->common_model->updateRecord('auth_designation', $where, array('name' => $name)); // params :tablename,data
                    if ($result) {
                        $this->common_model->messageAction('Designation Updated Successfully',1);
                        redirect(base_url('adminLocalization/designations'));
                    } else {
                        $this->common_model->messageAction('Designation Not Updated',2);
                    }
                unset($_POST);
            }
        }
        $data['designation'] = $this->common_model->getRecord('auth_designation', $where);
        $this->load->view('admin/editDesignation', $data);
    }

    //delete Designation

    public function deleteDesignation() {
        $id = $this->uri->segment(3);

        if (!empty($id) && $id > 0) {
            $where = array('id' => $id);
            $result = $this->common_model->deleteRecord('auth_designation', $where);
            if ($result) {
                $this->common_model->messageAction('Deleted Successfully',1);
            } else {
                $this->common_model->messageAction('Not Deleted',2);
            }
        } else {
            $this->common_model->messageAction('Invalid Department ID',2);
        }
        redirect(base_url('adminLocalization/departments'));
    }
    
    //get all the contact persons 
    
    public function contacts() {
        $data['contacts'] = array();
        $where = array();
        $result = $this->adminLocalization_model->getContacts();
        if ($result)
            $data['contacts'] = $result;
        $this->load->view('admin/contacts', $data);
    }
    
    //get all the contact persons 
    
    public function addContact() {
        $data = array();
        $update_data = array();
        if (isset($_POST['contactPost']) && $_POST['contactPost'] == 'Submit') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_numeric_spaces|max_length[50]');
            $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|numeric|max_length[10]');
            $this->form_validation->set_rules('mandal_id', 'Select Mandal', 'trim|required');
            $this->form_validation->set_rules('village_id', 'Select Village', 'trim|required');
            $this->form_validation->set_rules('designation_id', 'Select Designation', 'trim|required');
            
            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->error_array();
                $i = 0;
                foreach ($errors as $key => $value) {
                    $error[$i] = $value;
                    $i++;
                }
            } else {
                $ignore_data = array('contactPost');
                foreach($this->input->post() as $key => $value){
                    if(!array_key_exists($key, $update_data) && !in_array($key,$ignore_data)){
                        $update_data[$key] = $value;
                    }
                }
				
                $mandal_id = trim($this->input->post('mandal_id'));
				$village_id = trim($this->input->post('village_id'));
				$designation_id = trim($this->input->post('designation_id'));
				
                $records = $this->common_model->checkRecordExist('members', array('mandal_id' => $mandal_id, 'village_id' => $village_id, 'designation_id' => $designation_id  ));
                
                if (!$records) {
                    $result = $this->common_model->insertRecord('members', $update_data); // params :tablename,data
                    if ($result) {
                        $this->common_model->messageAction('Contact Added Successfully',1);
                        unset($_POST);
                        redirect(base_url('adminLocalization/contacts'));
                    } else {
                        $this->common_model->messageAction('Contact Not added',2);
                    }
                } else {
                    $this->common_model->messageAction('Contact Already exists',2);
                }
                unset($_POST);
            }
        }
        
        $data['mandals'] = $this->common_model->getAllRecords('mandals', array());
        $data['designations'] = $this->common_model->getAllRecords('auth_designation', array());
        $this->load->view('admin/addContact', $data);
    }
    
    //delete Contact

    public function deleteContact() {
        $id = $this->uri->segment(3);

        if (!empty($id) && $id > 0) {
            $where = array('id' => $id);
            $result = $this->common_model->deleteRecord('members', $where);
            if ($result) {
                $this->common_model->messageAction('Deleted Successfully',1);
            } else {
                $this->common_model->messageAction('Not Deleted',2);
            }
        } else {
            $this->common_model->messageAction('Invalid Contact ID',2);
        }
        redirect(base_url('adminLocalization/contacts'));
    }
	
	//export Contacts into excelsheet

    public function exportContacts(){
        $id = '';$page='';$flag = false;
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Contacts');
		$where = array();
        $contacts = $this->adminLocalization_model->getContacts($where);
                
        // get all contacts in array format
        $contact[0]['A']='Sno';    $contact[0]['B']='Name';   $contact[0]['C']='Phone Number';  $contact[0]['D']='Village ID';   $contact[0]['E']='Village Name'; $contact[0]['F']='Mandal ID';   $contact[0]['G']='Mandal Name'; $contact[0]['H']='Designation ID';   $contact[0]['I']='Designation Name';  $contact[0]['J']='Status'; 
        
        if(count($contacts)>0 && is_array($contacts)){
          foreach($contacts as $key => $value){
              $contact[$key+1]['A'] = $key+1;
			  $contact[$key+1]['B'] = ucwords($value['name']);
              $contact[$key+1]['C'] = $value['phone'];
			  $contact[$key+1]['D'] = $value['village_id'];
              $contact[$key+1]['E'] = ucwords($value['village']);
			  $contact[$key+1]['F'] = $value['mandal_id'];
              $contact[$key+1]['G'] = ucwords($value['mandal']);
			  $contact[$key+1]['H'] = $value['designation_id'];
              $contact[$key+1]['I'] = ucwords($value['designation']);
              $contact[$key+1]['J'] = $value['status'];
          }
        }
        
        // read data to active sheet
        $this->excel->getActiveSheet()->fromArray($contact);
 
        $filename='contacts.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

	//import Contacts excel file into the database (formats .xls,.xlsx)

    public function importContacts(){
          
          if(isset($_POST['Import_contacts']) && $_POST['Import_contacts'] == 'Import')
          {
              $file = $_FILES['contact']['tmp_name'];
              $handle = fopen($file, "r");
              $c = 0;$flag = false;
              $this->db->query("TRUNCATE TABLE members");
              $this->load->library('excel');
              $objPHPExcel = PHPExcel_IOFactory::load($file);
              $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
              $dataCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet>0
              if($dataCount>0){
                    for($i=2;$i<=$dataCount;$i++)
                    {
                        $result['name'] = isset($allDataInSheet[$i]['B'])?$allDataInSheet[$i]['B']:'';
						$result['phone'] = isset($allDataInSheet[$i]['C'])?$allDataInSheet[$i]['C']:'';
						$result['village_id'] = isset($allDataInSheet[$i]['D'])?$allDataInSheet[$i]['D']:'';
						$result['mandal_id'] = isset($allDataInSheet[$i]['F'])?$allDataInSheet[$i]['F']:'';
						$result['designation_id'] = isset($allDataInSheet[$i]['H'])?$allDataInSheet[$i]['H']:'';
						$result['status'] = isset($allDataInSheet[$i]['K'])?$allDataInSheet[$i]['K']:'';
                        		
                        if(is_array($result) && count($result)>0)
                        {
                            $sql = $this->common_model->InsertRecord('members',$result); 
                            if(!$sql){
                              $err_msg = "Some Error Occured in importing..upload again.";
                            }else{
                              $suc_msg = 'Contacts Imported Successfully.'; 
                            }
                        }
                    }
                  }
             }
          
          redirect(base_url('adminLocalization/contacts'));exit;
    } 
	
	//get all the developments

    public function developments() {
        $data['developments'] = array();
        $where = array();
		
        $result =  $this->adminLocalization_model->getDevelopments($where);

        if ($result)
            $data['developments'] = $result;

        $this->load->view('admin/developments', $data);
    }
	
	//Addd the Development data 
    
    public function addDevelopment() {
        $data = array();
        $update_data = array();
        if (isset($_POST['developmentPost']) && $_POST['developmentPost'] == 'Submit') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('contrator', 'Contractor Name', 'trim|required|alpha_numeric_spaces|max_length[50]');
            $this->form_validation->set_rules('work', 'Work', 'trim|required|alpha_numeric_spaces|max_length[40]');
			$this->form_validation->set_rules('cost', 'Cost', 'trim|required|numeric|max_length[10]');
            $this->form_validation->set_rules('mandal_id', 'Select Mandal', 'trim|required');
            $this->form_validation->set_rules('village_id', 'Select Village', 'trim|required');
            $this->form_validation->set_rules('department_id', 'Select Department', 'trim|required');
            
            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->error_array();
                $i = 0;
                foreach ($errors as $key => $value) {
                    $error[$i] = $value;
                    $i++;
                }
            } else {
                $ignore_data = array('developmentPost');
                foreach($this->input->post() as $key => $value){
                    if(!array_key_exists($key, $update_data) && !in_array($key,$ignore_data)){
                        $update_data[$key] = $value;
                    }
                }
				
                $mandal_id = trim($this->input->post('mandal_id'));
				$village_id = trim($this->input->post('village_id'));
				$department_id = trim($this->input->post('department_id'));
				
                $records = $this->common_model->checkRecordExist('developments', array('mandal_id' => $mandal_id, 'village_id' => $village_id, 'department_id' => $department_id  ));
                
                if (!$records) {
                    $result = $this->common_model->insertRecord('developments', $update_data); // params :tablename,data
                    if ($result) {
                        $this->common_model->messageAction('Development Added Successfully',1);
                        unset($_POST);
                        redirect(base_url('adminLocalization/contacts'));
                    } else {
                        $this->common_model->messageAction('Development Not added',2);
                    }
                } else {
                    $this->common_model->messageAction('Development Already exists',2);
                }
                unset($_POST);
            }
        }
        
        $data['mandals'] = $this->common_model->getAllRecords('mandals', array());
        $data['departments'] = $this->common_model->getAllRecords('departments', array());
        $this->load->view('admin/addDevelopment', $data);
    }

    //delete Developments

    public function deleteDevelopment() {
        $id = $this->uri->segment(3);

        if (!empty($id) && $id > 0) {
            $where = array('id' => $id);
            $result = $this->common_model->deleteRecord('developments', $where);
            if ($result) {
                $this->common_model->messageAction('Deleted Successfully',1);
            } else {
                $this->common_model->messageAction('Not Deleted',2);
            }
        } else {
            $this->common_model->messageAction('Invalid Development ID',2);
        }
        redirect(base_url('adminLocalization/developments'));
    }
	
	//export Developments into excelsheet

    public function exportDevelopments(){
        $id = '';$page='';$flag = false;
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Developments');
		$where = array();
        $developments = $this->adminLocalization_model->getDevelopments($where);
                
        // get all contacts in array format
        $development[0]['A']='Sno';    $development[0]['B']='Contractor';   $development[0]['C']='Work'; $development[0]['D']='Cost'; $development[0]['E']='Department ID';   $development[0]['F']='Department Name'; $development[0]['G']='Village ID';   $development[0]['H']='Village Name'; $development[0]['I']='Mandal ID';   $development[0]['J']='Mandal Name';  $development[0]['K']='Status'; 
        
        if(count($developments)>0 && is_array($developments)){
          foreach($developments as $key => $value){
              $development[$key+1]['A'] = $key+1;
			  $development[$key+1]['B'] = ucwords($value['contrator']);
              $development[$key+1]['C'] = ucwords($value['work']);
			  $development[$key+1]['D'] = $value['cost'];
			  $development[$key+1]['E'] = $value['department_id'];
              $development[$key+1]['F'] = ucwords($value['department']);
			  $development[$key+1]['G'] = $value['village_id'];
              $development[$key+1]['H'] = ucwords($value['village']);
			  $development[$key+1]['I'] = $value['mandal_id'];
              $development[$key+1]['J'] = ucwords($value['mandal']);
			  $development[$key+1]['K'] = $value['status'];
          }
        }
        
        // read data to active sheet
        $this->excel->getActiveSheet()->fromArray($development);
 
        $filename='developments.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

	//import Development excel file into the database (formats .xls,.xlsx)

    public function importDevelopments(){
          
          if(isset($_POST['Import_developments']) && $_POST['Import_developments'] == 'Import')
          {
              $file = $_FILES['development']['tmp_name'];
              $handle = fopen($file, "r");
              $c = 0;$flag = false;
              $this->db->query("TRUNCATE TABLE developments");
              $this->load->library('excel');
              $objPHPExcel = PHPExcel_IOFactory::load($file);
              $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
              $dataCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet>0
              if($dataCount>0){
                    for($i=2;$i<=$dataCount;$i++)
                    {
                        $result['contrator'] = isset($allDataInSheet[$i]['B'])?$allDataInSheet[$i]['B']:'';
						$result['work'] = isset($allDataInSheet[$i]['C'])?$allDataInSheet[$i]['C']:'';
						$result['cost'] = isset($allDataInSheet[$i]['D'])?$allDataInSheet[$i]['D']:'';
						$result['department_id'] = isset($allDataInSheet[$i]['E'])?$allDataInSheet[$i]['E']:'';
						$result['village_id'] = isset($allDataInSheet[$i]['G'])?$allDataInSheet[$i]['G']:'';
						$result['mandal_id'] = isset($allDataInSheet[$i]['I'])?$allDataInSheet[$i]['I']:'';
						$result['status'] = isset($allDataInSheet[$i]['K'])?$allDataInSheet[$i]['K']:'';
                        		
                        if(is_array($result) && count($result)>0)
                        {
                            $sql = $this->common_model->InsertRecord('developments',$result); 
                            if(!$sql){
                              $err_msg = "Some Error Occured in importing..upload again.";
                            }else{
                              $suc_msg = 'Developments Imported Successfully.'; 
                            }
                        }
                    }
                  }
             }
          
          redirect(base_url('adminLocalization/developments'));exit;
    } 
	
    //get all the village Information
    
    public function villageInfos() {
        $data['villageInfos'] = array();
        $where = array();
        $result = $this->adminLocalization_model->getVillageInformation($where);
        if ($result)
            $data['villageInfos'] = $result;
        $this->load->view('admin/villageInformation', $data);
    }
    
    //get all the village Info
    
    public function addvillageInfo() {
        $data = array();
        $update_data = array();
        if (isset($_POST['villageInfoPost']) && $_POST['villageInfoPost'] == 'Submit') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('population', 'Population', 'trim|required|numeric');
            $this->form_validation->set_rules('houses', 'Houses', 'trim|required|numeric');
            $this->form_validation->set_rules('water', 'Water', 'trim|required|numeric');
            $this->form_validation->set_rules('hospitals', 'Hospitals', 'trim|required|numeric');
            $this->form_validation->set_rules('govtbuildings', 'Govt Buildings', 'trim|required|numeric');
            $this->form_validation->set_rules('roads', 'Roads', 'trim|required|numeric');
            $this->form_validation->set_rules('mandal_id', 'Select Mandal', 'trim|required');
            $this->form_validation->set_rules('village_id', 'Select Village', 'trim|required');
           
            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->error_array();
                $i = 0;
                foreach ($errors as $key => $value) {
                    $error[$i] = $value;
                    $i++;
                }
            } else {
                $ignore_data = array('villageInfoPost');
                foreach($this->input->post() as $key => $value){
                    if(!array_key_exists($key, $update_data) && !in_array($key,$ignore_data)){
                        $update_data[$key] = $value;
                    }
                }
				$mandal_id = trim($this->input->post('mandal_id'));
				$village_id = trim($this->input->post('village_id'));
                $records = $this->common_model->checkRecordExist('village_information', array('mandal_id' => $mandal_id, 'village_id' => $village_id));
                if (!$records) {
                    $result = $this->common_model->insertRecord('village_information', $update_data); // params :tablename,data
                    if ($result) {
                        $this->common_model->messageAction('Village Information Added Successfully',1);
                        unset($_POST);
                        redirect(base_url('adminLocalization/villageInfos'));
                    } else {
                        $this->common_model->messageAction('Village Information Not added',2);
                    }
                } else {
                    $this->common_model->messageAction('Village Information Already exists',2);
                }
                unset($_POST);
            }
        }
        
        $data['mandals'] = $this->common_model->getAllRecords('mandals', array());
        $this->load->view('admin/addVillageInfo', $data);
    }
    
    //delete Member

    public function deleteVillageInfo() {
        $id = $this->uri->segment(3);

        if (!empty($id) && $id > 0) {
            $where = array('id' => $id);
            $result = $this->common_model->deleteRecord('village_information', $where);
            if ($result) {
                $this->common_model->messageAction('Deleted Successfully',1);
            } else {
                $this->common_model->messageAction('Not Deleted',2);
            }
        } else {
            $this->common_model->messageAction('Invalid ID',2);
        }
        redirect(base_url('adminLocalization/villageInfo'));
    }
    
    //load villages by mandal id
    
    public function loadVillages(){
        $id = $this->input->post('mandal_id');
        $where = array('mandal_id' => $id);
        $result = $this->adminLocalization_model->getVillages($where);
		echo '<option value="">Select Village</option>';
		if($result){
			foreach($result as $row){
				echo '<option value="'.$row['id'].'">'.ucwords($row['name']).'</option>';
			}
		}
	}
            
	//get all the Investments

    public function investments() {
        $data['investments'] = array();
        $where = array();
		
        $result =  $this->common_model->getAllRecords('investments', $where);

        if ($result)
            $data['investments'] = $result;

        $this->load->view('admin/investments', $data);
    }
	
	//delete Investment

    public function deleteInvestment() {
        $id = $this->uri->segment(3);

        if (!empty($id) && $id > 0) {
            $where = array('id' => $id);
            $result = $this->common_model->deleteRecord('investments', $where);
            if ($result) {
                $this->common_model->messageAction('Deleted Successfully',1);
            } else {
                $this->common_model->messageAction('Not Deleted',2);
            }
        } else {
            $this->common_model->messageAction('Invalid ID',2);
        }
        redirect(base_url('adminLocalization/investments'));
    }
	
	//get all the Requirements

    public function requirements() {
        $data['requirements'] = array();
        $where = array();
		
        $result =  $this->adminLocalization_model->getRequirements('requirements', $where);

        if ($result)
            $data['requirements'] = $result;

        $this->load->view('admin/requirements', $data);
    }
	
	//delete Requirements

    public function deleteRequirement() {
        $id = $this->uri->segment(3);

        if (!empty($id) && $id > 0) {
            $where = array('id' => $id);
            $result = $this->common_model->deleteRecord('requirements', $where);
            if ($result) {
                $this->common_model->messageAction('Deleted Successfully',1);
            } else {
                $this->common_model->messageAction('Not Deleted',2);
            }
        } else {
            $this->common_model->messageAction('Invalid ID',2);
        }
        redirect(base_url('adminLocalization/requirements'));
    }
    
}
