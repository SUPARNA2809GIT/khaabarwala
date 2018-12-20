<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View extends CI_Controller {

   public function __construct() {

        parent::__construct();
        $this->load->helper(array('url','form','html','text'));
        $this->load->library(array('session','form_validation','pagination','email'));
        $this->load->model(array('common_model'));
        if($this->session->userdata('ADMIN_ID') =='') {

         redirect('login');

        }
        
    }
    
    
    public function customers()
    {
        $data = array();
        $data['customers'] = $this->db->query("SELECT * FROM tb_user ORDER BY name ASC")->result();
        $this->load->view('customers-list',$data);
        
    }

    public function orders()
    {
        $data['orders'] = $this->db->query("SELECT * FROM tb_order")->result();
        $this->load->view('orders-list',$data);
    }


}
