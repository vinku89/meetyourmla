<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AdminLogin extends CI_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        
        $this->load->model('adminUser_model');
        $this->load->model('common_model');
    }

    public function index() {
        if ($this->session->userdata('is_logged')) {
            redirect(base_url('adminLocalization/mandals'));
        }
        $msg = '';
        //check login is set or not
        if (isset($_POST['adminLogin']) && $_POST['adminLogin'] == 'Login') {
            $username = trim($this->input->post("username"));
            $password = trim($this->input->post("password"));
            
            if ($username != '' && $password != '') {
                $userdata = $this->adminUser_model->checkUser($username, $password);
                if ($userdata->num_rows() == 1) {
                    $userdata = array_shift($userdata->result());
                    if ($userdata->status == 1) {
                        $session_data = array(
                            'firstname' => $userdata->firstname,
                            'lastname' => $userdata->lastname,
                            'id' => $userdata->admin_id,
                            'avatar' => ($userdata->avatar) ? base_url('uploads/avatars/' . $userdata->avatar) : base_url('uploads/avatars/default_user.png'),
                            'logged_in' => TRUE
                        );
                        // Add user data in session
                        $this->session->set_userdata('is_logged', $session_data);
                        redirect(base_url('adminLocalization/mandals'));
                    } else {
                        $this->common_model->messageAction('Your Account is Blocked (or) Inactive',2);
                        
                    }
                } else {
                    $this->common_model->messageAction('Invalid Username and Password',2);
                }
            }
            unset($_POST);
        }
        $this->load->view('login');
    }

    //Logout admin User 
    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url('adminLogin'));
    }

}
