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

        error_reporting(0);
        
    }
    
    
    public function customers()
    {
        $data = array();
        $data['customers'] = $this->db->query("SELECT * FROM tb_user ORDER BY name ASC")->result();
        $this->load->view('customers-list',$data);
        
    }

    public function orders()
    {
        $data['orders'] = $this->db->query("SELECT * FROM tb_order ORDER BY order_id DESC")->result();
        $this->load->view('orders-list',$data);
    }


    public function reports()
    {
        $data = array();


        $where = " where ";
        

        $data['search']       = $this->input->get('search');
        if($data['search'] != '')
        {

            $data['from_date']              = $this->input->get('from_date');
            if($data['from_date'] != ''){
                $where .=  "a.order_date >= '".trim($data['from_date'])."' AND ";
            }

            $data['to_date']                = $this->input->get('to_date');
            if($data['to_date'] != ''){
                $where .=  "a.order_date <= '".trim($data['to_date'])."' AND ";
            }

            $data['res_id']                = $this->input->get('res_id');
            if($data['res_id'] != ''){
                $where .=  "b.res_id =".trim($data['res_id'])." AND ";
            }


            $data['menu_name']                = $this->input->get('menu_name');
            if($data['menu_name'] != ''){
                $where .=  "c.menu_name LIKE '%".trim($data['menu_name'])."%' AND ";
            }

            $data['user_id']                = $this->input->get('user_id');
            if($data['user_id'] != ''){
                $where .=  "a.user_id =".trim($data['user_id'])." AND ";
            }
        }
        else{

            $where = '';
        }

        $where = substr($where,0,(strlen($where)-4));

        $data['restaurants'] = $this->db->query("SELECT * FROM tb_restaurant ORDER BY res_name ASC")->result();
        $data['menus'] = $this->db->query("SELECT * FROM tb_menu ORDER BY menu_name ASC")->result();
        $data['customers'] = $this->db->query("SELECT * FROM tb_user GROUP BY email ORDER BY name ASC")->result();
        $data['orders'] = $this->db->query("SELECT * FROM tb_order a
                                            INNER JOIN tb_order_menu b ON a.order_id=b.order_id
                                            INNER JOIN tb_menu c ON b.menu_id=c.menu_id
                                            ".$where." AND is_success = 1
                                             ORDER BY a.order_id DESC")->result();

        //echo $this->db->last_query(); die;

        $this->load->view('report',$data);
    }


}
