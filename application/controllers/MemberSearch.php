<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MemberSearch extends CI_Controller {

    public function index()
	{
		$this->load->view('frontend/members_search');
	}


}
