<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AdminUser extends CI_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        
        $this->load->model('adminUser_model');
        $this->load->model('common_model');
    }

    //check old password is matched or not
    public function checkPassword($password){
        $this->form_validation->set_message('checkPassword', 'Old Password didnot Match. ');
        $checkPassword = $this->adminUser_model->checkOldPassword($password);
        if ($checkPassword) {
            return true;
        } else {
            return false;
        }
    }

    //check new pwd with old password is matched or not
    public function checkWithOldPwd($password){
        $this->form_validation->set_message('checkwitholdpwd', 'New Password Should not be same with Old password.');
        $checkPassword = $this->adminUser_model->checkOldPassword($password);
        if ($checkPassword) {
            return false;
        } else {
            return true;
        }
    }

    //Change password

    public function changePWD(){
        
        if (isset($_POST['changePwdPost']) && $_POST['changePwdPost'] == 'Submit') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|callback_checkPassword');
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|callback_checkWithOldPwd|matches[cnf_password]');
            $this->form_validation->set_rules('cnf_password', 'Confrim Password', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->error_array();
                $i = 0;
                foreach ($errors as $key => $value) {
                    $error[$i] = $value;
                    $i++;
                }
                $err_msg = $errors;
            }else{
                $oldpwd = trim($this->input->post('old_password'));
                if($this->adminUser_model->check_old_pwd($oldpwd)){
                    $data = array('password' => MD5(trim($this->input->post('new_password'))));
                    $where = array('admin_id' => $this->session->userdata['is_logged']['id']);
                    $this->common_model->updateRecord('admin',$data, $where); //params  : tablename, data,where condition
                    $this->common_model->messageAction('Password Changed Successfully', 1);
                }else{
                    $this->common_model->messageAction("Old password didn't Match", 2);
                    
                }
            }
            unset($_POST);
        }
        $this->load->view('changePWD');
    } 

    

}
