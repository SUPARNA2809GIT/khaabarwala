<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Home extends CI_Controller {



   public function __construct() {



		parent::__construct();
		$this->load->helper(array('url','form','html','text'));
		$this->load->library(array('session','form_validation','pagination','email'));
		$this->load->model(array('common_model'));
		if($this->session->userdata('ADMIN_ID') =='') {
         redirect('admin/login');
		}
	}

	


	public function index()
	{
	    $data = array();
	    $data['totalCus'] = $this->db->query("SELECT * FROM tb_user")->num_rows();
	    $data['totalRes'] = $this->db->query("SELECT * FROM tb_restaurant")->num_rows();
	    $data['totalMenu'] = $this->db->query("SELECT * FROM tb_menu")->num_rows();
		$this->load->view('home',$data);
	}


}

