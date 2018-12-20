<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Delete extends CI_Controller {
   public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html','text'));
		$this->load->library(array('session','form_validation','pagination','email'));
		$this->load->model(array('common_model'));
		if($this->session->userdata('ADMIN_ID') =='') {
         redirect('login');
		}
	}


	public function resDelete()
    {
        $data=array();
        $id = $this->uri->segment(3);
        $this->db->delete('tb_restaurant', array('res_id' => $id));
        $message = '<div class="alert alert-success">Resturant has been successfully deleted.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('add/restaurant');

    }

    public function menu()
    {
        $data=array();
        $id = $this->uri->segment(3);
        $this->db->delete('tb_menu', array('menu_id' => $id));
        $message = '<div class="alert alert-success">Menu has been successfully deleted.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('add/menu');

    }


    public function ticker()
    {
        $data=array();
        $id = $this->uri->segment(3);
        $this->db->delete('tb_ticker', array('ticker_id' => $id));
        $message = '<div class="alert alert-success">Ticker has been successfully deleted.</p></div>';
        $this->session->set_flashdata('success', $message);
        redirect('add/ticker');

    }


}

